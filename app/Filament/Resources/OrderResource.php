<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Order Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->label('User ID')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'cash' => 'Cash',
                        'dana' => 'DANA',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('dana_id')
                    ->label('DANA ID/Name')
                    ->nullable() // Opsional jika metode pembayaran bukan DANA
                    ->helperText('Required if payment method is DANA'),
                Forms\Components\TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')
                ->label('No')
                ->sortable(),
            Tables\Columns\TextColumn::make('user_id')->sortable(),
            Tables\Columns\TextColumn::make('payment_method')->sortable(),
            Tables\Columns\TextColumn::make('dana_id')->sortable(),
            Tables\Columns\TextColumn::make('total_amount')
                ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                ->sortable(),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'completed' => 'success',
                    'cancelled' => 'danger',
                    default => 'gray',
                })
                ->sortable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
                ->visible(fn ($record): bool => in_array($record->status, ['completed', 'cancelled']))
                ->icon('heroicon-o-trash')
                ->tooltip('Hapus Pesanan'),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/orders'),
            'create' => Pages\CreateOrder::route('/orders/create'),
            'edit' => Pages\EditOrder::route('/orders/{record}/edit'),
        ];
    }
}