<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $modelLabel = 'Jogos';

    protected static ?string $navigationGroup = 'Jogos';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?string $activeNavigationIcon = 'heroicon-s-puzzle-piece';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set) {
                        $state = Str::slug($state);
                        $set('slug', $state);
                    }),
                Forms\Components\TextInput::make('slug')
                    ->disabled(),
                Forms\Components\Select::make('color')
                    ->columnSpanFull()
                    ->native(false)
                    ->required()
                    ->options([
                        'gray' => 'gray',
                        'black' => 'black',
                        'red' => 'red',
                        'yellow' => 'yellow',
                        'green' => 'green',
                        'blue' => 'blue',
                        'indigo' => 'indigo',
                        'purple' => 'purple',
                        'pink' => 'pink',
                        'teal' => 'teal',
                        'cyan' => 'cyan',
                        'orange' => 'orange',
                        'slate' => 'slate',
                        'zinc' => 'zinc',
                        'neutral' => 'neutral',
                        'stone' => 'stone',
                        'amber' => 'amber',
                        'lime' => 'lime',
                        'sky' => 'sky',
                        'violet' => 'violet',
                        'fuchsia' => 'fuchsia',
                        'rose' => 'rose',
                    ]),
                Forms\Components\FileUpload::make('photo')
                    ->required()
                    ->columnSpanFull()
                    ->image()
                    ->directory('games/icons/'),
                Forms\Components\FileUpload::make('alternative_photo')

                    ->required()
                    ->columnSpanFull()
                    ->image()
                    ->directory('games/alternative_photo/'),
                Forms\Components\FileUpload::make('banner')
                    ->helperText(new HtmlString('Caso esteja com dúvida de como cadastrar um jogo, <a target="_blank" href="/duvidas-ao-cadastrar-um-novo-jogo"><strong>Clique aqui!</strong></a>'))
                    ->required()
                    ->columnSpanFull()
                    ->image()
                    ->directory('games/banner/'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('photo'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('positions_count')
                    ->label('Position Count')
                    ->searchable()
                    ->toggleable()
                    ->counts('positions'),
                Tables\Columns\TextColumn::make('characters_count')
                    ->label('Character Count')
                    ->searchable()
                    ->toggleable()
                    ->counts('characters'),
                Tables\Columns\ColorColumn::make('color')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y')
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
