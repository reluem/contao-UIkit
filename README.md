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
