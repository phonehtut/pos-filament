<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->placeholder('Please upload product image')
                    ->hiddenLabel()
                    ->avatar()
                    ->alignCenter()
                    ->columnSpan('full')
                    ->disk('public')
                    ->directory('products'),
                TextInput::make('name')
                    ->label('Name')
                    ->placeholder('Please enter product name')
                    ->required(),
                TextInput::make('price')
                    ->label('Price')
                    ->placeholder('Please enter product price')
                    ->numeric()
                    ->inputMode('decimal')
                    ->required(),
                Forms\Components\MarkdownEditor::make('description')
                    ->label('Description')
                    ->placeholder('Please enter product description')
                    ->columnSpan('full'),
                Forms\Components\TagsInput::make('tag')
                    ->label('Tags')
                    ->color('secondary'),
                Forms\Components\CheckboxList::make('categories')
                    ->relationship('categories', 'name')
                    ->label('Categories')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->disk('public'),
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->markdown(),
                TextColumn::make('tag')
                    ->label('Tags')
                    ->searchable()
                    ->badge()
                    ->copyable()
                    ->copyMessage('Copied !')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
