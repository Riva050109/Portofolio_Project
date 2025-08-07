<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Filament\Resources\OrderItemResource\RelationManagers;
use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationIcon = 'heroicon-s-square-3-stack-3d';
    protected static ?string $navigationGroup = 'Order Management';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('order_id')
                ->required()
                ->relationship('order', 'id')
                ->live() // Untuk real-time update
                ->afterStateUpdated(function ($state, Forms\Set $set) {
                    $order = \App\Models\Order::find($state);
                    if ($order) {
                        $set('customer_name', $order->customer->name); // Sesuaikan dengan relasi Anda
                    }
                }),
                
            Forms\Components\TextInput::make('customer_name')
                ->label('Atas Nama')
                ->disabled()
                ->dehydrated(false),
                
            // Field lainnya tetap sama...
            Forms\Components\Select::make('product_id')
                ->required()
                ->relationship('product', 'name'),
                
            Forms\Components\TextInput::make('quantity')
                ->required()
                ->numeric(),
                
            Forms\Components\TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('Rp'),
             Forms\Components\TextInput::make('total_price')
                ->label('Total Harga')
                ->prefix('Rp'),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('order.customer.name') // Asumsi relasi order->customer->name
                ->label('Atas Nama')
                ->sortable(),
                
            Tables\Columns\TextColumn::make('product.name')
                ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('price')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                    Tables\Columns\TextColumn::make('total_price')
                ->label('Total Harga')
                ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                 Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}