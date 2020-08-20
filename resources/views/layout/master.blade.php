<!DOCTYPE html>
<html lang="en">

  @include('layout.head')

  <body>

    <div class="container">

      @include('layout.header')

      @include('layout.nav')
      
    </div>

    <main role="main" class="container">
      <div class="row">

        @include('layout.text')

        @include('layout.sidebar', ['tags' => App\Tag::all()])

      </div><!-- /.row -->
    </main><!-- /.container -->
    
    @include('layout.footer')

  </body>
</html>
