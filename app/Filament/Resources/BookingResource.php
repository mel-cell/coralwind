<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Guest Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK (National ID)')
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('no_hp')
                            ->label('Phone Number')
                            ->tel()
                            ->required()
                            ->maxLength(15),
                    ])->columns(3),

                Forms\Components\Section::make('Booking Details')
                    ->schema([
                        Forms\Components\Select::make('room_id')
                            ->relationship('room', 'nama_kamar')
                            ->required(),
                        Forms\Components\DatePicker::make('tgl_check_in')
                            ->required(),
                        Forms\Components\DatePicker::make('tgl_check_out')
                            ->required(),
                        Forms\Components\TextInput::make('jumlah_kamar')
                            ->required()
                            ->numeric()
                            ->default(1),
                        Forms\Components\TextInput::make('total_harga')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'bayar' => 'Paid',
                                'batal' => 'Cancelled',
                                'selesai' => 'Completed',
                            ])
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Payment')
                    ->schema([
                        Forms\Components\Select::make('payment_method')
                            ->options([
                                'pay_at_hotel' => 'Pay at Hotel',
                                'credit_card' => 'Credit Card',
                            ])
                            ->required()
                            ->reactive(),
                        Forms\Components\TextInput::make('credit_card_number')
                            ->hidden(fn (Forms\Get $get) => $get('payment_method') !== 'credit_card'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->label('Guest'),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable()
                    ->toggleable()
                    ->label('NIK'),
                Tables\Columns\TextColumn::make('no_hp')
                    ->searchable()
                    ->toggleable()
                    ->label('Phone'),
                Tables\Columns\TextColumn::make('room.nama_kamar')
                    ->searchable()
                    ->label('Room'),
                Tables\Columns\TextColumn::make('tgl_check_in')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_check_out')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'bayar' => 'success',
                        'selesai' => 'success',
                        'batal' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}

