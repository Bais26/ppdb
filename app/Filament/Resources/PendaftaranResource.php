<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranResource\Pages;
use App\Models\Pendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use App\Mail\RevisionNotification;
use Illuminate\Support\Facades\Mail;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $modelLabel = 'Pendaftaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Status Verifikasi')
                    ->schema([
                        Forms\Components\Select::make('status_pembayaran')
                            ->options([
                                'pending' => 'Pending',
                                'uploaded' => 'Uploaded',
                                'verified' => 'Verified',
                                'rejected' => 'Rejected',
                                'revisi' => 'Revisi',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('catatan_pembayaran')
                            ->label('Catatan Pembayaran')
                            ->columnSpanFull(),

                        Forms\Components\Select::make('status_berkas')
                            ->options([
                                'pending' => 'Pending',
                                'revisi' => 'Revisi',
                                'diterima' => 'Diterima',
                                'ditolak' => 'Ditolak',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('catatan_berkas')
                            ->label('Catatan Berkas')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('persetujuan')
                            ->label('Disetujui'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_pendaftaran')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama_santri')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status_pembayaran')
                    ->label('Pembayaran')
                    ->colors([
                        'gray' => 'pending',
                        'warning' => 'uploaded',
                        'success' => 'verified',
                        'danger' => 'rejected',
                        'yellow' => 'revisi',
                    ]),

                Tables\Columns\BadgeColumn::make('status_berkas')
                    ->label('Berkas')
                    ->colors([
                        'gray' => 'pending',
                        'yellow' => 'revisi',
                        'success' => 'diterima',
                        'danger' => 'ditolak',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->label('Tanggal Daftar'),
            ])
            ->filters([
                // ... (filters tetap sama)
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    // Verifikasi Pembayaran
                    Tables\Actions\Action::make('verify_payment')
                        ->label('Verifikasi Pembayaran')
                        ->icon('heroicon-o-currency-dollar')
                        ->color('primary')
                        ->modalWidth(MaxWidth::SevenExtraLarge)
                        ->modalContent(function (Pendaftaran $record) {
                            return view('admin.pembayaran-verification', [
                                'record' => $record,
                                'documentType' => 'Bukti Pembayaran',
                                'currentStatus' => $record->status_pembayaran,
                                'imageUrl' => $record->bukti_bayar ? Storage::url($record->bukti_bayar) : null,
                                'catatan' => $record->catatan_pembayaran,
                            ]);
                        })
                        ->form([
                            Forms\Components\Radio::make('status')
                                ->label('Status Verifikasi')
                                ->options([
                                    'verified' => 'Diterima',
                                    'revisi' => 'Perlu Revisi',
                                    'rejected' => 'Ditolak',
                                ])
                                ->required(),

                            Forms\Components\Textarea::make('catatan')
                                ->label('Catatan')
                                ->requiredIf('status', 'revisi'),
                        ])
                        ->action(function (Pendaftaran $record, array $data) {
                            $record->update([
                                'status_pembayaran' => $data['status'],
                                'catatan_pembayaran' => $data['catatan'] ?? null,
                            ]);

                            $notification = match ($data['status']) {
                                'verified' => Notification::make()
                                    ->title('Pembayaran Diterima')
                                    ->success()
                                    ->body('Bukti pembayaran telah diverifikasi dan diterima.'),
                                'revisi' => Notification::make()
                                    ->title('Perlu Revisi')
                                    ->warning()
                                    ->body('Bukti pembayaran perlu direvisi: ' . $data['catatan']),
                                'rejected' => Notification::make()
                                    ->title('Pembayaran Ditolak')
                                    ->danger()
                                    ->body('Bukti pembayaran ditolak: ' . $data['catatan']),
                            };

                            $notification->send();
                        }),

                    // Verifikasi Berkas Lengkap (IMPROVED)
                    Tables\Actions\Action::make('verify_documents')
                        ->label('Verifikasi Berkas')
                        ->icon('heroicon-o-document-text')
                        ->color('primary')
                        ->visible(fn($record) => in_array($record->status_berkas, ['pending', 'revisi']))
                        ->modalWidth(MaxWidth::SevenExtraLarge)
                        ->modalContent(function (Pendaftaran $record) {
                            return view('admin.berkas-verification', [
                                'record' => $record,
                                'documentType' => 'Berkas Pendaftaran',
                                'files' => [
                                    'STTB' => [
                                        'url' => $record->foto_sttb,
                                        'status' => $record->status_sttb,
                                        'catatan' => $record->catatan_sttb,
                                    ],
                                    'SKHUN' => [
                                        'url' => $record->foto_skhun,
                                        'status' => $record->status_skhun,
                                        'catatan' => $record->catatan_skhun,
                                    ],
                                    'Pas Foto' => [
                                        'url' => $record->pas_foto,
                                        'status' => $record->status_pas_foto,
                                        'catatan' => $record->catatan_pas_foto,
                                    ],
                                    'Akta' => [
                                        'url' => $record->foto_akta,
                                        'status' => $record->status_akta,
                                        'catatan' => $record->catatan_akta,
                                    ],
                                    'NISN' => [
                                        'url' => $record->foto_nisn,
                                        'status' => $record->status_nisn,
                                        'catatan' => $record->catatan_nisn,
                                    ],
                                ],
                                'isBulkVerification' => true
                            ]);
                        })
                        ->form([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    // STTB
                                    Forms\Components\Fieldset::make('STTB')
                                        ->schema([
                                            Forms\Components\Radio::make('status_sttb')
                                                ->options([
                                                    'diterima' => 'Diterima',
                                                    'revisi' => 'Revisi',
                                                    'ditolak' => 'Ditolak',
                                                ])
                                                ->required(),
                                            Forms\Components\Textarea::make('catatan_sttb')
                                                ->label('Catatan')
                                                ->requiredIf('status_sttb', 'revisi')
                                                ->requiredIf('status_sttb', 'ditolak'),
                                        ]),

                                    // SKHUN
                                    Forms\Components\Fieldset::make('SKHUN')
                                        ->schema([
                                            Forms\Components\Radio::make('status_skhun')
                                                ->options([
                                                    'diterima' => 'Diterima',
                                                    'revisi' => 'Revisi',
                                                    'ditolak' => 'Ditolak',
                                                ])
                                                ->required(),
                                            Forms\Components\Textarea::make('catatan_skhun')
                                                ->label('Catatan')
                                                ->requiredIf('status_skhun', 'revisi')
                                                ->requiredIf('status_skhun', 'ditolak'),
                                        ]),

                                    // Pas Foto
                                    Forms\Components\Fieldset::make('Pas Foto')
                                        ->schema([
                                            Forms\Components\Radio::make('status_pas_foto')
                                                ->options([
                                                    'diterima' => 'Diterima',
                                                    'revisi' => 'Revisi',
                                                    'ditolak' => 'Ditolak',
                                                ])
                                                ->required(),
                                            Forms\Components\Textarea::make('catatan_pas_foto')
                                                ->label('Catatan')
                                                ->requiredIf('status_pas_foto', 'revisi')
                                                ->requiredIf('status_pas_foto', 'ditolak'),
                                        ]),

                                    // Akta
                                    Forms\Components\Fieldset::make('Akta Kelahiran')
                                        ->schema([
                                            Forms\Components\Radio::make('status_akta')
                                                ->options([
                                                    'diterima' => 'Diterima',
                                                    'revisi' => 'Revisi',
                                                    'ditolak' => 'Ditolak',
                                                ])
                                                ->required(),
                                            Forms\Components\Textarea::make('catatan_akta')
                                                ->label('Catatan')
                                                ->requiredIf('status_akta', 'revisi')
                                                ->requiredIf('status_akta', 'ditolak'),
                                        ]),

                                    // NISN
                                    Forms\Components\Fieldset::make('NISN')
                                        ->schema([
                                            Forms\Components\Radio::make('status_nisn')
                                                ->options([
                                                    'diterima' => 'Diterima',
                                                    'revisi' => 'Revisi',
                                                    'ditolak' => 'Ditolak',
                                                ])
                                                ->required(),
                                            Forms\Components\Textarea::make('catatan_nisn')
                                                ->label('Catatan')
                                                ->requiredIf('status_nisn', 'revisi')
                                                ->requiredIf('status_nisn', 'ditolak'),
                                        ]),
                                ]),


                        ])
                        ->action(function (Pendaftaran $record, array $data) {
                            Log::info('Data sebelum update:', $data);

                            // Tentukan status berkas otomatis berdasarkan status dokumen
                            $statusDokumen = [
                                $data['status_sttb'] ?? 'pending',
                                $data['status_skhun'] ?? 'pending',
                                $data['status_pas_foto'] ?? 'pending',
                                $data['status_akta'] ?? 'pending',
                                $data['status_nisn'] ?? 'pending',
                            ];

                            // Kumpulkan catatan untuk dokumen yang bermasalah
                            $catatanBermasalah = [];

                            if (($data['status_sttb'] ?? '') === 'revisi' && !empty($data['catatan_sttb'])) {
                                $catatanBermasalah[] = "STTB: " . $data['catatan_sttb'];
                            }
                            if (($data['status_sttb'] ?? '') === 'ditolak' && !empty($data['catatan_sttb'])) {
                                $catatanBermasalah[] = "STTB: " . $data['catatan_sttb'];
                            }

                            if (($data['status_skhun'] ?? '') === 'revisi' && !empty($data['catatan_skhun'])) {
                                $catatanBermasalah[] = "SKHUN: " . $data['catatan_skhun'];
                            }
                            if (($data['status_skhun'] ?? '') === 'ditolak' && !empty($data['catatan_skhun'])) {
                                $catatanBermasalah[] = "SKHUN: " . $data['catatan_skhun'];
                            }

                            if (($data['status_pas_foto'] ?? '') === 'revisi' && !empty($data['catatan_pas_foto'])) {
                                $catatanBermasalah[] = "Pas Foto: " . $data['catatan_pas_foto'];
                            }
                            if (($data['status_pas_foto'] ?? '') === 'ditolak' && !empty($data['catatan_pas_foto'])) {
                                $catatanBermasalah[] = "Pas Foto: " . $data['catatan_pas_foto'];
                            }

                            if (($data['status_akta'] ?? '') === 'revisi' && !empty($data['catatan_akta'])) {
                                $catatanBermasalah[] = "Akta: " . $data['catatan_akta'];
                            }
                            if (($data['status_akta'] ?? '') === 'ditolak' && !empty($data['catatan_akta'])) {
                                $catatanBermasalah[] = "Akta: " . $data['catatan_akta'];
                            }

                            if (($data['status_nisn'] ?? '') === 'revisi' && !empty($data['catatan_nisn'])) {
                                $catatanBermasalah[] = "NISN: " . $data['catatan_nisn'];
                            }
                            if (($data['status_nisn'] ?? '') === 'ditolak' && !empty($data['catatan_nisn'])) {
                                $catatanBermasalah[] = "NISN: " . $data['catatan_nisn'];
                            }

                            // Tentukan status berkas berdasarkan prioritas
                            if (in_array('ditolak', $statusDokumen)) {
                                $statusBerkas = 'ditolak';
                            } elseif (in_array('revisi', $statusDokumen)) {
                                $statusBerkas = 'revisi';
                            } elseif (in_array('pending', $statusDokumen)) {
                                $statusBerkas = 'pending';
                            }
                            // Jika semua dokumen diterima
                            else {
                                $statusBerkas = 'diterima';
                            }

                            // Set catatan berkas otomatis
                            $catatanBerkas = !empty($catatanBermasalah) ? implode("\n\n", $catatanBermasalah) : null;

                            $updateData = [
                                'status_sttb' => $data['status_sttb'] ?? $record->status_sttb,
                                'catatan_sttb' => $data['catatan_sttb'] ?? $record->catatan_sttb,
                                'status_skhun' => $data['status_skhun'] ?? $record->status_skhun,
                                'catatan_skhun' => $data['catatan_skhun'] ?? $record->catatan_skhun,
                                'status_pas_foto' => $data['status_pas_foto'] ?? $record->status_pas_foto,
                                'catatan_pas_foto' => $data['catatan_pas_foto'] ?? $record->catatan_pas_foto,
                                'status_akta' => $data['status_akta'] ?? $record->status_akta,
                                'catatan_akta' => $data['catatan_akta'] ?? $record->catatan_akta,
                                'status_nisn' => $data['status_nisn'] ?? $record->status_nisn,
                                'catatan_nisn' => $data['catatan_nisn'] ?? $record->catatan_nisn,
                                'status_berkas' => $statusBerkas, // Set otomatis
                                'catatan_berkas' => $catatanBerkas, // Set otomatis
                            ];

                            $record->update($updateData);
                            if (in_array($statusBerkas, ['revisi', 'ditolak'])) {
                                // Generate token untuk revisi
                                $record->generateRevisionToken();
                                
                                // Kirim email notifikasi
                                if ($record->email_ortu) {
                                    Mail::to($record->email_ortu)->send(new RevisionNotification($record));
                                }
                                
                                // Atau kirim WhatsApp (jika menggunakan service seperti Twilio)
                                // $this->sendWhatsAppNotification($record);
                            }
                            Log::info('Data setelah update:', $record->fresh()->toArray());

                            $notification = match ($statusBerkas) {
                                'diterima' => Notification::make()
                                    ->title('Berkas Diterima')
                                    ->success()
                                    ->body('Semua berkas telah diverifikasi dan diterima.'),
                                'revisi' => Notification::make()
                                    ->title('Perlu Revisi')
                                    ->warning()
                                    ->body('Ada berkas yang perlu direvisi. Silakan periksa detail dokumen.'),
                                'ditolak' => Notification::make()
                                    ->title('Berkas Ditolak')
                                    ->danger()
                                    ->body('Ada berkas yang tidak memenuhi syarat.'),
                                'pending' => Notification::make()
                                    ->title('Status Pending')
                                    ->info()
                                    ->body('Masih ada berkas yang belum diverifikasi.'),
                            };

                            $notification->send();
                        }),

                    // View
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),

                    // Edit
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil'),

                    // Delete
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash'),
                ])
                    ->label('Aksi')
                    ->icon('heroicon-s-ellipsis-vertical')
                    ->color('gray'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }



    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'view' => Pages\ViewPendaftaran::route('/{record}'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}