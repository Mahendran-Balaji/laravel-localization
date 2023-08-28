<!DOCTYPE html>
<html>
<head>
    <title>Multi Language Website using Laravel Localization</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
  
        <div class="row">
            <div class="col-md-2 col-md-offset-6 text-right">
                <strong>Select Language: </strong>
            </div>
            <div class="col-md-4">
                <select class="form-control changeLanguage">
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France</option>
                    <option value="sp" {{ session()->get('locale') == 'sp' ? 'selected' : '' }}>Spanish</option>
                    <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>
                    <option value="ja" {{ session()->get('locale') == 'ja' ? 'selected' : '' }}>Japanese</option>
                </select>
            </div>
        </div>
       <h1>{{ __('messages.welcome_message') }}</h1>
     
    </div>
</body>
  
<script type="text/javascript">
  
    var url = "{{ route('changeLanguage') }}";
  
    $(".changeLanguage").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });
  
</script>
</html>