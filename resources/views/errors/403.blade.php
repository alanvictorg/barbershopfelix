<!DOCTYPE html>
<html>

@include('layouts.header')
<body>
    <div id="app" v-cloak>
        <!-- Main content -->
        <section class="content">
            <div class="col-md-8 col-md-offset-2 text-center">
                <!--slide-->
                <div class="introItem">
                    <h1>;(</h1>

                    <h1>Descupe,
                        <small> parece que você não tem autorização necessária para acessar esta pagina! <br>Tente entrar em contato conosco: contato@includetecnologia.com.br </small>
                    </h1>

                    <!--end search -->
                </div>
                <!--end slide-->

                
            </div>
        </section>
    </div>
    @section('scripts')
        @include('layouts.partials.scripts')
    @show
</body>
</html>