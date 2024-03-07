<div>
    <x-container>
        <div class="flex flex-col gap-12 py-12 md:flex-row">
            <div class="w-full md:w-1/2">
                <h4>Onde a foto do campo <span>"imagem"</span> será usado ?</h4>
                <p>O campo <span>"imagem"</span> será a logo do jogo. Por exemplo:</p>
                <div class="flex items-center gap-2 mt-6">
                    <img class="flex size-14"
                        src="https://seeklogo.com/images/V/valorant-logo-FAB2CA0E55-seeklogo.com.png"
                        alt="Logo Valorant">
                    <h1 class="font-bold">Valorant</h1>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <h4>Onde a foto do campo <span>"imagem alternativa"</span> será usada ?</h4>
                <p>O campo <span>"imagem alternativa"</span> será utilizado na hora de selecionar o jogo no qual o
                    usuário deseja encontrar um player. Por exemplo:</p>
                <div class="">
                    <img class="w-full p-2 mt-6 border rounded-md border-zinc-800"
                        src="{{asset('images/select-game-example-image.png')}}"
                        alt="Imagem de exemplo da tela de selecionar um jogo">
                </div>
            </div>

        </div>
    </x-container>
</div>