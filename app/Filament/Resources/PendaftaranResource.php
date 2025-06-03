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

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $modelLabel = 'Pendaftaran';

    public static function form(Form $form): Form
    {
        $isVerified = fn ($record) => $record && $record->status_pembayaran === 'verified';

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
                            ])
                            ->required(),
                            
                        Forms\Components\Textarea::make('catatan_pembayaran')
                            ->label('Catatan Pembayaran')
                            ->columnSpanFull(),
                            
                        Forms\Components\Select::make('status_berkas')
                            ->options([
                                'pending' => 'Pending',
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
                    ]),
                    
                Tables\Columns\BadgeColumn::make('status_berkas')
                    ->label('Berkas')
                    ->colors([
                        'gray' => 'pending',
                        'success' => 'diterima',
                        'danger' => 'ditolak',
                    ]),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->label('Tanggal Daftar'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'uploaded' => 'Uploaded',
                        'verified' => 'Verified',
                        'rejected' => 'Rejected',
                    ]),
                
                Tables\Filters\SelectFilter::make('status_berkas')
                    ->label('Status Berkas')
                    ->options([
                        'pending' => 'Pending',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ]),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (array $data, $query) {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn ($query) => $query->whereDate('created_at', '>=', $data['dari_tanggal'])
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn ($query) => $query->whereDate('created_at', '<=', $data['sampai_tanggal'])
                            );
                    }),
                
                Tables\Filters\TernaryFilter::make('persetujuan')
                    ->label('Status Persetujuan')
                    ->trueLabel('Sudah Disetujui')
                    ->falseLabel('Belum Disetujui')
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    // Action Verifikasi Dokumen
                    Tables\Actions\Action::make('verify_document')
                        ->label('Verifikasi Dokumen')
                        ->icon('heroicon-o-document-check')
                        ->color('primary')
                        ->modalWidth(MaxWidth::SevenExtraLarge)
                        ->modalSubmitActionLabel('Simpan Verifikasi')
                        ->modalContent(function (Pendaftaran $record) {
                            return view('admin.berkas-verification', [
                                'record' => $record,
                                'documentType' => 'Bukti Pembayaran',
                                'currentStatus' => $record->status_bukti_bayar ?? 'pending',
                                'imageUrl' => $record->bukti_bayar ? Storage::url($record->bukti_bayar) : null,
                            ]);
                        })
                        ->form([
                            Forms\Components\Radio::make('status')
                                ->options([
                                    'sesuai' => 'Sesuai',
                                    'tidak_sesuai' => 'Tidak Sesuai',
                                ])
                                ->required(),
                        ])
                        ->action(function (Pendaftaran $record, array $data) {
                            $record->update([
                                'status_bukti_bayar' => $data['status'],
                                'catatan_verifikasi' => $data['catatan'] ?? null,
                            ]);
                            
                            if ($data['status'] === 'sesuai') {
                                $record->update(['status_pembayaran' => 'verified']);
                                
                                Notification::make()
                                    ->title('Verifikasi Berhasil')
                                    ->success()
                                    ->body('Bukti pembayaran telah berhasil diverifikasi.')
                                    ->send();
                            } else {
                                $record->update(['status_pembayaran' => 'rejected']);
                                
                                Notification::make()
                                    ->title('Verifikasi Ditolak')
                                    ->danger()
                                    ->body('Bukti pembayaran tidak memenuhi persyaratan.')
                                    ->send();
                            }
                        }),
                    
                    // Action Verifikasi Berkas
                    Tables\Actions\Action::make('verify_documents')
                        ->label('Verifikasi Berkas')
                        ->icon('heroicon-o-document-text')
                        ->color('primary')
                        ->visible(fn ($record) => $record->status_berkas === 'pending')
                        ->modalWidth(MaxWidth::SevenExtraLarge)
                        ->modalHeading('Verifikasi Kelengkapan Berkas')
                        ->modalContent(function (Pendaftaran $record) {
                            return view('admin.pembayaran-verification', [
                                'record' => $record,
                                'files' => [
                                    'STTB' => $record->foto_sttb,
                                    'SKHUN' => $record->foto_skhun,
                                    'Pas Foto' => $record->pas_foto,
                                    'Akta' => $record->foto_akta,
                                    'NISN' => $record->foto_nisn,
                                    'Bukti Bayar' => $record->bukti_bayar,
                                ],
                                'isBulkVerification' => true
                            ]);
                        })
                        ->form([
                            Forms\Components\Select::make('status_berkas')
                                ->options([
                                    'diterima' => 'Berkas Lengkap',
                                    'ditolak' => 'Berkas Tidak Lengkap',
                                ])
                                ->required(),
                                
                            Forms\Components\Textarea::make('catatan_berkas')
                                ->label('Catatan Verifikasi')
                                ->required(),
                        ])
                        ->action(function (Pendaftaran $record, array $data) {
                            $record->update([
                                'status_berkas' => $data['status_berkas'],
                                'catatan_berkas' => $data['catatan_berkas'],
                            ]);
                            
                            if ($data['status_berkas'] === 'diterima') {
                                Notification::make()
                                    ->title('Verifikasi Berkas Berhasil')
                                    ->success()
                                    ->body('Semua berkas pendaftaran telah diverifikasi dan diterima.')
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Verifikasi Berkas Ditolak')
                                    ->danger()
                                    ->body('Berkas pendaftaran tidak lengkap: ' . $data['catatan_berkas'])
                                    ->send();
                            }
                        }),
                    
                    // Action View
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),
                    
                    // Action Edit
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil'),
                    
                    // Action Delete
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation(),
                ])
                ->label('Actions')
                ->icon('heroicon-s-ellipsis-vertical')
                ->color('gray')
                ->size('sm')
                ->tooltip('Actions'),
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