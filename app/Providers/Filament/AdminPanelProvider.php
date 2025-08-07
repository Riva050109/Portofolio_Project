<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Resources\OrderResource;
use App\Filament\Widgets\WeeklyTotalRecap;
use App\Filament\Widgets\WeeklyTotalChart;
use Filament\Support\Enums\MaxWidth; 
use Filament\View\PanelsRenderHook;
use Filament\Support\Facades\FilamentView;

class AdminPanelProvider extends PanelProvider
{



    public function panel(Panel $panel): Panel
{
   return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->sidebarWidth('20rem')
            ->brandName('Kosmeta SMKN 6 JEMBER')
            ->colors([
                'primary' => Color::Indigo,
                'gray' => Color::Slate,
            ])
            ->font('Inter')
            ->maxContentWidth(MaxWidth::Full)
            ->resources([
                OrderResource::class,
            ])
             ->widgets([
            WeeklyTotalRecap::class,
            WeeklyTotalChart::class,
             ])
        ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
        ->pages([
            \App\Filament\pages\Dashboard::class,
        ])
        ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
        ->widgets([

        ])
        ->middleware([
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
        ])
        ->authMiddleware([
            Authenticate::class,
        ]);
}
}