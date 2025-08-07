<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaranPelangganResource\Pages;
use App\Filament\Resources\SaranPelangganResource\RelationManagers;
use App\Models\SaranPelanggan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaranPelangganResource extends Resource
{
    protected static ?string $model = SaranPelanggan::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Saran Pelanggan';
    protected static ?string $pluralLabel = 'Saran Pelanggan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pelanggan')
                    ->label('Nama Pelanggan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('tanggal_saran')
                    ->label('Tanggal Saran')
                    ->required(),
                Forms\Components\Textarea::make('isi_saran')
                    ->label('Isi Saran')
                    ->required()
                    ->rows(5)
                    ->maxLength(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pelanggan')
                    ->label('Nama Pelanggan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_saran')
                    ->label('Tanggal Saran')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('isi_saran')
                    ->label('Isi Saran')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->isi_saran),
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal_saran')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        $query
                            ->when($data['dari_tanggal'], fn ($query) => $query->whereDate('tanggal_saran', '>=', $data['dari_tanggal']))
                            ->when($data['sampai_tanggal'], fn ($query) => $query->whereDate('tanggal_saran', '<=', $data['sampai_tanggal']));
                    }),
            ])
            ->actions([
                // Tombol Delete - Posisi pertama agar muncul di sebelah kiri
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->tooltip('Hapus data ini')
                    ->successNotificationTitle('Data berhasil dihapus'),
                
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus data terpilih')
                        ->action(function (Collection $records) {
                            $records->each->delete();
                        })
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Data Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data yang dipilih? Tindakan ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Ya, Hapus'),
                ]),
            ])
            ->headerActions([
                // Tombol Deselect All
                Tables\Actions\Action::make('deselectAll')
                    ->label('Batal Pilih Semua')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(fn ($livewire) => $livewire->deselectAllTableRecords())
                    ->hidden(fn ($livewire) => !count($livewire->selectedTableRecords)),
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
            'index' => Pages\ListSaranPelanggan::route('/'),
            //'create' => Pages\CreateSaranPelanggan::route('/create'), // Dihapus
            //'edit' => Pages\EditSaranPelanggan::route('/{record}/edit'), //Dihapus
        ];
    }
}