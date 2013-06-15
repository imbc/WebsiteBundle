add to your composer.json the follow:

``` json
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

``` twig
    {% block stylesheets %}
        {% stylesheets 'bundles/imbcwebsite/css/*' filter='cssrewrite' %}
            <link rel="stylesheet" href="{{ asset_url }}" />
        {% endstylesheets %}
    {% endblock %}
    {{ notify_resources() }}
</head>
```

``` twig
    <div id=”notify_container”></div>
    {% block javascript %}
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        {% javascripts '@ImbcWebsiteBundle/Resources/public/js/*' %}
            <script type="text/javascript" src="{{ asset_url }}"></script>
        {% endjavascripts %}
    {% endblock %}
    {{ notify_all( 'notify_container' ) }}
</body>
```

The notification logic is using (humane.js) [http://wavded.github.io/humane-js/]

```
imbc_website:
    click_to_close: true
    lifetime: 5000
    message: 'this is a message'
    title: 'this is a title'
    type: 'flash'                   # default value
    class: 'notice'                 # default value
```

some twig help are available for calling notification:
 * ```{{ notify_all( 'notify_container' ) }}```
 * ```{{ notify_single( 'notify_container' ) }}```