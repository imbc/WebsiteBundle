add to your composer.json the follow:

```
    "repositories": [
        { "type": "vcs", "url": "http://github.com/imbc/WebsiteBundle" }
    ],
    "require": {
        ...
        "imbc/website-bundle": "dev-master"
        ...
    },

```


import js + css files from the bundle in your base template:

``` css
        {% block stylesheets %}
            <link rel="stylesheet" href="{{ asset('bundles/imbcwebsite/css/main.css') }}" type="text/css" />
            <link rel="stylesheet" href="{{ asset('bundles/imbcwebsite/css/bootstrap.css') }}" type="text/css" />
            <link rel="stylesheet" href="{{ asset('bundles/imbcwebsite/css/bootstrap-responsive.min.css') }}" type="text/css" />
            <link rel="stylesheet" href="{{ asset('bundles/imbcwebsite/css/font-awesome.min.css') }}" type="text/css" />
            <link rel="stylesheet" href="{{ asset('bundles/imbcwebsite/css/jquery-ui-1.9.2.custom.css') }}" type="text/css" />
            <link rel="stylesheet" href="{{ asset('bundles/imbcwebsite/css/jquery.multiselect.css') }}" type="text/css" />
            <link rel="stylesheet" href="{{ asset('bundles/imbcwebsite/css/jquery.multiselect.filter.css') }}" type="text/css" />
        {% endblock %}
```

``` javascript
        {% block javascript %}
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script type="text/javascript" src="{{ asset('bundles/imbcwebsite/js/jquery-ui-1.9.2.custom.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('bundles/imbcwebsite/js/jquery.ui.widget.js') }}"></script>
            <script type="text/javascript" src="{{ asset('bundles/imbcwebsite/js/jquery.multiselect.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('bundles/imbcwebsite/js/jquery.multiselect.filter.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('bundles/imbcwebsite/js/bootstrap.js') }}"></script>
            <script type="text/javascript" src="{{ asset('bundles/imbcwebsite/js/main.js') }}"></script>
        {% endblock %}
```