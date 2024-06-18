@extends('layouts.app')

@section('content')
<div class="space-y-4" x-data="dashboard" @importacaoconcluida.window="handleImportacaoConcluida" @processamentoconcluido.window="handleProcessamentoConcluido">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold tracking-tight">Dashboard</h2>
        <div>
            <button class="uk-button uk-button-default">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                    <line x1="15" x2="15" y1="12" y2="18" />
                    <line x1="12" x2="18" y1="15" y2="15" />
                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" /></svg>
                Importar
            </button>
            <div class="uk-drop uk-dropdown" uk-dropdown="mode: click; pos: bottom-right">
                <ul class="uk-dropdown-nav uk-nav">
                    <li>
                        <a class="uk-drop-close justify-between" href="javascript:void(0)" role="button" @click="handleImportarEmpreendimentos('bild')">
                            Empreeendimentos Bild
                        </a>
                    </li>
                    <li>
                        <a class="uk-drop-close justify-between" href="javascript:void(0)" role="button" @click="handleImportarEmpreendimentos('vitta')">
                            Empreeendimentos Vitta
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
            <div class="uk-card">
                <div class="uk-card-header flex flex-row items-center justify-between">
                    <h3 class="text-sm font-medium tracking-tight">Total</h3>
                </div>
                <div class="uk-card-body pt-0">
                    <div class="text-2xl font-bold" x-text="totais.cadastrados">0</div>
                </div>
            </div>
            <div class="uk-card">
                <div class="uk-card-header flex flex-row items-center justify-between">
                    <h3 class="text-sm font-medium tracking-tight">Pendentes</h3>
                </div>
                <div class="uk-card-body pt-0">
                    <div class="text-2xl font-bold" x-text="totais.pendentes">0</div>
                </div>
            </div>
            <div class="uk-card">
                <div class="uk-card-header flex flex-row items-center justify-between">
                    <h3 class="text-sm font-medium tracking-tight">Bild</h3>
                </div>
                <div class="uk-card-body pt-0">
                    <div class="text-2xl font-bold" x-text="totais.bild">0</div>
                </div>
            </div>
            <div class="uk-card">
                <div class="uk-card-header flex flex-row items-center justify-between">
                    <h3 class="text-sm font-medium tracking-tight">Vitta</h3>
                </div>
                <div class="uk-card-body pt-0">
                    <div class="text-2xl font-bold" x-text="totais.vitta">0</div>
                </div>
            </div>
        </div>

        <div class="grid gap-4 lg:grid-cols-7">
            <div class="uk-card flex min-h-[500px] items-center justify-center lg:col-span-4" id="map">
            </div>

            <div class="uk-card lg:col-span-3 flex flex-col" x-show="ultimosEmpreendimentos.length == 0">
                <div class="uk-card-body pt-0 flex items-center justify-center flex-1">
                    <div class="flex items-center justify-center gap-x-2 text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" x2="12" y1="8" y2="12"></line>
                            <line x1="12" x2="12.01" y1="16" y2="16"></line>
                        </svg>
                        Nenhum empreendimento cadastrado
                    </div>
                </div>
            </div>

            <div class="uk-card lg:col-span-3 flex flex-col" x-show="ultimosEmpreendimentos.length > 0">
                <div class="uk-card-header">
                    <h3 class="font-semibold leading-none tracking-tight">
                        Empreendimentos recentes
                    </h3>
                </div>

                <div class="uk-card-body pt-0 flex items-center justify-center flex-1">
                    <div class="space-y-4 w-full">
                        <template x-for="empreendimento in ultimosEmpreendimentos" :key="empreendimento.pid" hidden>
                            <div class="flex items-center">
                                <span class="relative flex h-9 w-9 shrink-0 overflow-hidden rounded bg-accent">
                                    <img class="w-full" :src="empreendimento.thumb" x-show="empreendimento.thumb">
                                </span>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-medium leading-none" x-text="empreendimento.nome"></p>
                                    <p class="text-xs text-muted-foreground" x-text="empreendimento.end_cidade"></p>
                                </div>
                                <a class="text-sm text-muted-foreground flex gap-1 items-center" :href="empreendimento.link" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3">
                                        <path d="M15 3h6v6" />
                                        <path d="M10 14 21 3" />
                                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" /></svg>
                                    Acessar
                                </a>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dashboard', () => ({
            ...@json($data)

            , ...@json($pins)

            , map: null

            , init() {
                // Google Maps
                const mapOptions = {
                    zoom: 4
                    , mapTypeId: google.maps.MapTypeId.ROADMAP
                    , center: {
                        lat: -14.235004
                        , lng: -51.92528
                    }
                };

                this.map = new google.maps.Map(document.getElementById("map"), mapOptions);

                this.pins.forEach(pin => {
                    this.adicionarPin(pin);
                });
            }

            , adicionarPin(pin) {
                const marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(pin.latitude)
                        , lng: parseFloat(pin.longitude)
                    }
                    , map: this.map
                    , title: pin.nome
                });
            }

            , handleImportarEmpreendimentos(empresa) {
                UIkit.notification({
                    message: 'Importação iniciada'
                });

                axios.post(`ajax/empreendimentos/importar/${empresa}`)
                    .catch(error => {
                        console.error(error)
                        UIkit.notification({
                            message: 'Erro ao importar empreendimentos'
                            , status: 'danger'
                        });
                    })
            }

            , handleImportacaoConcluida(event) {
                this.totais = event.detail.totais;
                this.ultimosEmpreendimentos = event.detail.ultimosEmpreendimentos;
                UIkit.notification({
                    message: 'Importação concluída'
                });
            }

            , handleProcessamentoConcluido(event) {
                this.pins.push(event.detail.pin);
                this.adicionarPin(event.detail.pin);
                this.totais.pendentes = event.detail.totais.pendentes;
            }
        , }))
    })

    document.addEventListener('DOMContentLoaded', () => {
        window.Echo.channel('dashboard')
            .listen('.empreendimentos.importacao.concluida', (event) => {
                window.dispatchEvent(new CustomEvent('importacaoconcluida', {
                    detail: event.data
                }))
            })
            .listen('.empreendimentos.processamento.concluido', (event) => {
                window.dispatchEvent(new CustomEvent('processamentoconcluido', {
                    detail: event.data
                }))
            })
    })

</script>
@endsection
