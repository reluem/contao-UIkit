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
  }
  ```

For manual installation, copy the folder to system/modules, clear the cache(!) and run contao/install tool.

UIkit assets can be included automatically by adding the following to the project composer.json:
```
"require" : {
    "npm-asset/uikit": "~3.0"
    }
```

Then create a custom .scss theme in your files, that you reference in the page layout.
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


    
