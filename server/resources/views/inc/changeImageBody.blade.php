@section('javascript')
    <script>
      $(function () {
        var body = $('body.has-img');
        var backgrounds = [
          'url({{asset('images/bg-home-1.jpg')}})',
            {{--'url({{asset('images/bg-home-2.jpg')}})',--}}
              'url({{asset('images/bg-home-3.jpg')}})',
            {{--'url({{asset('images/bg-home-4.jpg')}})'--}}
        ];
        var current = 0;

        function nextBackground() {
          body.css(
            'background-image',
            backgrounds[current = ++current % backgrounds.length]);

          setTimeout(nextBackground, 20000);
        }
        setTimeout(nextBackground, 20000);
        body.css('background-image', backgrounds[0]);
      });
      $(".toggle-password").click(function() {

          $(this).toggleClass("fa-eye fa-eye-slash");
          var input = $($(this).attr("toggle"));
          if (input.attr("type") == "password") {
              input.attr("type", "text");
          } else {
              input.attr("type", "password");
          }
      });
    </script>
@stop