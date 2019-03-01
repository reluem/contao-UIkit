# contao-UIkit

add to root composer.json
```
"require" : {
    "oomphinc/composer-installers-extender": "^1.1"
    },
"extra": {
    "installer-types": [
      "npm-asset"
    ],
    "installer-paths": {
      "assets/{$name}/": [
        "type:npm-asset"
      ]
    }
  },
  "repositories": [
    {
      "type": "composer",
      "url": "https://asset-packagist.org"
    }
  ]
  ```

UIkit assets are loaded automatically with this snippet in the composer.json of this module. 
You need to have the above mentioned requirements in your root json in order to load the ressources from npm-asset.
```
"require" : {
    "npm-asset/uikit": "~3.0"
    },

```

Next, create a custom .scss theme in your files, that you reference in the page layout.
```
// 1. Your custom variables and variable overwrites.
// e.g. $global-primary-background: rgb(0, 48, 135);

// 2. Import default variables and available mixins.
@import "../../assets/uikit/src/scss/variables-theme.scss";
@import "../../assets/uikit/src/scss/mixins-theme.scss";

// 3. Your custom mixin overwrites.

// 4. Import UIkit.
@import "../../assets/uikit/src/scss/uikit-theme.scss";

// 5. Other Custom SCSS


    
