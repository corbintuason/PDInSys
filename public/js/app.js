/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: C:\\xampp\\htdocs\\PDIS\\package.json: Error while parsing JSON - Unexpected token < in JSON at position 1564\n    at JSON.parse (<anonymous>)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\@babel\\core\\lib\\config\\files\\package.js:57:20\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\@babel\\core\\lib\\config\\files\\utils.js:37:12\n    at Generator.next (<anonymous>)\n    at Function.<anonymous> (C:\\xampp\\htdocs\\PDIS\\node_modules\\@babel\\core\\lib\\gensync-utils\\async.js:26:3)\n    at Generator.next (<anonymous>)\n    at evaluateSync (C:\\xampp\\htdocs\\PDIS\\node_modules\\gensync\\index.js:244:28)\n    at Function.sync (C:\\xampp\\htdocs\\PDIS\\node_modules\\gensync\\index.js:84:14)\n    at sync (C:\\xampp\\htdocs\\PDIS\\node_modules\\@babel\\core\\lib\\gensync-utils\\async.js:66:25)\n    at sync (C:\\xampp\\htdocs\\PDIS\\node_modules\\gensync\\index.js:177:19)\n    at onFirstPause (C:\\xampp\\htdocs\\PDIS\\node_modules\\gensync\\index.js:204:19)\n    at Generator.next (<anonymous>)\n    at cachedFunction (C:\\xampp\\htdocs\\PDIS\\node_modules\\@babel\\core\\lib\\config\\caching.js:68:46)\n    at cachedFunction.next (<anonymous>)\n    at findPackageData (C:\\xampp\\htdocs\\PDIS\\node_modules\\@babel\\core\\lib\\config\\files\\package.js:33:18)\n    at findPackageData.next (<anonymous>)\n    at buildRootChain (C:\\xampp\\htdocs\\PDIS\\node_modules\\@babel\\core\\lib\\config\\config-chain.js:105:92)\n    at buildRootChain.next (<anonymous>)\n    at loadPrivatePartialConfig (C:\\xampp\\htdocs\\PDIS\\node_modules\\@babel\\core\\lib\\config\\partial.js:95:62)\n    at loadPrivatePartialConfig.next (<anonymous>)\n    at Function.<anonymous> (C:\\xampp\\htdocs\\PDIS\\node_modules\\@babel\\core\\lib\\config\\partial.js:120:25)\n    at Generator.next (<anonymous>)\n    at evaluateSync (C:\\xampp\\htdocs\\PDIS\\node_modules\\gensync\\index.js:244:28)\n    at Function.sync (C:\\xampp\\htdocs\\PDIS\\node_modules\\gensync\\index.js:84:14)\n    at Object.<anonymous> (C:\\xampp\\htdocs\\PDIS\\node_modules\\@babel\\core\\lib\\config\\index.js:41:61)\n    at Object.<anonymous> (C:\\xampp\\htdocs\\PDIS\\node_modules\\babel-loader\\lib\\index.js:151:26)\n    at Generator.next (<anonymous>)\n    at asyncGeneratorStep (C:\\xampp\\htdocs\\PDIS\\node_modules\\babel-loader\\lib\\index.js:3:103)\n    at _next (C:\\xampp\\htdocs\\PDIS\\node_modules\\babel-loader\\lib\\index.js:5:194)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\babel-loader\\lib\\index.js:5:364\n    at new Promise (<anonymous>)\n    at Object.<anonymous> (C:\\xampp\\htdocs\\PDIS\\node_modules\\babel-loader\\lib\\index.js:5:97)\n    at Object.loader (C:\\xampp\\htdocs\\PDIS\\node_modules\\babel-loader\\lib\\index.js:64:18)\n    at Object.<anonymous> (C:\\xampp\\htdocs\\PDIS\\node_modules\\babel-loader\\lib\\index.js:59:12)");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/css-loader/index.js):\nModuleNotFoundError: Module not found: Error: Can't resolve '@mdi/font/css/materialdesignicons.min.css' in 'C:\\xampp\\htdocs\\PDIS\\resources\\sass'\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\webpack\\lib\\Compilation.js:925:10\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\webpack\\lib\\NormalModuleFactory.js:401:22\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\webpack\\lib\\NormalModuleFactory.js:130:21\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\webpack\\lib\\NormalModuleFactory.js:224:22\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\neo-async\\async.js:2830:7\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\neo-async\\async.js:6877:13\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\webpack\\lib\\NormalModuleFactory.js:214:25\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:213:14\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:13:1)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\UnsafeCachePlugin.js:44:7\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:13:1)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:25:1)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\DescriptionFilePlugin.js:67:43\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:26:1)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\ModuleKindPlugin.js:30:40\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:13:1)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:13:1)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\forEachBail.js:30:14\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:13:1)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\UnsafeCachePlugin.js:44:7\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:13:1)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:25:1)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\DescriptionFilePlugin.js:67:43\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:14:1)\n    at C:\\xampp\\htdocs\\PDIS\\node_modules\\enhanced-resolve\\lib\\Resolver.js:285:5\n    at eval (eval at create (C:\\xampp\\htdocs\\PDIS\\node_modules\\tapable\\lib\\HookCodeFactory.js:33:10), <anonymous>:25:1)");

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\PDIS\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\PDIS\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });