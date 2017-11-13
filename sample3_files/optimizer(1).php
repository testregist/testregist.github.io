/**
 * i18n - Javascript Internationalization System
 *
 * @author Platform Team
 */

(function() {
    var $i18n = {

        /**
         * Messages
         * @var array
         * {
         *     'DOMAIN NAME' : {
         *         'KEY NAME' : 'value',
         *         'KEY NAME(Plurals) : ['value', 'value', ...]
         *         ...
         *     },
         *     ...
         * }
         */
        _lang : {},

        /**
         * Plurals Expressions
         * @var array
         * {
         *     'DOMAIN NAME' : function(n) {
         *         expressions
         *     },
         *     ...
         * }
         */
        _pluralsExp : {},

        /**
         * Current Domain
         * @var string
         */
        _currDomain : false,

        /**
         * override the current domain for a single message lookup
         *
         * @param string domain
         * @param string key
         * @return string
         */
        __d : function(domain, key, __idx__) {

            var t = $i18n._lang;

            if ($i18n._isEmpty(t) === true) {
                return key;
            }

            if (typeof t[domain] == 'undefined') {
                return key;
            }

            if (typeof t[domain][key] == 'undefined') {
                return key;
            }

            if (typeof t[domain][key] == 'object') {
                __idx__ = __idx__ ? __idx__ : 0;
                return t[domain][key][__idx__];
            }

            return t[domain][key];

        },

        /**
         * Plural version of __d
         *
         * @param string domain
         * @param string key1
         * @param string key2
         * @param int cnt
         * @return string
         */
        __dn : function(domain, key1, key2, cnt) {

            var n = parseInt(cnt);
            var idx = $i18n._getPluralsIndex(domain, n);

            if (idx == 0) {
                return $i18n.__d(domain, key1, 0);
            } else {
                return $i18n.__d(domain, key2, idx);
            }
        },

        _init : function() {
            $i18n._pluralsExp.__reserved_default_exp__ = function(n) {
                return n == 1 ? 0 : 1;
            };

            window['__d'] = function(domain, key) {
                return $i18n.__d(domain, key, 0);
            };

            window['__dn'] = function(domain, key1, key2, cnt) {
                return $i18n.__dn(domain, key1, key2, cnt);
            };

            window['__'] = function(key) {
                return $i18n.__d($i18n._currDomain, key, 0);
            };

            window['__n'] = function(key1, key2, cnt) {
                return $i18n.__dn($i18n._currDomain, key1, key2, cnt);
            };

            window['__i18n_regist__']           = this._regist;
            window['__i18n_bind__']             = this._bind;
            window['__i18n_plurals_exp_bind__'] = this._pluralsExpBind;
        },

        _isEmpty : function(val) {

            if (!val) return true;
            if (val == null) return true;
            if (val == undefined) return true;
            if (val == '') return true;
            if (typeof val == 'object') {
                for (var i in val) {
                    return false;
                }

                return true;
            }

            return false;

        },

        _trim : function(str) {
            if(typeof str != 'string') return '';

            return str.replace(/(^\s*)|(\s*$)/g, '');
        },

        _apply : function(method, func) {

            this[method] = func;

        },

        _regist : function(lang) {

            if (typeof lang != 'object') return false;

            $i18n._lang = lang;

            return true;

        },

        _bind : function(domain) {

            if ($i18n._isEmpty(domain) === true) return false;

            $i18n._currDomain = domain;

            return true;

        },

        _pluralsExpBind : function(domain, exp) {
            if (typeof exp != 'function') {
                return;
            }

            $i18n._pluralsExp[domain] = exp;
        },

        _getPluralsIndex : function(domain, n) {
            if (typeof $i18n._pluralsExp[domain] == 'undefined') {
                return $i18n._pluralsExp.__reserved_default_exp__(n);
            }

            return $i18n._pluralsExp[domain](n);
        }
    };

    $i18n._init();
})();
__i18n_regist__({"front":{"__VERSION__":"198"}});__i18n_bind__("front");
/*!
 * jQuery JavaScript Library v1.4.4
 * http://jquery.com/
 *
 * Copyright 2010, John Resig
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 * Copyright 2010, The Dojo Foundation
 * Released under the MIT, BSD, and GPL Licenses.
 *
 * Date: Thu Nov 11 19:04:53 2010 -0500
 */
(function(E,B){function ka(a,b,d){if(d===B&&a.nodeType===1){d=a.getAttribute("data-"+b);if(typeof d==="string"){try{d=d==="true"?true:d==="false"?false:d==="null"?null:!c.isNaN(d)?parseFloat(d):Ja.test(d)?c.parseJSON(d):d}catch(e){}c.data(a,b,d)}else d=B}return d}function U(){return false}function ca(){return true}function la(a,b,d){d[0].type=a;return c.event.handle.apply(b,d)}function Ka(a){var b,d,e,f,h,l,k,o,x,r,A,C=[];f=[];h=c.data(this,this.nodeType?"events":"__events__");if(typeof h==="function")h=
h.events;if(!(a.liveFired===this||!h||!h.live||a.button&&a.type==="click")){if(a.namespace)A=RegExp("(^|\\.)"+a.namespace.split(".").join("\\.(?:.*\\.)?")+"(\\.|$)");a.liveFired=this;var J=h.live.slice(0);for(k=0;k<J.length;k++){h=J[k];h.origType.replace(X,"")===a.type?f.push(h.selector):J.splice(k--,1)}f=c(a.target).closest(f,a.currentTarget);o=0;for(x=f.length;o<x;o++){r=f[o];for(k=0;k<J.length;k++){h=J[k];if(r.selector===h.selector&&(!A||A.test(h.namespace))){l=r.elem;e=null;if(h.preType==="mouseenter"||
h.preType==="mouseleave"){a.type=h.preType;e=c(a.relatedTarget).closest(h.selector)[0]}if(!e||e!==l)C.push({elem:l,handleObj:h,level:r.level})}}}o=0;for(x=C.length;o<x;o++){f=C[o];if(d&&f.level>d)break;a.currentTarget=f.elem;a.data=f.handleObj.data;a.handleObj=f.handleObj;A=f.handleObj.origHandler.apply(f.elem,arguments);if(A===false||a.isPropagationStopped()){d=f.level;if(A===false)b=false;if(a.isImmediatePropagationStopped())break}}return b}}function Y(a,b){return(a&&a!=="*"?a+".":"")+b.replace(La,
"`").replace(Ma,"&")}function ma(a,b,d){if(c.isFunction(b))return c.grep(a,function(f,h){return!!b.call(f,h,f)===d});else if(b.nodeType)return c.grep(a,function(f){return f===b===d});else if(typeof b==="string"){var e=c.grep(a,function(f){return f.nodeType===1});if(Na.test(b))return c.filter(b,e,!d);else b=c.filter(b,e)}return c.grep(a,function(f){return c.inArray(f,b)>=0===d})}function na(a,b){var d=0;b.each(function(){if(this.nodeName===(a[d]&&a[d].nodeName)){var e=c.data(a[d++]),f=c.data(this,
e);if(e=e&&e.events){delete f.handle;f.events={};for(var h in e)for(var l in e[h])c.event.add(this,h,e[h][l],e[h][l].data)}}})}function Oa(a,b){b.src?c.ajax({url:b.src,async:false,dataType:"script"}):c.globalEval(b.text||b.textContent||b.innerHTML||"");b.parentNode&&b.parentNode.removeChild(b)}function oa(a,b,d){var e=b==="width"?a.offsetWidth:a.offsetHeight;if(d==="border")return e;c.each(b==="width"?Pa:Qa,function(){d||(e-=parseFloat(c.css(a,"padding"+this))||0);if(d==="margin")e+=parseFloat(c.css(a,
"margin"+this))||0;else e-=parseFloat(c.css(a,"border"+this+"Width"))||0});return e}function da(a,b,d,e){if(c.isArray(b)&&b.length)c.each(b,function(f,h){d||Ra.test(a)?e(a,h):da(a+"["+(typeof h==="object"||c.isArray(h)?f:"")+"]",h,d,e)});else if(!d&&b!=null&&typeof b==="object")c.isEmptyObject(b)?e(a,""):c.each(b,function(f,h){da(a+"["+f+"]",h,d,e)});else e(a,b)}function S(a,b){var d={};c.each(pa.concat.apply([],pa.slice(0,b)),function(){d[this]=a});return d}function qa(a){if(!ea[a]){var b=c("<"+
a+">").appendTo("body"),d=b.css("display");b.remove();if(d==="none"||d==="")d="block";ea[a]=d}return ea[a]}function fa(a){return c.isWindow(a)?a:a.nodeType===9?a.defaultView||a.parentWindow:false}var t=E.document,c=function(){function a(){if(!b.isReady){try{t.documentElement.doScroll("left")}catch(j){setTimeout(a,1);return}b.ready()}}var b=function(j,s){return new b.fn.init(j,s)},d=E.jQuery,e=E.$,f,h=/^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]+)$)/,l=/\S/,k=/^\s+/,o=/\s+$/,x=/\W/,r=/\d/,A=/^<(\w+)\s*\/?>(?:<\/\1>)?$/,
C=/^[\],:{}\s]*$/,J=/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,w=/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,I=/(?:^|:|,)(?:\s*\[)+/g,L=/(webkit)[ \/]([\w.]+)/,g=/(opera)(?:.*version)?[ \/]([\w.]+)/,i=/(msie) ([\w.]+)/,n=/(mozilla)(?:.*? rv:([\w.]+))?/,m=navigator.userAgent,p=false,q=[],u,y=Object.prototype.toString,F=Object.prototype.hasOwnProperty,M=Array.prototype.push,N=Array.prototype.slice,O=String.prototype.trim,D=Array.prototype.indexOf,R={};b.fn=b.prototype={init:function(j,
s){var v,z,H;if(!j)return this;if(j.nodeType){this.context=this[0]=j;this.length=1;return this}if(j==="body"&&!s&&t.body){this.context=t;this[0]=t.body;this.selector="body";this.length=1;return this}if(typeof j==="string")if((v=h.exec(j))&&(v[1]||!s))if(v[1]){H=s?s.ownerDocument||s:t;if(z=A.exec(j))if(b.isPlainObject(s)){j=[t.createElement(z[1])];b.fn.attr.call(j,s,true)}else j=[H.createElement(z[1])];else{z=b.buildFragment([v[1]],[H]);j=(z.cacheable?z.fragment.cloneNode(true):z.fragment).childNodes}return b.merge(this,
j)}else{if((z=t.getElementById(v[2]))&&z.parentNode){if(z.id!==v[2])return f.find(j);this.length=1;this[0]=z}this.context=t;this.selector=j;return this}else if(!s&&!x.test(j)){this.selector=j;this.context=t;j=t.getElementsByTagName(j);return b.merge(this,j)}else return!s||s.jquery?(s||f).find(j):b(s).find(j);else if(b.isFunction(j))return f.ready(j);if(j.selector!==B){this.selector=j.selector;this.context=j.context}return b.makeArray(j,this)},selector:"",jquery:"1.4.4",length:0,size:function(){return this.length},
toArray:function(){return N.call(this,0)},get:function(j){return j==null?this.toArray():j<0?this.slice(j)[0]:this[j]},pushStack:function(j,s,v){var z=b();b.isArray(j)?M.apply(z,j):b.merge(z,j);z.prevObject=this;z.context=this.context;if(s==="find")z.selector=this.selector+(this.selector?" ":"")+v;else if(s)z.selector=this.selector+"."+s+"("+v+")";return z},each:function(j,s){return b.each(this,j,s)},ready:function(j){b.bindReady();if(b.isReady)j.call(t,b);else q&&q.push(j);return this},eq:function(j){return j===
-1?this.slice(j):this.slice(j,+j+1)},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},slice:function(){return this.pushStack(N.apply(this,arguments),"slice",N.call(arguments).join(","))},map:function(j){return this.pushStack(b.map(this,function(s,v){return j.call(s,v,s)}))},end:function(){return this.prevObject||b(null)},push:M,sort:[].sort,splice:[].splice};b.fn.init.prototype=b.fn;b.extend=b.fn.extend=function(){var j,s,v,z,H,G=arguments[0]||{},K=1,Q=arguments.length,ga=false;
if(typeof G==="boolean"){ga=G;G=arguments[1]||{};K=2}if(typeof G!=="object"&&!b.isFunction(G))G={};if(Q===K){G=this;--K}for(;K<Q;K++)if((j=arguments[K])!=null)for(s in j){v=G[s];z=j[s];if(G!==z)if(ga&&z&&(b.isPlainObject(z)||(H=b.isArray(z)))){if(H){H=false;v=v&&b.isArray(v)?v:[]}else v=v&&b.isPlainObject(v)?v:{};G[s]=b.extend(ga,v,z)}else if(z!==B)G[s]=z}return G};b.extend({noConflict:function(j){E.$=e;if(j)E.jQuery=d;return b},isReady:false,readyWait:1,ready:function(j){j===true&&b.readyWait--;
if(!b.readyWait||j!==true&&!b.isReady){if(!t.body)return setTimeout(b.ready,1);b.isReady=true;if(!(j!==true&&--b.readyWait>0))if(q){var s=0,v=q;for(q=null;j=v[s++];)j.call(t,b);b.fn.trigger&&b(t).trigger("ready").unbind("ready")}}},bindReady:function(){if(!p){p=true;if(t.readyState==="complete")return setTimeout(b.ready,1);if(t.addEventListener){t.addEventListener("DOMContentLoaded",u,false);E.addEventListener("load",b.ready,false)}else if(t.attachEvent){t.attachEvent("onreadystatechange",u);E.attachEvent("onload",
b.ready);var j=false;try{j=E.frameElement==null}catch(s){}t.documentElement.doScroll&&j&&a()}}},isFunction:function(j){return b.type(j)==="function"},isArray:Array.isArray||function(j){return b.type(j)==="array"},isWindow:function(j){return j&&typeof j==="object"&&"setInterval"in j},isNaN:function(j){return j==null||!r.test(j)||isNaN(j)},type:function(j){return j==null?String(j):R[y.call(j)]||"object"},isPlainObject:function(j){if(!j||b.type(j)!=="object"||j.nodeType||b.isWindow(j))return false;if(j.constructor&&
!F.call(j,"constructor")&&!F.call(j.constructor.prototype,"isPrototypeOf"))return false;for(var s in j);return s===B||F.call(j,s)},isEmptyObject:function(j){for(var s in j)return false;return true},error:function(j){throw j;},parseJSON:function(j){if(typeof j!=="string"||!j)return null;j=b.trim(j);if(C.test(j.replace(J,"@").replace(w,"]").replace(I,"")))return E.JSON&&E.JSON.parse?E.JSON.parse(j):(new Function("return "+j))();else b.error("Invalid JSON: "+j)},noop:function(){},globalEval:function(j){if(j&&
l.test(j)){var s=t.getElementsByTagName("head")[0]||t.documentElement,v=t.createElement("script");v.type="text/javascript";if(b.support.scriptEval)v.appendChild(t.createTextNode(j));else v.text=j;s.insertBefore(v,s.firstChild);s.removeChild(v)}},nodeName:function(j,s){return j.nodeName&&j.nodeName.toUpperCase()===s.toUpperCase()},each:function(j,s,v){var z,H=0,G=j.length,K=G===B||b.isFunction(j);if(v)if(K)for(z in j){if(s.apply(j[z],v)===false)break}else for(;H<G;){if(s.apply(j[H++],v)===false)break}else if(K)for(z in j){if(s.call(j[z],
z,j[z])===false)break}else for(v=j[0];H<G&&s.call(v,H,v)!==false;v=j[++H]);return j},trim:O?function(j){return j==null?"":O.call(j)}:function(j){return j==null?"":j.toString().replace(k,"").replace(o,"")},makeArray:function(j,s){var v=s||[];if(j!=null){var z=b.type(j);j.length==null||z==="string"||z==="function"||z==="regexp"||b.isWindow(j)?M.call(v,j):b.merge(v,j)}return v},inArray:function(j,s){if(s.indexOf)return s.indexOf(j);for(var v=0,z=s.length;v<z;v++)if(s[v]===j)return v;return-1},merge:function(j,
s){var v=j.length,z=0;if(typeof s.length==="number")for(var H=s.length;z<H;z++)j[v++]=s[z];else for(;s[z]!==B;)j[v++]=s[z++];j.length=v;return j},grep:function(j,s,v){var z=[],H;v=!!v;for(var G=0,K=j.length;G<K;G++){H=!!s(j[G],G);v!==H&&z.push(j[G])}return z},map:function(j,s,v){for(var z=[],H,G=0,K=j.length;G<K;G++){H=s(j[G],G,v);if(H!=null)z[z.length]=H}return z.concat.apply([],z)},guid:1,proxy:function(j,s,v){if(arguments.length===2)if(typeof s==="string"){v=j;j=v[s];s=B}else if(s&&!b.isFunction(s)){v=
s;s=B}if(!s&&j)s=function(){return j.apply(v||this,arguments)};if(j)s.guid=j.guid=j.guid||s.guid||b.guid++;return s},access:function(j,s,v,z,H,G){var K=j.length;if(typeof s==="object"){for(var Q in s)b.access(j,Q,s[Q],z,H,v);return j}if(v!==B){z=!G&&z&&b.isFunction(v);for(Q=0;Q<K;Q++)H(j[Q],s,z?v.call(j[Q],Q,H(j[Q],s)):v,G);return j}return K?H(j[0],s):B},now:function(){return(new Date).getTime()},uaMatch:function(j){j=j.toLowerCase();j=L.exec(j)||g.exec(j)||i.exec(j)||j.indexOf("compatible")<0&&n.exec(j)||
[];return{browser:j[1]||"",version:j[2]||"0"}},browser:{}});b.each("Boolean Number String Function Array Date RegExp Object".split(" "),function(j,s){R["[object "+s+"]"]=s.toLowerCase()});m=b.uaMatch(m);if(m.browser){b.browser[m.browser]=true;b.browser.version=m.version}if(b.browser.webkit)b.browser.safari=true;if(D)b.inArray=function(j,s){return D.call(s,j)};if(!/\s/.test("\u00a0")){k=/^[\s\xA0]+/;o=/[\s\xA0]+$/}f=b(t);if(t.addEventListener)u=function(){t.removeEventListener("DOMContentLoaded",u,
false);b.ready()};else if(t.attachEvent)u=function(){if(t.readyState==="complete"){t.detachEvent("onreadystatechange",u);b.ready()}};return E.jQuery=E.$=b}();(function(){c.support={};var a=t.documentElement,b=t.createElement("script"),d=t.createElement("div"),e="script"+c.now();d.style.display="none";d.innerHTML="   <link/><table></table><a href='/a' style='color:red;float:left;opacity:.55;'>a</a><input type='checkbox'/>";var f=d.getElementsByTagName("*"),h=d.getElementsByTagName("a")[0],l=t.createElement("select"),
k=l.appendChild(t.createElement("option"));if(!(!f||!f.length||!h)){c.support={leadingWhitespace:d.firstChild.nodeType===3,tbody:!d.getElementsByTagName("tbody").length,htmlSerialize:!!d.getElementsByTagName("link").length,style:/red/.test(h.getAttribute("style")),hrefNormalized:h.getAttribute("href")==="/a",opacity:/^0.55$/.test(h.style.opacity),cssFloat:!!h.style.cssFloat,checkOn:d.getElementsByTagName("input")[0].value==="on",optSelected:k.selected,deleteExpando:true,optDisabled:false,checkClone:false,
scriptEval:false,noCloneEvent:true,boxModel:null,inlineBlockNeedsLayout:false,shrinkWrapBlocks:false,reliableHiddenOffsets:true};l.disabled=true;c.support.optDisabled=!k.disabled;b.type="text/javascript";try{b.appendChild(t.createTextNode("window."+e+"=1;"))}catch(o){}a.insertBefore(b,a.firstChild);if(E[e]){c.support.scriptEval=true;delete E[e]}try{delete b.test}catch(x){c.support.deleteExpando=false}a.removeChild(b);if(d.attachEvent&&d.fireEvent){d.attachEvent("onclick",function r(){c.support.noCloneEvent=
false;d.detachEvent("onclick",r)});d.cloneNode(true).fireEvent("onclick")}d=t.createElement("div");d.innerHTML="<input type='radio' name='radiotest' checked='checked'/>";a=t.createDocumentFragment();a.appendChild(d.firstChild);c.support.checkClone=a.cloneNode(true).cloneNode(true).lastChild.checked;c(function(){var r=t.createElement("div");r.style.width=r.style.paddingLeft="1px";t.body.appendChild(r);c.boxModel=c.support.boxModel=r.offsetWidth===2;if("zoom"in r.style){r.style.display="inline";r.style.zoom=
1;c.support.inlineBlockNeedsLayout=r.offsetWidth===2;r.style.display="";r.innerHTML="<div style='width:4px;'></div>";c.support.shrinkWrapBlocks=r.offsetWidth!==2}r.innerHTML="<table><tr><td style='padding:0;display:none'></td><td>t</td></tr></table>";var A=r.getElementsByTagName("td");c.support.reliableHiddenOffsets=A[0].offsetHeight===0;A[0].style.display="";A[1].style.display="none";c.support.reliableHiddenOffsets=c.support.reliableHiddenOffsets&&A[0].offsetHeight===0;r.innerHTML="";t.body.removeChild(r).style.display=
"none"});a=function(r){var A=t.createElement("div");r="on"+r;var C=r in A;if(!C){A.setAttribute(r,"return;");C=typeof A[r]==="function"}return C};c.support.submitBubbles=a("submit");c.support.changeBubbles=a("change");a=b=d=f=h=null}})();var ra={},Ja=/^(?:\{.*\}|\[.*\])$/;c.extend({cache:{},uuid:0,expando:"jQuery"+c.now(),noData:{embed:true,object:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",applet:true},data:function(a,b,d){if(c.acceptData(a)){a=a==E?ra:a;var e=a.nodeType,f=e?a[c.expando]:null,h=
c.cache;if(!(e&&!f&&typeof b==="string"&&d===B)){if(e)f||(a[c.expando]=f=++c.uuid);else h=a;if(typeof b==="object")if(e)h[f]=c.extend(h[f],b);else c.extend(h,b);else if(e&&!h[f])h[f]={};a=e?h[f]:h;if(d!==B)a[b]=d;return typeof b==="string"?a[b]:a}}},removeData:function(a,b){if(c.acceptData(a)){a=a==E?ra:a;var d=a.nodeType,e=d?a[c.expando]:a,f=c.cache,h=d?f[e]:e;if(b){if(h){delete h[b];d&&c.isEmptyObject(h)&&c.removeData(a)}}else if(d&&c.support.deleteExpando)delete a[c.expando];else if(a.removeAttribute)a.removeAttribute(c.expando);
else if(d)delete f[e];else for(var l in a)delete a[l]}},acceptData:function(a){if(a.nodeName){var b=c.noData[a.nodeName.toLowerCase()];if(b)return!(b===true||a.getAttribute("classid")!==b)}return true}});c.fn.extend({data:function(a,b){var d=null;if(typeof a==="undefined"){if(this.length){var e=this[0].attributes,f;d=c.data(this[0]);for(var h=0,l=e.length;h<l;h++){f=e[h].name;if(f.indexOf("data-")===0){f=f.substr(5);ka(this[0],f,d[f])}}}return d}else if(typeof a==="object")return this.each(function(){c.data(this,
a)});var k=a.split(".");k[1]=k[1]?"."+k[1]:"";if(b===B){d=this.triggerHandler("getData"+k[1]+"!",[k[0]]);if(d===B&&this.length){d=c.data(this[0],a);d=ka(this[0],a,d)}return d===B&&k[1]?this.data(k[0]):d}else return this.each(function(){var o=c(this),x=[k[0],b];o.triggerHandler("setData"+k[1]+"!",x);c.data(this,a,b);o.triggerHandler("changeData"+k[1]+"!",x)})},removeData:function(a){return this.each(function(){c.removeData(this,a)})}});c.extend({queue:function(a,b,d){if(a){b=(b||"fx")+"queue";var e=
c.data(a,b);if(!d)return e||[];if(!e||c.isArray(d))e=c.data(a,b,c.makeArray(d));else e.push(d);return e}},dequeue:function(a,b){b=b||"fx";var d=c.queue(a,b),e=d.shift();if(e==="inprogress")e=d.shift();if(e){b==="fx"&&d.unshift("inprogress");e.call(a,function(){c.dequeue(a,b)})}}});c.fn.extend({queue:function(a,b){if(typeof a!=="string"){b=a;a="fx"}if(b===B)return c.queue(this[0],a);return this.each(function(){var d=c.queue(this,a,b);a==="fx"&&d[0]!=="inprogress"&&c.dequeue(this,a)})},dequeue:function(a){return this.each(function(){c.dequeue(this,
a)})},delay:function(a,b){a=c.fx?c.fx.speeds[a]||a:a;b=b||"fx";return this.queue(b,function(){var d=this;setTimeout(function(){c.dequeue(d,b)},a)})},clearQueue:function(a){return this.queue(a||"fx",[])}});var sa=/[\n\t]/g,ha=/\s+/,Sa=/\r/g,Ta=/^(?:href|src|style)$/,Ua=/^(?:button|input)$/i,Va=/^(?:button|input|object|select|textarea)$/i,Wa=/^a(?:rea)?$/i,ta=/^(?:radio|checkbox)$/i;c.props={"for":"htmlFor","class":"className",readonly:"readOnly",maxlength:"maxLength",cellspacing:"cellSpacing",rowspan:"rowSpan",
colspan:"colSpan",tabindex:"tabIndex",usemap:"useMap",frameborder:"frameBorder"};c.fn.extend({attr:function(a,b){return c.access(this,a,b,true,c.attr)},removeAttr:function(a){return this.each(function(){c.attr(this,a,"");this.nodeType===1&&this.removeAttribute(a)})},addClass:function(a){if(c.isFunction(a))return this.each(function(x){var r=c(this);r.addClass(a.call(this,x,r.attr("class")))});if(a&&typeof a==="string")for(var b=(a||"").split(ha),d=0,e=this.length;d<e;d++){var f=this[d];if(f.nodeType===
1)if(f.className){for(var h=" "+f.className+" ",l=f.className,k=0,o=b.length;k<o;k++)if(h.indexOf(" "+b[k]+" ")<0)l+=" "+b[k];f.className=c.trim(l)}else f.className=a}return this},removeClass:function(a){if(c.isFunction(a))return this.each(function(o){var x=c(this);x.removeClass(a.call(this,o,x.attr("class")))});if(a&&typeof a==="string"||a===B)for(var b=(a||"").split(ha),d=0,e=this.length;d<e;d++){var f=this[d];if(f.nodeType===1&&f.className)if(a){for(var h=(" "+f.className+" ").replace(sa," "),
l=0,k=b.length;l<k;l++)h=h.replace(" "+b[l]+" "," ");f.className=c.trim(h)}else f.className=""}return this},toggleClass:function(a,b){var d=typeof a,e=typeof b==="boolean";if(c.isFunction(a))return this.each(function(f){var h=c(this);h.toggleClass(a.call(this,f,h.attr("class"),b),b)});return this.each(function(){if(d==="string")for(var f,h=0,l=c(this),k=b,o=a.split(ha);f=o[h++];){k=e?k:!l.hasClass(f);l[k?"addClass":"removeClass"](f)}else if(d==="undefined"||d==="boolean"){this.className&&c.data(this,
"__className__",this.className);this.className=this.className||a===false?"":c.data(this,"__className__")||""}})},hasClass:function(a){a=" "+a+" ";for(var b=0,d=this.length;b<d;b++)if((" "+this[b].className+" ").replace(sa," ").indexOf(a)>-1)return true;return false},val:function(a){if(!arguments.length){var b=this[0];if(b){if(c.nodeName(b,"option")){var d=b.attributes.value;return!d||d.specified?b.value:b.text}if(c.nodeName(b,"select")){var e=b.selectedIndex;d=[];var f=b.options;b=b.type==="select-one";
if(e<0)return null;var h=b?e:0;for(e=b?e+1:f.length;h<e;h++){var l=f[h];if(l.selected&&(c.support.optDisabled?!l.disabled:l.getAttribute("disabled")===null)&&(!l.parentNode.disabled||!c.nodeName(l.parentNode,"optgroup"))){a=c(l).val();if(b)return a;d.push(a)}}return d}if(ta.test(b.type)&&!c.support.checkOn)return b.getAttribute("value")===null?"on":b.value;return(b.value||"").replace(Sa,"")}return B}var k=c.isFunction(a);return this.each(function(o){var x=c(this),r=a;if(this.nodeType===1){if(k)r=
a.call(this,o,x.val());if(r==null)r="";else if(typeof r==="number")r+="";else if(c.isArray(r))r=c.map(r,function(C){return C==null?"":C+""});if(c.isArray(r)&&ta.test(this.type))this.checked=c.inArray(x.val(),r)>=0;else if(c.nodeName(this,"select")){var A=c.makeArray(r);c("option",this).each(function(){this.selected=c.inArray(c(this).val(),A)>=0});if(!A.length)this.selectedIndex=-1}else this.value=r}})}});c.extend({attrFn:{val:true,css:true,html:true,text:true,data:true,width:true,height:true,offset:true},
attr:function(a,b,d,e){if(!a||a.nodeType===3||a.nodeType===8)return B;if(e&&b in c.attrFn)return c(a)[b](d);e=a.nodeType!==1||!c.isXMLDoc(a);var f=d!==B;b=e&&c.props[b]||b;var h=Ta.test(b);if((b in a||a[b]!==B)&&e&&!h){if(f){b==="type"&&Ua.test(a.nodeName)&&a.parentNode&&c.error("type property can't be changed");if(d===null)a.nodeType===1&&a.removeAttribute(b);else a[b]=d}if(c.nodeName(a,"form")&&a.getAttributeNode(b))return a.getAttributeNode(b).nodeValue;if(b==="tabIndex")return(b=a.getAttributeNode("tabIndex"))&&
b.specified?b.value:Va.test(a.nodeName)||Wa.test(a.nodeName)&&a.href?0:B;return a[b]}if(!c.support.style&&e&&b==="style"){if(f)a.style.cssText=""+d;return a.style.cssText}f&&a.setAttribute(b,""+d);if(!a.attributes[b]&&a.hasAttribute&&!a.hasAttribute(b))return B;a=!c.support.hrefNormalized&&e&&h?a.getAttribute(b,2):a.getAttribute(b);return a===null?B:a}});var X=/\.(.*)$/,ia=/^(?:textarea|input|select)$/i,La=/\./g,Ma=/ /g,Xa=/[^\w\s.|`]/g,Ya=function(a){return a.replace(Xa,"\\$&")},ua={focusin:0,focusout:0};
c.event={add:function(a,b,d,e){if(!(a.nodeType===3||a.nodeType===8)){if(c.isWindow(a)&&a!==E&&!a.frameElement)a=E;if(d===false)d=U;else if(!d)return;var f,h;if(d.handler){f=d;d=f.handler}if(!d.guid)d.guid=c.guid++;if(h=c.data(a)){var l=a.nodeType?"events":"__events__",k=h[l],o=h.handle;if(typeof k==="function"){o=k.handle;k=k.events}else if(!k){a.nodeType||(h[l]=h=function(){});h.events=k={}}if(!o)h.handle=o=function(){return typeof c!=="undefined"&&!c.event.triggered?c.event.handle.apply(o.elem,
arguments):B};o.elem=a;b=b.split(" ");for(var x=0,r;l=b[x++];){h=f?c.extend({},f):{handler:d,data:e};if(l.indexOf(".")>-1){r=l.split(".");l=r.shift();h.namespace=r.slice(0).sort().join(".")}else{r=[];h.namespace=""}h.type=l;if(!h.guid)h.guid=d.guid;var A=k[l],C=c.event.special[l]||{};if(!A){A=k[l]=[];if(!C.setup||C.setup.call(a,e,r,o)===false)if(a.addEventListener)a.addEventListener(l,o,false);else a.attachEvent&&a.attachEvent("on"+l,o)}if(C.add){C.add.call(a,h);if(!h.handler.guid)h.handler.guid=
d.guid}A.push(h);c.event.global[l]=true}a=null}}},global:{},remove:function(a,b,d,e){if(!(a.nodeType===3||a.nodeType===8)){if(d===false)d=U;var f,h,l=0,k,o,x,r,A,C,J=a.nodeType?"events":"__events__",w=c.data(a),I=w&&w[J];if(w&&I){if(typeof I==="function"){w=I;I=I.events}if(b&&b.type){d=b.handler;b=b.type}if(!b||typeof b==="string"&&b.charAt(0)==="."){b=b||"";for(f in I)c.event.remove(a,f+b)}else{for(b=b.split(" ");f=b[l++];){r=f;k=f.indexOf(".")<0;o=[];if(!k){o=f.split(".");f=o.shift();x=RegExp("(^|\\.)"+
c.map(o.slice(0).sort(),Ya).join("\\.(?:.*\\.)?")+"(\\.|$)")}if(A=I[f])if(d){r=c.event.special[f]||{};for(h=e||0;h<A.length;h++){C=A[h];if(d.guid===C.guid){if(k||x.test(C.namespace)){e==null&&A.splice(h--,1);r.remove&&r.remove.call(a,C)}if(e!=null)break}}if(A.length===0||e!=null&&A.length===1){if(!r.teardown||r.teardown.call(a,o)===false)c.removeEvent(a,f,w.handle);delete I[f]}}else for(h=0;h<A.length;h++){C=A[h];if(k||x.test(C.namespace)){c.event.remove(a,r,C.handler,h);A.splice(h--,1)}}}if(c.isEmptyObject(I)){if(b=
w.handle)b.elem=null;delete w.events;delete w.handle;if(typeof w==="function")c.removeData(a,J);else c.isEmptyObject(w)&&c.removeData(a)}}}}},trigger:function(a,b,d,e){var f=a.type||a;if(!e){a=typeof a==="object"?a[c.expando]?a:c.extend(c.Event(f),a):c.Event(f);if(f.indexOf("!")>=0){a.type=f=f.slice(0,-1);a.exclusive=true}if(!d){a.stopPropagation();c.event.global[f]&&c.each(c.cache,function(){this.events&&this.events[f]&&c.event.trigger(a,b,this.handle.elem)})}if(!d||d.nodeType===3||d.nodeType===
8)return B;a.result=B;a.target=d;b=c.makeArray(b);b.unshift(a)}a.currentTarget=d;(e=d.nodeType?c.data(d,"handle"):(c.data(d,"__events__")||{}).handle)&&e.apply(d,b);e=d.parentNode||d.ownerDocument;try{if(!(d&&d.nodeName&&c.noData[d.nodeName.toLowerCase()]))if(d["on"+f]&&d["on"+f].apply(d,b)===false){a.result=false;a.preventDefault()}}catch(h){}if(!a.isPropagationStopped()&&e)c.event.trigger(a,b,e,true);else if(!a.isDefaultPrevented()){var l;e=a.target;var k=f.replace(X,""),o=c.nodeName(e,"a")&&k===
"click",x=c.event.special[k]||{};if((!x._default||x._default.call(d,a)===false)&&!o&&!(e&&e.nodeName&&c.noData[e.nodeName.toLowerCase()])){try{if(e[k]){if(l=e["on"+k])e["on"+k]=null;c.event.triggered=true;e[k]()}}catch(r){}if(l)e["on"+k]=l;c.event.triggered=false}}},handle:function(a){var b,d,e,f;d=[];var h=c.makeArray(arguments);a=h[0]=c.event.fix(a||E.event);a.currentTarget=this;b=a.type.indexOf(".")<0&&!a.exclusive;if(!b){e=a.type.split(".");a.type=e.shift();d=e.slice(0).sort();e=RegExp("(^|\\.)"+
d.join("\\.(?:.*\\.)?")+"(\\.|$)")}a.namespace=a.namespace||d.join(".");f=c.data(this,this.nodeType?"events":"__events__");if(typeof f==="function")f=f.events;d=(f||{})[a.type];if(f&&d){d=d.slice(0);f=0;for(var l=d.length;f<l;f++){var k=d[f];if(b||e.test(k.namespace)){a.handler=k.handler;a.data=k.data;a.handleObj=k;k=k.handler.apply(this,h);if(k!==B){a.result=k;if(k===false){a.preventDefault();a.stopPropagation()}}if(a.isImmediatePropagationStopped())break}}}return a.result},props:"altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode layerX layerY metaKey newValue offsetX offsetY pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which".split(" "),
fix:function(a){if(a[c.expando])return a;var b=a;a=c.Event(b);for(var d=this.props.length,e;d;){e=this.props[--d];a[e]=b[e]}if(!a.target)a.target=a.srcElement||t;if(a.target.nodeType===3)a.target=a.target.parentNode;if(!a.relatedTarget&&a.fromElement)a.relatedTarget=a.fromElement===a.target?a.toElement:a.fromElement;if(a.pageX==null&&a.clientX!=null){b=t.documentElement;d=t.body;a.pageX=a.clientX+(b&&b.scrollLeft||d&&d.scrollLeft||0)-(b&&b.clientLeft||d&&d.clientLeft||0);a.pageY=a.clientY+(b&&b.scrollTop||
d&&d.scrollTop||0)-(b&&b.clientTop||d&&d.clientTop||0)}if(a.which==null&&(a.charCode!=null||a.keyCode!=null))a.which=a.charCode!=null?a.charCode:a.keyCode;if(!a.metaKey&&a.ctrlKey)a.metaKey=a.ctrlKey;if(!a.which&&a.button!==B)a.which=a.button&1?1:a.button&2?3:a.button&4?2:0;return a},guid:1E8,proxy:c.proxy,special:{ready:{setup:c.bindReady,teardown:c.noop},live:{add:function(a){c.event.add(this,Y(a.origType,a.selector),c.extend({},a,{handler:Ka,guid:a.handler.guid}))},remove:function(a){c.event.remove(this,
Y(a.origType,a.selector),a)}},beforeunload:{setup:function(a,b,d){if(c.isWindow(this))this.onbeforeunload=d},teardown:function(a,b){if(this.onbeforeunload===b)this.onbeforeunload=null}}}};c.removeEvent=t.removeEventListener?function(a,b,d){a.removeEventListener&&a.removeEventListener(b,d,false)}:function(a,b,d){a.detachEvent&&a.detachEvent("on"+b,d)};c.Event=function(a){if(!this.preventDefault)return new c.Event(a);if(a&&a.type){this.originalEvent=a;this.type=a.type}else this.type=a;this.timeStamp=
c.now();this[c.expando]=true};c.Event.prototype={preventDefault:function(){this.isDefaultPrevented=ca;var a=this.originalEvent;if(a)if(a.preventDefault)a.preventDefault();else a.returnValue=false},stopPropagation:function(){this.isPropagationStopped=ca;var a=this.originalEvent;if(a){a.stopPropagation&&a.stopPropagation();a.cancelBubble=true}},stopImmediatePropagation:function(){this.isImmediatePropagationStopped=ca;this.stopPropagation()},isDefaultPrevented:U,isPropagationStopped:U,isImmediatePropagationStopped:U};
var va=function(a){var b=a.relatedTarget;try{for(;b&&b!==this;)b=b.parentNode;if(b!==this){a.type=a.data;c.event.handle.apply(this,arguments)}}catch(d){}},wa=function(a){a.type=a.data;c.event.handle.apply(this,arguments)};c.each({mouseenter:"mouseover",mouseleave:"mouseout"},function(a,b){c.event.special[a]={setup:function(d){c.event.add(this,b,d&&d.selector?wa:va,a)},teardown:function(d){c.event.remove(this,b,d&&d.selector?wa:va)}}});if(!c.support.submitBubbles)c.event.special.submit={setup:function(){if(this.nodeName.toLowerCase()!==
"form"){c.event.add(this,"click.specialSubmit",function(a){var b=a.target,d=b.type;if((d==="submit"||d==="image")&&c(b).closest("form").length){a.liveFired=B;return la("submit",this,arguments)}});c.event.add(this,"keypress.specialSubmit",function(a){var b=a.target,d=b.type;if((d==="text"||d==="password")&&c(b).closest("form").length&&a.keyCode===13){a.liveFired=B;return la("submit",this,arguments)}})}else return false},teardown:function(){c.event.remove(this,".specialSubmit")}};if(!c.support.changeBubbles){var V,
xa=function(a){var b=a.type,d=a.value;if(b==="radio"||b==="checkbox")d=a.checked;else if(b==="select-multiple")d=a.selectedIndex>-1?c.map(a.options,function(e){return e.selected}).join("-"):"";else if(a.nodeName.toLowerCase()==="select")d=a.selectedIndex;return d},Z=function(a,b){var d=a.target,e,f;if(!(!ia.test(d.nodeName)||d.readOnly)){e=c.data(d,"_change_data");f=xa(d);if(a.type!=="focusout"||d.type!=="radio")c.data(d,"_change_data",f);if(!(e===B||f===e))if(e!=null||f){a.type="change";a.liveFired=
B;return c.event.trigger(a,b,d)}}};c.event.special.change={filters:{focusout:Z,beforedeactivate:Z,click:function(a){var b=a.target,d=b.type;if(d==="radio"||d==="checkbox"||b.nodeName.toLowerCase()==="select")return Z.call(this,a)},keydown:function(a){var b=a.target,d=b.type;if(a.keyCode===13&&b.nodeName.toLowerCase()!=="textarea"||a.keyCode===32&&(d==="checkbox"||d==="radio")||d==="select-multiple")return Z.call(this,a)},beforeactivate:function(a){a=a.target;c.data(a,"_change_data",xa(a))}},setup:function(){if(this.type===
"file")return false;for(var a in V)c.event.add(this,a+".specialChange",V[a]);return ia.test(this.nodeName)},teardown:function(){c.event.remove(this,".specialChange");return ia.test(this.nodeName)}};V=c.event.special.change.filters;V.focus=V.beforeactivate}t.addEventListener&&c.each({focus:"focusin",blur:"focusout"},function(a,b){function d(e){e=c.event.fix(e);e.type=b;return c.event.trigger(e,null,e.target)}c.event.special[b]={setup:function(){ua[b]++===0&&t.addEventListener(a,d,true)},teardown:function(){--ua[b]===
0&&t.removeEventListener(a,d,true)}}});c.each(["bind","one"],function(a,b){c.fn[b]=function(d,e,f){if(typeof d==="object"){for(var h in d)this[b](h,e,d[h],f);return this}if(c.isFunction(e)||e===false){f=e;e=B}var l=b==="one"?c.proxy(f,function(o){c(this).unbind(o,l);return f.apply(this,arguments)}):f;if(d==="unload"&&b!=="one")this.one(d,e,f);else{h=0;for(var k=this.length;h<k;h++)c.event.add(this[h],d,l,e)}return this}});c.fn.extend({unbind:function(a,b){if(typeof a==="object"&&!a.preventDefault)for(var d in a)this.unbind(d,
a[d]);else{d=0;for(var e=this.length;d<e;d++)c.event.remove(this[d],a,b)}return this},delegate:function(a,b,d,e){return this.live(b,d,e,a)},undelegate:function(a,b,d){return arguments.length===0?this.unbind("live"):this.die(b,null,d,a)},trigger:function(a,b){return this.each(function(){c.event.trigger(a,b,this)})},triggerHandler:function(a,b){if(this[0]){var d=c.Event(a);d.preventDefault();d.stopPropagation();c.event.trigger(d,b,this[0]);return d.result}},toggle:function(a){for(var b=arguments,d=
1;d<b.length;)c.proxy(a,b[d++]);return this.click(c.proxy(a,function(e){var f=(c.data(this,"lastToggle"+a.guid)||0)%d;c.data(this,"lastToggle"+a.guid,f+1);e.preventDefault();return b[f].apply(this,arguments)||false}))},hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}});var ya={focus:"focusin",blur:"focusout",mouseenter:"mouseover",mouseleave:"mouseout"};c.each(["live","die"],function(a,b){c.fn[b]=function(d,e,f,h){var l,k=0,o,x,r=h||this.selector;h=h?this:c(this.context);if(typeof d===
"object"&&!d.preventDefault){for(l in d)h[b](l,e,d[l],r);return this}if(c.isFunction(e)){f=e;e=B}for(d=(d||"").split(" ");(l=d[k++])!=null;){o=X.exec(l);x="";if(o){x=o[0];l=l.replace(X,"")}if(l==="hover")d.push("mouseenter"+x,"mouseleave"+x);else{o=l;if(l==="focus"||l==="blur"){d.push(ya[l]+x);l+=x}else l=(ya[l]||l)+x;if(b==="live"){x=0;for(var A=h.length;x<A;x++)c.event.add(h[x],"live."+Y(l,r),{data:e,selector:r,handler:f,origType:l,origHandler:f,preType:o})}else h.unbind("live."+Y(l,r),f)}}return this}});
c.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error".split(" "),function(a,b){c.fn[b]=function(d,e){if(e==null){e=d;d=null}return arguments.length>0?this.bind(b,d,e):this.trigger(b)};if(c.attrFn)c.attrFn[b]=true});E.attachEvent&&!E.addEventListener&&c(E).bind("unload",function(){for(var a in c.cache)if(c.cache[a].handle)try{c.event.remove(c.cache[a].handle.elem)}catch(b){}});
(function(){function a(g,i,n,m,p,q){p=0;for(var u=m.length;p<u;p++){var y=m[p];if(y){var F=false;for(y=y[g];y;){if(y.sizcache===n){F=m[y.sizset];break}if(y.nodeType===1&&!q){y.sizcache=n;y.sizset=p}if(y.nodeName.toLowerCase()===i){F=y;break}y=y[g]}m[p]=F}}}function b(g,i,n,m,p,q){p=0;for(var u=m.length;p<u;p++){var y=m[p];if(y){var F=false;for(y=y[g];y;){if(y.sizcache===n){F=m[y.sizset];break}if(y.nodeType===1){if(!q){y.sizcache=n;y.sizset=p}if(typeof i!=="string"){if(y===i){F=true;break}}else if(k.filter(i,
[y]).length>0){F=y;break}}y=y[g]}m[p]=F}}}var d=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,e=0,f=Object.prototype.toString,h=false,l=true;[0,0].sort(function(){l=false;return 0});var k=function(g,i,n,m){n=n||[];var p=i=i||t;if(i.nodeType!==1&&i.nodeType!==9)return[];if(!g||typeof g!=="string")return n;var q,u,y,F,M,N=true,O=k.isXML(i),D=[],R=g;do{d.exec("");if(q=d.exec(R)){R=q[3];D.push(q[1]);if(q[2]){F=q[3];
break}}}while(q);if(D.length>1&&x.exec(g))if(D.length===2&&o.relative[D[0]])u=L(D[0]+D[1],i);else for(u=o.relative[D[0]]?[i]:k(D.shift(),i);D.length;){g=D.shift();if(o.relative[g])g+=D.shift();u=L(g,u)}else{if(!m&&D.length>1&&i.nodeType===9&&!O&&o.match.ID.test(D[0])&&!o.match.ID.test(D[D.length-1])){q=k.find(D.shift(),i,O);i=q.expr?k.filter(q.expr,q.set)[0]:q.set[0]}if(i){q=m?{expr:D.pop(),set:C(m)}:k.find(D.pop(),D.length===1&&(D[0]==="~"||D[0]==="+")&&i.parentNode?i.parentNode:i,O);u=q.expr?k.filter(q.expr,
q.set):q.set;if(D.length>0)y=C(u);else N=false;for(;D.length;){q=M=D.pop();if(o.relative[M])q=D.pop();else M="";if(q==null)q=i;o.relative[M](y,q,O)}}else y=[]}y||(y=u);y||k.error(M||g);if(f.call(y)==="[object Array]")if(N)if(i&&i.nodeType===1)for(g=0;y[g]!=null;g++){if(y[g]&&(y[g]===true||y[g].nodeType===1&&k.contains(i,y[g])))n.push(u[g])}else for(g=0;y[g]!=null;g++)y[g]&&y[g].nodeType===1&&n.push(u[g]);else n.push.apply(n,y);else C(y,n);if(F){k(F,p,n,m);k.uniqueSort(n)}return n};k.uniqueSort=function(g){if(w){h=
l;g.sort(w);if(h)for(var i=1;i<g.length;i++)g[i]===g[i-1]&&g.splice(i--,1)}return g};k.matches=function(g,i){return k(g,null,null,i)};k.matchesSelector=function(g,i){return k(i,null,null,[g]).length>0};k.find=function(g,i,n){var m;if(!g)return[];for(var p=0,q=o.order.length;p<q;p++){var u,y=o.order[p];if(u=o.leftMatch[y].exec(g)){var F=u[1];u.splice(1,1);if(F.substr(F.length-1)!=="\\"){u[1]=(u[1]||"").replace(/\\/g,"");m=o.find[y](u,i,n);if(m!=null){g=g.replace(o.match[y],"");break}}}}m||(m=i.getElementsByTagName("*"));
return{set:m,expr:g}};k.filter=function(g,i,n,m){for(var p,q,u=g,y=[],F=i,M=i&&i[0]&&k.isXML(i[0]);g&&i.length;){for(var N in o.filter)if((p=o.leftMatch[N].exec(g))!=null&&p[2]){var O,D,R=o.filter[N];D=p[1];q=false;p.splice(1,1);if(D.substr(D.length-1)!=="\\"){if(F===y)y=[];if(o.preFilter[N])if(p=o.preFilter[N](p,F,n,y,m,M)){if(p===true)continue}else q=O=true;if(p)for(var j=0;(D=F[j])!=null;j++)if(D){O=R(D,p,j,F);var s=m^!!O;if(n&&O!=null)if(s)q=true;else F[j]=false;else if(s){y.push(D);q=true}}if(O!==
B){n||(F=y);g=g.replace(o.match[N],"");if(!q)return[];break}}}if(g===u)if(q==null)k.error(g);else break;u=g}return F};k.error=function(g){throw"Syntax error, unrecognized expression: "+g;};var o=k.selectors={order:["ID","NAME","TAG"],match:{ID:/#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,CLASS:/\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,ATTR:/\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,TAG:/^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,CHILD:/:(only|nth|last|first)-child(?:\((even|odd|[\dn+\-]*)\))?/,
POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,PSEUDO:/:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/},leftMatch:{},attrMap:{"class":"className","for":"htmlFor"},attrHandle:{href:function(g){return g.getAttribute("href")}},relative:{"+":function(g,i){var n=typeof i==="string",m=n&&!/\W/.test(i);n=n&&!m;if(m)i=i.toLowerCase();m=0;for(var p=g.length,q;m<p;m++)if(q=g[m]){for(;(q=q.previousSibling)&&q.nodeType!==1;);g[m]=n||q&&q.nodeName.toLowerCase()===
i?q||false:q===i}n&&k.filter(i,g,true)},">":function(g,i){var n,m=typeof i==="string",p=0,q=g.length;if(m&&!/\W/.test(i))for(i=i.toLowerCase();p<q;p++){if(n=g[p]){n=n.parentNode;g[p]=n.nodeName.toLowerCase()===i?n:false}}else{for(;p<q;p++)if(n=g[p])g[p]=m?n.parentNode:n.parentNode===i;m&&k.filter(i,g,true)}},"":function(g,i,n){var m,p=e++,q=b;if(typeof i==="string"&&!/\W/.test(i)){m=i=i.toLowerCase();q=a}q("parentNode",i,p,g,m,n)},"~":function(g,i,n){var m,p=e++,q=b;if(typeof i==="string"&&!/\W/.test(i)){m=
i=i.toLowerCase();q=a}q("previousSibling",i,p,g,m,n)}},find:{ID:function(g,i,n){if(typeof i.getElementById!=="undefined"&&!n)return(g=i.getElementById(g[1]))&&g.parentNode?[g]:[]},NAME:function(g,i){if(typeof i.getElementsByName!=="undefined"){for(var n=[],m=i.getElementsByName(g[1]),p=0,q=m.length;p<q;p++)m[p].getAttribute("name")===g[1]&&n.push(m[p]);return n.length===0?null:n}},TAG:function(g,i){return i.getElementsByTagName(g[1])}},preFilter:{CLASS:function(g,i,n,m,p,q){g=" "+g[1].replace(/\\/g,
"")+" ";if(q)return g;q=0;for(var u;(u=i[q])!=null;q++)if(u)if(p^(u.className&&(" "+u.className+" ").replace(/[\t\n]/g," ").indexOf(g)>=0))n||m.push(u);else if(n)i[q]=false;return false},ID:function(g){return g[1].replace(/\\/g,"")},TAG:function(g){return g[1].toLowerCase()},CHILD:function(g){if(g[1]==="nth"){var i=/(-?)(\d*)n((?:\+|-)?\d*)/.exec(g[2]==="even"&&"2n"||g[2]==="odd"&&"2n+1"||!/\D/.test(g[2])&&"0n+"+g[2]||g[2]);g[2]=i[1]+(i[2]||1)-0;g[3]=i[3]-0}g[0]=e++;return g},ATTR:function(g,i,n,
m,p,q){i=g[1].replace(/\\/g,"");if(!q&&o.attrMap[i])g[1]=o.attrMap[i];if(g[2]==="~=")g[4]=" "+g[4]+" ";return g},PSEUDO:function(g,i,n,m,p){if(g[1]==="not")if((d.exec(g[3])||"").length>1||/^\w/.test(g[3]))g[3]=k(g[3],null,null,i);else{g=k.filter(g[3],i,n,true^p);n||m.push.apply(m,g);return false}else if(o.match.POS.test(g[0])||o.match.CHILD.test(g[0]))return true;return g},POS:function(g){g.unshift(true);return g}},filters:{enabled:function(g){return g.disabled===false&&g.type!=="hidden"},disabled:function(g){return g.disabled===
true},checked:function(g){return g.checked===true},selected:function(g){return g.selected===true},parent:function(g){return!!g.firstChild},empty:function(g){return!g.firstChild},has:function(g,i,n){return!!k(n[3],g).length},header:function(g){return/h\d/i.test(g.nodeName)},text:function(g){return"text"===g.type},radio:function(g){return"radio"===g.type},checkbox:function(g){return"checkbox"===g.type},file:function(g){return"file"===g.type},password:function(g){return"password"===g.type},submit:function(g){return"submit"===
g.type},image:function(g){return"image"===g.type},reset:function(g){return"reset"===g.type},button:function(g){return"button"===g.type||g.nodeName.toLowerCase()==="button"},input:function(g){return/input|select|textarea|button/i.test(g.nodeName)}},setFilters:{first:function(g,i){return i===0},last:function(g,i,n,m){return i===m.length-1},even:function(g,i){return i%2===0},odd:function(g,i){return i%2===1},lt:function(g,i,n){return i<n[3]-0},gt:function(g,i,n){return i>n[3]-0},nth:function(g,i,n){return n[3]-
0===i},eq:function(g,i,n){return n[3]-0===i}},filter:{PSEUDO:function(g,i,n,m){var p=i[1],q=o.filters[p];if(q)return q(g,n,i,m);else if(p==="contains")return(g.textContent||g.innerText||k.getText([g])||"").indexOf(i[3])>=0;else if(p==="not"){i=i[3];n=0;for(m=i.length;n<m;n++)if(i[n]===g)return false;return true}else k.error("Syntax error, unrecognized expression: "+p)},CHILD:function(g,i){var n=i[1],m=g;switch(n){case "only":case "first":for(;m=m.previousSibling;)if(m.nodeType===1)return false;if(n===
"first")return true;m=g;case "last":for(;m=m.nextSibling;)if(m.nodeType===1)return false;return true;case "nth":n=i[2];var p=i[3];if(n===1&&p===0)return true;var q=i[0],u=g.parentNode;if(u&&(u.sizcache!==q||!g.nodeIndex)){var y=0;for(m=u.firstChild;m;m=m.nextSibling)if(m.nodeType===1)m.nodeIndex=++y;u.sizcache=q}m=g.nodeIndex-p;return n===0?m===0:m%n===0&&m/n>=0}},ID:function(g,i){return g.nodeType===1&&g.getAttribute("id")===i},TAG:function(g,i){return i==="*"&&g.nodeType===1||g.nodeName.toLowerCase()===
i},CLASS:function(g,i){return(" "+(g.className||g.getAttribute("class"))+" ").indexOf(i)>-1},ATTR:function(g,i){var n=i[1];n=o.attrHandle[n]?o.attrHandle[n](g):g[n]!=null?g[n]:g.getAttribute(n);var m=n+"",p=i[2],q=i[4];return n==null?p==="!=":p==="="?m===q:p==="*="?m.indexOf(q)>=0:p==="~="?(" "+m+" ").indexOf(q)>=0:!q?m&&n!==false:p==="!="?m!==q:p==="^="?m.indexOf(q)===0:p==="$="?m.substr(m.length-q.length)===q:p==="|="?m===q||m.substr(0,q.length+1)===q+"-":false},POS:function(g,i,n,m){var p=o.setFilters[i[2]];
if(p)return p(g,n,i,m)}}},x=o.match.POS,r=function(g,i){return"\\"+(i-0+1)},A;for(A in o.match){o.match[A]=RegExp(o.match[A].source+/(?![^\[]*\])(?![^\(]*\))/.source);o.leftMatch[A]=RegExp(/(^(?:.|\r|\n)*?)/.source+o.match[A].source.replace(/\\(\d+)/g,r))}var C=function(g,i){g=Array.prototype.slice.call(g,0);if(i){i.push.apply(i,g);return i}return g};try{Array.prototype.slice.call(t.documentElement.childNodes,0)}catch(J){C=function(g,i){var n=0,m=i||[];if(f.call(g)==="[object Array]")Array.prototype.push.apply(m,
g);else if(typeof g.length==="number")for(var p=g.length;n<p;n++)m.push(g[n]);else for(;g[n];n++)m.push(g[n]);return m}}var w,I;if(t.documentElement.compareDocumentPosition)w=function(g,i){if(g===i){h=true;return 0}if(!g.compareDocumentPosition||!i.compareDocumentPosition)return g.compareDocumentPosition?-1:1;return g.compareDocumentPosition(i)&4?-1:1};else{w=function(g,i){var n,m,p=[],q=[];n=g.parentNode;m=i.parentNode;var u=n;if(g===i){h=true;return 0}else if(n===m)return I(g,i);else if(n){if(!m)return 1}else return-1;
for(;u;){p.unshift(u);u=u.parentNode}for(u=m;u;){q.unshift(u);u=u.parentNode}n=p.length;m=q.length;for(u=0;u<n&&u<m;u++)if(p[u]!==q[u])return I(p[u],q[u]);return u===n?I(g,q[u],-1):I(p[u],i,1)};I=function(g,i,n){if(g===i)return n;for(g=g.nextSibling;g;){if(g===i)return-1;g=g.nextSibling}return 1}}k.getText=function(g){for(var i="",n,m=0;g[m];m++){n=g[m];if(n.nodeType===3||n.nodeType===4)i+=n.nodeValue;else if(n.nodeType!==8)i+=k.getText(n.childNodes)}return i};(function(){var g=t.createElement("div"),
i="script"+(new Date).getTime(),n=t.documentElement;g.innerHTML="<a name='"+i+"'/>";n.insertBefore(g,n.firstChild);if(t.getElementById(i)){o.find.ID=function(m,p,q){if(typeof p.getElementById!=="undefined"&&!q)return(p=p.getElementById(m[1]))?p.id===m[1]||typeof p.getAttributeNode!=="undefined"&&p.getAttributeNode("id").nodeValue===m[1]?[p]:B:[]};o.filter.ID=function(m,p){var q=typeof m.getAttributeNode!=="undefined"&&m.getAttributeNode("id");return m.nodeType===1&&q&&q.nodeValue===p}}n.removeChild(g);
n=g=null})();(function(){var g=t.createElement("div");g.appendChild(t.createComment(""));if(g.getElementsByTagName("*").length>0)o.find.TAG=function(i,n){var m=n.getElementsByTagName(i[1]);if(i[1]==="*"){for(var p=[],q=0;m[q];q++)m[q].nodeType===1&&p.push(m[q]);m=p}return m};g.innerHTML="<a href='#'></a>";if(g.firstChild&&typeof g.firstChild.getAttribute!=="undefined"&&g.firstChild.getAttribute("href")!=="#")o.attrHandle.href=function(i){return i.getAttribute("href",2)};g=null})();t.querySelectorAll&&
function(){var g=k,i=t.createElement("div");i.innerHTML="<p class='TEST'></p>";if(!(i.querySelectorAll&&i.querySelectorAll(".TEST").length===0)){k=function(m,p,q,u){p=p||t;m=m.replace(/\=\s*([^'"\]]*)\s*\]/g,"='$1']");if(!u&&!k.isXML(p))if(p.nodeType===9)try{return C(p.querySelectorAll(m),q)}catch(y){}else if(p.nodeType===1&&p.nodeName.toLowerCase()!=="object"){var F=p.getAttribute("id"),M=F||"__sizzle__";F||p.setAttribute("id",M);try{return C(p.querySelectorAll("#"+M+" "+m),q)}catch(N){}finally{F||
p.removeAttribute("id")}}return g(m,p,q,u)};for(var n in g)k[n]=g[n];i=null}}();(function(){var g=t.documentElement,i=g.matchesSelector||g.mozMatchesSelector||g.webkitMatchesSelector||g.msMatchesSelector,n=false;try{i.call(t.documentElement,"[test!='']:sizzle")}catch(m){n=true}if(i)k.matchesSelector=function(p,q){q=q.replace(/\=\s*([^'"\]]*)\s*\]/g,"='$1']");if(!k.isXML(p))try{if(n||!o.match.PSEUDO.test(q)&&!/!=/.test(q))return i.call(p,q)}catch(u){}return k(q,null,null,[p]).length>0}})();(function(){var g=
t.createElement("div");g.innerHTML="<div class='test e'></div><div class='test'></div>";if(!(!g.getElementsByClassName||g.getElementsByClassName("e").length===0)){g.lastChild.className="e";if(g.getElementsByClassName("e").length!==1){o.order.splice(1,0,"CLASS");o.find.CLASS=function(i,n,m){if(typeof n.getElementsByClassName!=="undefined"&&!m)return n.getElementsByClassName(i[1])};g=null}}})();k.contains=t.documentElement.contains?function(g,i){return g!==i&&(g.contains?g.contains(i):true)}:t.documentElement.compareDocumentPosition?
function(g,i){return!!(g.compareDocumentPosition(i)&16)}:function(){return false};k.isXML=function(g){return(g=(g?g.ownerDocument||g:0).documentElement)?g.nodeName!=="HTML":false};var L=function(g,i){for(var n,m=[],p="",q=i.nodeType?[i]:i;n=o.match.PSEUDO.exec(g);){p+=n[0];g=g.replace(o.match.PSEUDO,"")}g=o.relative[g]?g+"*":g;n=0;for(var u=q.length;n<u;n++)k(g,q[n],m);return k.filter(p,m)};c.find=k;c.expr=k.selectors;c.expr[":"]=c.expr.filters;c.unique=k.uniqueSort;c.text=k.getText;c.isXMLDoc=k.isXML;
c.contains=k.contains})();var Za=/Until$/,$a=/^(?:parents|prevUntil|prevAll)/,ab=/,/,Na=/^.[^:#\[\.,]*$/,bb=Array.prototype.slice,cb=c.expr.match.POS;c.fn.extend({find:function(a){for(var b=this.pushStack("","find",a),d=0,e=0,f=this.length;e<f;e++){d=b.length;c.find(a,this[e],b);if(e>0)for(var h=d;h<b.length;h++)for(var l=0;l<d;l++)if(b[l]===b[h]){b.splice(h--,1);break}}return b},has:function(a){var b=c(a);return this.filter(function(){for(var d=0,e=b.length;d<e;d++)if(c.contains(this,b[d]))return true})},
not:function(a){return this.pushStack(ma(this,a,false),"not",a)},filter:function(a){return this.pushStack(ma(this,a,true),"filter",a)},is:function(a){return!!a&&c.filter(a,this).length>0},closest:function(a,b){var d=[],e,f,h=this[0];if(c.isArray(a)){var l,k={},o=1;if(h&&a.length){e=0;for(f=a.length;e<f;e++){l=a[e];k[l]||(k[l]=c.expr.match.POS.test(l)?c(l,b||this.context):l)}for(;h&&h.ownerDocument&&h!==b;){for(l in k){e=k[l];if(e.jquery?e.index(h)>-1:c(h).is(e))d.push({selector:l,elem:h,level:o})}h=
h.parentNode;o++}}return d}l=cb.test(a)?c(a,b||this.context):null;e=0;for(f=this.length;e<f;e++)for(h=this[e];h;)if(l?l.index(h)>-1:c.find.matchesSelector(h,a)){d.push(h);break}else{h=h.parentNode;if(!h||!h.ownerDocument||h===b)break}d=d.length>1?c.unique(d):d;return this.pushStack(d,"closest",a)},index:function(a){if(!a||typeof a==="string")return c.inArray(this[0],a?c(a):this.parent().children());return c.inArray(a.jquery?a[0]:a,this)},add:function(a,b){var d=typeof a==="string"?c(a,b||this.context):
c.makeArray(a),e=c.merge(this.get(),d);return this.pushStack(!d[0]||!d[0].parentNode||d[0].parentNode.nodeType===11||!e[0]||!e[0].parentNode||e[0].parentNode.nodeType===11?e:c.unique(e))},andSelf:function(){return this.add(this.prevObject)}});c.each({parent:function(a){return(a=a.parentNode)&&a.nodeType!==11?a:null},parents:function(a){return c.dir(a,"parentNode")},parentsUntil:function(a,b,d){return c.dir(a,"parentNode",d)},next:function(a){return c.nth(a,2,"nextSibling")},prev:function(a){return c.nth(a,
2,"previousSibling")},nextAll:function(a){return c.dir(a,"nextSibling")},prevAll:function(a){return c.dir(a,"previousSibling")},nextUntil:function(a,b,d){return c.dir(a,"nextSibling",d)},prevUntil:function(a,b,d){return c.dir(a,"previousSibling",d)},siblings:function(a){return c.sibling(a.parentNode.firstChild,a)},children:function(a){return c.sibling(a.firstChild)},contents:function(a){return c.nodeName(a,"iframe")?a.contentDocument||a.contentWindow.document:c.makeArray(a.childNodes)}},function(a,
b){c.fn[a]=function(d,e){var f=c.map(this,b,d);Za.test(a)||(e=d);if(e&&typeof e==="string")f=c.filter(e,f);f=this.length>1?c.unique(f):f;if((this.length>1||ab.test(e))&&$a.test(a))f=f.reverse();return this.pushStack(f,a,bb.call(arguments).join(","))}});c.extend({filter:function(a,b,d){if(d)a=":not("+a+")";return b.length===1?c.find.matchesSelector(b[0],a)?[b[0]]:[]:c.find.matches(a,b)},dir:function(a,b,d){var e=[];for(a=a[b];a&&a.nodeType!==9&&(d===B||a.nodeType!==1||!c(a).is(d));){a.nodeType===1&&
e.push(a);a=a[b]}return e},nth:function(a,b,d){b=b||1;for(var e=0;a;a=a[d])if(a.nodeType===1&&++e===b)break;return a},sibling:function(a,b){for(var d=[];a;a=a.nextSibling)a.nodeType===1&&a!==b&&d.push(a);return d}});var za=/ jQuery\d+="(?:\d+|null)"/g,$=/^\s+/,Aa=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig,Ba=/<([\w:]+)/,db=/<tbody/i,eb=/<|&#?\w+;/,Ca=/<(?:script|object|embed|option|style)/i,Da=/checked\s*(?:[^=]|=\s*.checked.)/i,fb=/\=([^="'>\s]+\/)>/g,P={option:[1,
"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],area:[1,"<map>","</map>"],_default:[0,"",""]};P.optgroup=P.option;P.tbody=P.tfoot=P.colgroup=P.caption=P.thead;P.th=P.td;if(!c.support.htmlSerialize)P._default=[1,"div<div>","</div>"];c.fn.extend({text:function(a){if(c.isFunction(a))return this.each(function(b){var d=
c(this);d.text(a.call(this,b,d.text()))});if(typeof a!=="object"&&a!==B)return this.empty().append((this[0]&&this[0].ownerDocument||t).createTextNode(a));return c.text(this)},wrapAll:function(a){if(c.isFunction(a))return this.each(function(d){c(this).wrapAll(a.call(this,d))});if(this[0]){var b=c(a,this[0].ownerDocument).eq(0).clone(true);this[0].parentNode&&b.insertBefore(this[0]);b.map(function(){for(var d=this;d.firstChild&&d.firstChild.nodeType===1;)d=d.firstChild;return d}).append(this)}return this},
wrapInner:function(a){if(c.isFunction(a))return this.each(function(b){c(this).wrapInner(a.call(this,b))});return this.each(function(){var b=c(this),d=b.contents();d.length?d.wrapAll(a):b.append(a)})},wrap:function(a){return this.each(function(){c(this).wrapAll(a)})},unwrap:function(){return this.parent().each(function(){c.nodeName(this,"body")||c(this).replaceWith(this.childNodes)}).end()},append:function(){return this.domManip(arguments,true,function(a){this.nodeType===1&&this.appendChild(a)})},
prepend:function(){return this.domManip(arguments,true,function(a){this.nodeType===1&&this.insertBefore(a,this.firstChild)})},before:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,false,function(b){this.parentNode.insertBefore(b,this)});else if(arguments.length){var a=c(arguments[0]);a.push.apply(a,this.toArray());return this.pushStack(a,"before",arguments)}},after:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,false,function(b){this.parentNode.insertBefore(b,
this.nextSibling)});else if(arguments.length){var a=this.pushStack(this,"after",arguments);a.push.apply(a,c(arguments[0]).toArray());return a}},remove:function(a,b){for(var d=0,e;(e=this[d])!=null;d++)if(!a||c.filter(a,[e]).length){if(!b&&e.nodeType===1){c.cleanData(e.getElementsByTagName("*"));c.cleanData([e])}e.parentNode&&e.parentNode.removeChild(e)}return this},empty:function(){for(var a=0,b;(b=this[a])!=null;a++)for(b.nodeType===1&&c.cleanData(b.getElementsByTagName("*"));b.firstChild;)b.removeChild(b.firstChild);
return this},clone:function(a){var b=this.map(function(){if(!c.support.noCloneEvent&&!c.isXMLDoc(this)){var d=this.outerHTML,e=this.ownerDocument;if(!d){d=e.createElement("div");d.appendChild(this.cloneNode(true));d=d.innerHTML}return c.clean([d.replace(za,"").replace(fb,'="$1">').replace($,"")],e)[0]}else return this.cloneNode(true)});if(a===true){na(this,b);na(this.find("*"),b.find("*"))}return b},html:function(a){if(a===B)return this[0]&&this[0].nodeType===1?this[0].innerHTML.replace(za,""):null;
else if(typeof a==="string"&&!Ca.test(a)&&(c.support.leadingWhitespace||!$.test(a))&&!P[(Ba.exec(a)||["",""])[1].toLowerCase()]){a=a.replace(Aa,"<$1></$2>");try{for(var b=0,d=this.length;b<d;b++)if(this[b].nodeType===1){c.cleanData(this[b].getElementsByTagName("*"));this[b].innerHTML=a}}catch(e){this.empty().append(a)}}else c.isFunction(a)?this.each(function(f){var h=c(this);h.html(a.call(this,f,h.html()))}):this.empty().append(a);return this},replaceWith:function(a){if(this[0]&&this[0].parentNode){if(c.isFunction(a))return this.each(function(b){var d=
c(this),e=d.html();d.replaceWith(a.call(this,b,e))});if(typeof a!=="string")a=c(a).detach();return this.each(function(){var b=this.nextSibling,d=this.parentNode;c(this).remove();b?c(b).before(a):c(d).append(a)})}else return this.pushStack(c(c.isFunction(a)?a():a),"replaceWith",a)},detach:function(a){return this.remove(a,true)},domManip:function(a,b,d){var e,f,h,l=a[0],k=[];if(!c.support.checkClone&&arguments.length===3&&typeof l==="string"&&Da.test(l))return this.each(function(){c(this).domManip(a,
b,d,true)});if(c.isFunction(l))return this.each(function(x){var r=c(this);a[0]=l.call(this,x,b?r.html():B);r.domManip(a,b,d)});if(this[0]){e=l&&l.parentNode;e=c.support.parentNode&&e&&e.nodeType===11&&e.childNodes.length===this.length?{fragment:e}:c.buildFragment(a,this,k);h=e.fragment;if(f=h.childNodes.length===1?h=h.firstChild:h.firstChild){b=b&&c.nodeName(f,"tr");f=0;for(var o=this.length;f<o;f++)d.call(b?c.nodeName(this[f],"table")?this[f].getElementsByTagName("tbody")[0]||this[f].appendChild(this[f].ownerDocument.createElement("tbody")):
this[f]:this[f],f>0||e.cacheable||this.length>1?h.cloneNode(true):h)}k.length&&c.each(k,Oa)}return this}});c.buildFragment=function(a,b,d){var e,f,h;b=b&&b[0]?b[0].ownerDocument||b[0]:t;if(a.length===1&&typeof a[0]==="string"&&a[0].length<512&&b===t&&!Ca.test(a[0])&&(c.support.checkClone||!Da.test(a[0]))){f=true;if(h=c.fragments[a[0]])if(h!==1)e=h}if(!e){e=b.createDocumentFragment();c.clean(a,b,e,d)}if(f)c.fragments[a[0]]=h?e:1;return{fragment:e,cacheable:f}};c.fragments={};c.each({appendTo:"append",
prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){c.fn[a]=function(d){var e=[];d=c(d);var f=this.length===1&&this[0].parentNode;if(f&&f.nodeType===11&&f.childNodes.length===1&&d.length===1){d[b](this[0]);return this}else{f=0;for(var h=d.length;f<h;f++){var l=(f>0?this.clone(true):this).get();c(d[f])[b](l);e=e.concat(l)}return this.pushStack(e,a,d.selector)}}});c.extend({clean:function(a,b,d,e){b=b||t;if(typeof b.createElement==="undefined")b=b.ownerDocument||
b[0]&&b[0].ownerDocument||t;for(var f=[],h=0,l;(l=a[h])!=null;h++){if(typeof l==="number")l+="";if(l){if(typeof l==="string"&&!eb.test(l))l=b.createTextNode(l);else if(typeof l==="string"){l=l.replace(Aa,"<$1></$2>");var k=(Ba.exec(l)||["",""])[1].toLowerCase(),o=P[k]||P._default,x=o[0],r=b.createElement("div");for(r.innerHTML=o[1]+l+o[2];x--;)r=r.lastChild;if(!c.support.tbody){x=db.test(l);k=k==="table"&&!x?r.firstChild&&r.firstChild.childNodes:o[1]==="<table>"&&!x?r.childNodes:[];for(o=k.length-
1;o>=0;--o)c.nodeName(k[o],"tbody")&&!k[o].childNodes.length&&k[o].parentNode.removeChild(k[o])}!c.support.leadingWhitespace&&$.test(l)&&r.insertBefore(b.createTextNode($.exec(l)[0]),r.firstChild);l=r.childNodes}if(l.nodeType)f.push(l);else f=c.merge(f,l)}}if(d)for(h=0;f[h];h++)if(e&&c.nodeName(f[h],"script")&&(!f[h].type||f[h].type.toLowerCase()==="text/javascript"))e.push(f[h].parentNode?f[h].parentNode.removeChild(f[h]):f[h]);else{f[h].nodeType===1&&f.splice.apply(f,[h+1,0].concat(c.makeArray(f[h].getElementsByTagName("script"))));
d.appendChild(f[h])}return f},cleanData:function(a){for(var b,d,e=c.cache,f=c.event.special,h=c.support.deleteExpando,l=0,k;(k=a[l])!=null;l++)if(!(k.nodeName&&c.noData[k.nodeName.toLowerCase()]))if(d=k[c.expando]){if((b=e[d])&&b.events)for(var o in b.events)f[o]?c.event.remove(k,o):c.removeEvent(k,o,b.handle);if(h)delete k[c.expando];else k.removeAttribute&&k.removeAttribute(c.expando);delete e[d]}}});var Ea=/alpha\([^)]*\)/i,gb=/opacity=([^)]*)/,hb=/-([a-z])/ig,ib=/([A-Z])/g,Fa=/^-?\d+(?:px)?$/i,
jb=/^-?\d/,kb={position:"absolute",visibility:"hidden",display:"block"},Pa=["Left","Right"],Qa=["Top","Bottom"],W,Ga,aa,lb=function(a,b){return b.toUpperCase()};c.fn.css=function(a,b){if(arguments.length===2&&b===B)return this;return c.access(this,a,b,true,function(d,e,f){return f!==B?c.style(d,e,f):c.css(d,e)})};c.extend({cssHooks:{opacity:{get:function(a,b){if(b){var d=W(a,"opacity","opacity");return d===""?"1":d}else return a.style.opacity}}},cssNumber:{zIndex:true,fontWeight:true,opacity:true,
zoom:true,lineHeight:true},cssProps:{"float":c.support.cssFloat?"cssFloat":"styleFloat"},style:function(a,b,d,e){if(!(!a||a.nodeType===3||a.nodeType===8||!a.style)){var f,h=c.camelCase(b),l=a.style,k=c.cssHooks[h];b=c.cssProps[h]||h;if(d!==B){if(!(typeof d==="number"&&isNaN(d)||d==null)){if(typeof d==="number"&&!c.cssNumber[h])d+="px";if(!k||!("set"in k)||(d=k.set(a,d))!==B)try{l[b]=d}catch(o){}}}else{if(k&&"get"in k&&(f=k.get(a,false,e))!==B)return f;return l[b]}}},css:function(a,b,d){var e,f=c.camelCase(b),
h=c.cssHooks[f];b=c.cssProps[f]||f;if(h&&"get"in h&&(e=h.get(a,true,d))!==B)return e;else if(W)return W(a,b,f)},swap:function(a,b,d){var e={},f;for(f in b){e[f]=a.style[f];a.style[f]=b[f]}d.call(a);for(f in b)a.style[f]=e[f]},camelCase:function(a){return a.replace(hb,lb)}});c.curCSS=c.css;c.each(["height","width"],function(a,b){c.cssHooks[b]={get:function(d,e,f){var h;if(e){if(d.offsetWidth!==0)h=oa(d,b,f);else c.swap(d,kb,function(){h=oa(d,b,f)});if(h<=0){h=W(d,b,b);if(h==="0px"&&aa)h=aa(d,b,b);
if(h!=null)return h===""||h==="auto"?"0px":h}if(h<0||h==null){h=d.style[b];return h===""||h==="auto"?"0px":h}return typeof h==="string"?h:h+"px"}},set:function(d,e){if(Fa.test(e)){e=parseFloat(e);if(e>=0)return e+"px"}else return e}}});if(!c.support.opacity)c.cssHooks.opacity={get:function(a,b){return gb.test((b&&a.currentStyle?a.currentStyle.filter:a.style.filter)||"")?parseFloat(RegExp.$1)/100+"":b?"1":""},set:function(a,b){var d=a.style;d.zoom=1;var e=c.isNaN(b)?"":"alpha(opacity="+b*100+")",f=
d.filter||"";d.filter=Ea.test(f)?f.replace(Ea,e):d.filter+" "+e}};if(t.defaultView&&t.defaultView.getComputedStyle)Ga=function(a,b,d){var e;d=d.replace(ib,"-$1").toLowerCase();if(!(b=a.ownerDocument.defaultView))return B;if(b=b.getComputedStyle(a,null)){e=b.getPropertyValue(d);if(e===""&&!c.contains(a.ownerDocument.documentElement,a))e=c.style(a,d)}return e};if(t.documentElement.currentStyle)aa=function(a,b){var d,e,f=a.currentStyle&&a.currentStyle[b],h=a.style;if(!Fa.test(f)&&jb.test(f)){d=h.left;
e=a.runtimeStyle.left;a.runtimeStyle.left=a.currentStyle.left;h.left=b==="fontSize"?"1em":f||0;f=h.pixelLeft+"px";h.left=d;a.runtimeStyle.left=e}return f===""?"auto":f};W=Ga||aa;if(c.expr&&c.expr.filters){c.expr.filters.hidden=function(a){var b=a.offsetHeight;return a.offsetWidth===0&&b===0||!c.support.reliableHiddenOffsets&&(a.style.display||c.css(a,"display"))==="none"};c.expr.filters.visible=function(a){return!c.expr.filters.hidden(a)}}var mb=c.now(),nb=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
ob=/^(?:select|textarea)/i,pb=/^(?:color|date|datetime|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,qb=/^(?:GET|HEAD)$/,Ra=/\[\]$/,T=/\=\?(&|$)/,ja=/\?/,rb=/([?&])_=[^&]*/,sb=/^(\w+:)?\/\/([^\/?#]+)/,tb=/%20/g,ub=/#.*$/,Ha=c.fn.load;c.fn.extend({load:function(a,b,d){if(typeof a!=="string"&&Ha)return Ha.apply(this,arguments);else if(!this.length)return this;var e=a.indexOf(" ");if(e>=0){var f=a.slice(e,a.length);a=a.slice(0,e)}e="GET";if(b)if(c.isFunction(b)){d=b;b=null}else if(typeof b===
"object"){b=c.param(b,c.ajaxSettings.traditional);e="POST"}var h=this;c.ajax({url:a,type:e,dataType:"html",data:b,complete:function(l,k){if(k==="success"||k==="notmodified")h.html(f?c("<div>").append(l.responseText.replace(nb,"")).find(f):l.responseText);d&&h.each(d,[l.responseText,k,l])}});return this},serialize:function(){return c.param(this.serializeArray())},serializeArray:function(){return this.map(function(){return this.elements?c.makeArray(this.elements):this}).filter(function(){return this.name&&
!this.disabled&&(this.checked||ob.test(this.nodeName)||pb.test(this.type))}).map(function(a,b){var d=c(this).val();return d==null?null:c.isArray(d)?c.map(d,function(e){return{name:b.name,value:e}}):{name:b.name,value:d}}).get()}});c.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "),function(a,b){c.fn[b]=function(d){return this.bind(b,d)}});c.extend({get:function(a,b,d,e){if(c.isFunction(b)){e=e||d;d=b;b=null}return c.ajax({type:"GET",url:a,data:b,success:d,dataType:e})},
getScript:function(a,b){return c.get(a,null,b,"script")},getJSON:function(a,b,d){return c.get(a,b,d,"json")},post:function(a,b,d,e){if(c.isFunction(b)){e=e||d;d=b;b={}}return c.ajax({type:"POST",url:a,data:b,success:d,dataType:e})},ajaxSetup:function(a){c.extend(c.ajaxSettings,a)},ajaxSettings:{url:location.href,global:true,type:"GET",contentType:"application/x-www-form-urlencoded",processData:true,async:true,xhr:function(){return new E.XMLHttpRequest},accepts:{xml:"application/xml, text/xml",html:"text/html",
script:"text/javascript, application/javascript",json:"application/json, text/javascript",text:"text/plain",_default:"*/*"}},ajax:function(a){var b=c.extend(true,{},c.ajaxSettings,a),d,e,f,h=b.type.toUpperCase(),l=qb.test(h);b.url=b.url.replace(ub,"");b.context=a&&a.context!=null?a.context:b;if(b.data&&b.processData&&typeof b.data!=="string")b.data=c.param(b.data,b.traditional);if(b.dataType==="jsonp"){if(h==="GET")T.test(b.url)||(b.url+=(ja.test(b.url)?"&":"?")+(b.jsonp||"callback")+"=?");else if(!b.data||
!T.test(b.data))b.data=(b.data?b.data+"&":"")+(b.jsonp||"callback")+"=?";b.dataType="json"}if(b.dataType==="json"&&(b.data&&T.test(b.data)||T.test(b.url))){d=b.jsonpCallback||"jsonp"+mb++;if(b.data)b.data=(b.data+"").replace(T,"="+d+"$1");b.url=b.url.replace(T,"="+d+"$1");b.dataType="script";var k=E[d];E[d]=function(m){if(c.isFunction(k))k(m);else{E[d]=B;try{delete E[d]}catch(p){}}f=m;c.handleSuccess(b,w,e,f);c.handleComplete(b,w,e,f);r&&r.removeChild(A)}}if(b.dataType==="script"&&b.cache===null)b.cache=
false;if(b.cache===false&&l){var o=c.now(),x=b.url.replace(rb,"$1_="+o);b.url=x+(x===b.url?(ja.test(b.url)?"&":"?")+"_="+o:"")}if(b.data&&l)b.url+=(ja.test(b.url)?"&":"?")+b.data;b.global&&c.active++===0&&c.event.trigger("ajaxStart");o=(o=sb.exec(b.url))&&(o[1]&&o[1].toLowerCase()!==location.protocol||o[2].toLowerCase()!==location.host);if(b.dataType==="script"&&h==="GET"&&o){var r=t.getElementsByTagName("head")[0]||t.documentElement,A=t.createElement("script");if(b.scriptCharset)A.charset=b.scriptCharset;
A.src=b.url;if(!d){var C=false;A.onload=A.onreadystatechange=function(){if(!C&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){C=true;c.handleSuccess(b,w,e,f);c.handleComplete(b,w,e,f);A.onload=A.onreadystatechange=null;r&&A.parentNode&&r.removeChild(A)}}}r.insertBefore(A,r.firstChild);return B}var J=false,w=b.xhr();if(w){b.username?w.open(h,b.url,b.async,b.username,b.password):w.open(h,b.url,b.async);try{if(b.data!=null&&!l||a&&a.contentType)w.setRequestHeader("Content-Type",
b.contentType);if(b.ifModified){c.lastModified[b.url]&&w.setRequestHeader("If-Modified-Since",c.lastModified[b.url]);c.etag[b.url]&&w.setRequestHeader("If-None-Match",c.etag[b.url])}o||w.setRequestHeader("X-Requested-With","XMLHttpRequest");w.setRequestHeader("Accept",b.dataType&&b.accepts[b.dataType]?b.accepts[b.dataType]+", */*; q=0.01":b.accepts._default)}catch(I){}if(b.beforeSend&&b.beforeSend.call(b.context,w,b)===false){b.global&&c.active--===1&&c.event.trigger("ajaxStop");w.abort();return false}b.global&&
c.triggerGlobal(b,"ajaxSend",[w,b]);var L=w.onreadystatechange=function(m){if(!w||w.readyState===0||m==="abort"){J||c.handleComplete(b,w,e,f);J=true;if(w)w.onreadystatechange=c.noop}else if(!J&&w&&(w.readyState===4||m==="timeout")){J=true;w.onreadystatechange=c.noop;e=m==="timeout"?"timeout":!c.httpSuccess(w)?"error":b.ifModified&&c.httpNotModified(w,b.url)?"notmodified":"success";var p;if(e==="success")try{f=c.httpData(w,b.dataType,b)}catch(q){e="parsererror";p=q}if(e==="success"||e==="notmodified")d||
c.handleSuccess(b,w,e,f);else c.handleError(b,w,e,p);d||c.handleComplete(b,w,e,f);m==="timeout"&&w.abort();if(b.async)w=null}};try{var g=w.abort;w.abort=function(){w&&Function.prototype.call.call(g,w);L("abort")}}catch(i){}b.async&&b.timeout>0&&setTimeout(function(){w&&!J&&L("timeout")},b.timeout);try{w.send(l||b.data==null?null:b.data)}catch(n){c.handleError(b,w,null,n);c.handleComplete(b,w,e,f)}b.async||L();return w}},param:function(a,b){var d=[],e=function(h,l){l=c.isFunction(l)?l():l;d[d.length]=
encodeURIComponent(h)+"="+encodeURIComponent(l)};if(b===B)b=c.ajaxSettings.traditional;if(c.isArray(a)||a.jquery)c.each(a,function(){e(this.name,this.value)});else for(var f in a)da(f,a[f],b,e);return d.join("&").replace(tb,"+")}});c.extend({active:0,lastModified:{},etag:{},handleError:function(a,b,d,e){a.error&&a.error.call(a.context,b,d,e);a.global&&c.triggerGlobal(a,"ajaxError",[b,a,e])},handleSuccess:function(a,b,d,e){a.success&&a.success.call(a.context,e,d,b);a.global&&c.triggerGlobal(a,"ajaxSuccess",
[b,a])},handleComplete:function(a,b,d){a.complete&&a.complete.call(a.context,b,d);a.global&&c.triggerGlobal(a,"ajaxComplete",[b,a]);a.global&&c.active--===1&&c.event.trigger("ajaxStop")},triggerGlobal:function(a,b,d){(a.context&&a.context.url==null?c(a.context):c.event).trigger(b,d)},httpSuccess:function(a){try{return!a.status&&location.protocol==="file:"||a.status>=200&&a.status<300||a.status===304||a.status===1223}catch(b){}return false},httpNotModified:function(a,b){var d=a.getResponseHeader("Last-Modified"),
e=a.getResponseHeader("Etag");if(d)c.lastModified[b]=d;if(e)c.etag[b]=e;return a.status===304},httpData:function(a,b,d){var e=a.getResponseHeader("content-type")||"",f=b==="xml"||!b&&e.indexOf("xml")>=0;a=f?a.responseXML:a.responseText;f&&a.documentElement.nodeName==="parsererror"&&c.error("parsererror");if(d&&d.dataFilter)a=d.dataFilter(a,b);if(typeof a==="string")if(b==="json"||!b&&e.indexOf("json")>=0)a=c.parseJSON(a);else if(b==="script"||!b&&e.indexOf("javascript")>=0)c.globalEval(a);return a}});
if(E.ActiveXObject)c.ajaxSettings.xhr=function(){if(E.location.protocol!=="file:")try{return new E.XMLHttpRequest}catch(a){}try{return new E.ActiveXObject("Microsoft.XMLHTTP")}catch(b){}};c.support.ajax=!!c.ajaxSettings.xhr();var ea={},vb=/^(?:toggle|show|hide)$/,wb=/^([+\-]=)?([\d+.\-]+)(.*)$/,ba,pa=[["height","marginTop","marginBottom","paddingTop","paddingBottom"],["width","marginLeft","marginRight","paddingLeft","paddingRight"],["opacity"]];c.fn.extend({show:function(a,b,d){if(a||a===0)return this.animate(S("show",
3),a,b,d);else{d=0;for(var e=this.length;d<e;d++){a=this[d];b=a.style.display;if(!c.data(a,"olddisplay")&&b==="none")b=a.style.display="";b===""&&c.css(a,"display")==="none"&&c.data(a,"olddisplay",qa(a.nodeName))}for(d=0;d<e;d++){a=this[d];b=a.style.display;if(b===""||b==="none")a.style.display=c.data(a,"olddisplay")||""}return this}},hide:function(a,b,d){if(a||a===0)return this.animate(S("hide",3),a,b,d);else{a=0;for(b=this.length;a<b;a++){d=c.css(this[a],"display");d!=="none"&&c.data(this[a],"olddisplay",
d)}for(a=0;a<b;a++)this[a].style.display="none";return this}},_toggle:c.fn.toggle,toggle:function(a,b,d){var e=typeof a==="boolean";if(c.isFunction(a)&&c.isFunction(b))this._toggle.apply(this,arguments);else a==null||e?this.each(function(){var f=e?a:c(this).is(":hidden");c(this)[f?"show":"hide"]()}):this.animate(S("toggle",3),a,b,d);return this},fadeTo:function(a,b,d,e){return this.filter(":hidden").css("opacity",0).show().end().animate({opacity:b},a,d,e)},animate:function(a,b,d,e){var f=c.speed(b,
d,e);if(c.isEmptyObject(a))return this.each(f.complete);return this[f.queue===false?"each":"queue"](function(){var h=c.extend({},f),l,k=this.nodeType===1,o=k&&c(this).is(":hidden"),x=this;for(l in a){var r=c.camelCase(l);if(l!==r){a[r]=a[l];delete a[l];l=r}if(a[l]==="hide"&&o||a[l]==="show"&&!o)return h.complete.call(this);if(k&&(l==="height"||l==="width")){h.overflow=[this.style.overflow,this.style.overflowX,this.style.overflowY];if(c.css(this,"display")==="inline"&&c.css(this,"float")==="none")if(c.support.inlineBlockNeedsLayout)if(qa(this.nodeName)===
"inline")this.style.display="inline-block";else{this.style.display="inline";this.style.zoom=1}else this.style.display="inline-block"}if(c.isArray(a[l])){(h.specialEasing=h.specialEasing||{})[l]=a[l][1];a[l]=a[l][0]}}if(h.overflow!=null)this.style.overflow="hidden";h.curAnim=c.extend({},a);c.each(a,function(A,C){var J=new c.fx(x,h,A);if(vb.test(C))J[C==="toggle"?o?"show":"hide":C](a);else{var w=wb.exec(C),I=J.cur()||0;if(w){var L=parseFloat(w[2]),g=w[3]||"px";if(g!=="px"){c.style(x,A,(L||1)+g);I=(L||
1)/J.cur()*I;c.style(x,A,I+g)}if(w[1])L=(w[1]==="-="?-1:1)*L+I;J.custom(I,L,g)}else J.custom(I,C,"")}});return true})},stop:function(a,b){var d=c.timers;a&&this.queue([]);this.each(function(){for(var e=d.length-1;e>=0;e--)if(d[e].elem===this){b&&d[e](true);d.splice(e,1)}});b||this.dequeue();return this}});c.each({slideDown:S("show",1),slideUp:S("hide",1),slideToggle:S("toggle",1),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){c.fn[a]=function(d,e,f){return this.animate(b,
d,e,f)}});c.extend({speed:function(a,b,d){var e=a&&typeof a==="object"?c.extend({},a):{complete:d||!d&&b||c.isFunction(a)&&a,duration:a,easing:d&&b||b&&!c.isFunction(b)&&b};e.duration=c.fx.off?0:typeof e.duration==="number"?e.duration:e.duration in c.fx.speeds?c.fx.speeds[e.duration]:c.fx.speeds._default;e.old=e.complete;e.complete=function(){e.queue!==false&&c(this).dequeue();c.isFunction(e.old)&&e.old.call(this)};return e},easing:{linear:function(a,b,d,e){return d+e*a},swing:function(a,b,d,e){return(-Math.cos(a*
Math.PI)/2+0.5)*e+d}},timers:[],fx:function(a,b,d){this.options=b;this.elem=a;this.prop=d;if(!b.orig)b.orig={}}});c.fx.prototype={update:function(){this.options.step&&this.options.step.call(this.elem,this.now,this);(c.fx.step[this.prop]||c.fx.step._default)(this)},cur:function(){if(this.elem[this.prop]!=null&&(!this.elem.style||this.elem.style[this.prop]==null))return this.elem[this.prop];var a=parseFloat(c.css(this.elem,this.prop));return a&&a>-1E4?a:0},custom:function(a,b,d){function e(l){return f.step(l)}
var f=this,h=c.fx;this.startTime=c.now();this.start=a;this.end=b;this.unit=d||this.unit||"px";this.now=this.start;this.pos=this.state=0;e.elem=this.elem;if(e()&&c.timers.push(e)&&!ba)ba=setInterval(h.tick,h.interval)},show:function(){this.options.orig[this.prop]=c.style(this.elem,this.prop);this.options.show=true;this.custom(this.prop==="width"||this.prop==="height"?1:0,this.cur());c(this.elem).show()},hide:function(){this.options.orig[this.prop]=c.style(this.elem,this.prop);this.options.hide=true;
this.custom(this.cur(),0)},step:function(a){var b=c.now(),d=true;if(a||b>=this.options.duration+this.startTime){this.now=this.end;this.pos=this.state=1;this.update();this.options.curAnim[this.prop]=true;for(var e in this.options.curAnim)if(this.options.curAnim[e]!==true)d=false;if(d){if(this.options.overflow!=null&&!c.support.shrinkWrapBlocks){var f=this.elem,h=this.options;c.each(["","X","Y"],function(k,o){f.style["overflow"+o]=h.overflow[k]})}this.options.hide&&c(this.elem).hide();if(this.options.hide||
this.options.show)for(var l in this.options.curAnim)c.style(this.elem,l,this.options.orig[l]);this.options.complete.call(this.elem)}return false}else{a=b-this.startTime;this.state=a/this.options.duration;b=this.options.easing||(c.easing.swing?"swing":"linear");this.pos=c.easing[this.options.specialEasing&&this.options.specialEasing[this.prop]||b](this.state,a,0,1,this.options.duration);this.now=this.start+(this.end-this.start)*this.pos;this.update()}return true}};c.extend(c.fx,{tick:function(){for(var a=
c.timers,b=0;b<a.length;b++)a[b]()||a.splice(b--,1);a.length||c.fx.stop()},interval:13,stop:function(){clearInterval(ba);ba=null},speeds:{slow:600,fast:200,_default:400},step:{opacity:function(a){c.style(a.elem,"opacity",a.now)},_default:function(a){if(a.elem.style&&a.elem.style[a.prop]!=null)a.elem.style[a.prop]=(a.prop==="width"||a.prop==="height"?Math.max(0,a.now):a.now)+a.unit;else a.elem[a.prop]=a.now}}});if(c.expr&&c.expr.filters)c.expr.filters.animated=function(a){return c.grep(c.timers,function(b){return a===
b.elem}).length};var xb=/^t(?:able|d|h)$/i,Ia=/^(?:body|html)$/i;c.fn.offset="getBoundingClientRect"in t.documentElement?function(a){var b=this[0],d;if(a)return this.each(function(l){c.offset.setOffset(this,a,l)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return c.offset.bodyOffset(b);try{d=b.getBoundingClientRect()}catch(e){}var f=b.ownerDocument,h=f.documentElement;if(!d||!c.contains(h,b))return d||{top:0,left:0};b=f.body;f=fa(f);return{top:d.top+(f.pageYOffset||c.support.boxModel&&
h.scrollTop||b.scrollTop)-(h.clientTop||b.clientTop||0),left:d.left+(f.pageXOffset||c.support.boxModel&&h.scrollLeft||b.scrollLeft)-(h.clientLeft||b.clientLeft||0)}}:function(a){var b=this[0];if(a)return this.each(function(x){c.offset.setOffset(this,a,x)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return c.offset.bodyOffset(b);c.offset.initialize();var d,e=b.offsetParent,f=b.ownerDocument,h=f.documentElement,l=f.body;d=(f=f.defaultView)?f.getComputedStyle(b,null):b.currentStyle;
for(var k=b.offsetTop,o=b.offsetLeft;(b=b.parentNode)&&b!==l&&b!==h;){if(c.offset.supportsFixedPosition&&d.position==="fixed")break;d=f?f.getComputedStyle(b,null):b.currentStyle;k-=b.scrollTop;o-=b.scrollLeft;if(b===e){k+=b.offsetTop;o+=b.offsetLeft;if(c.offset.doesNotAddBorder&&!(c.offset.doesAddBorderForTableAndCells&&xb.test(b.nodeName))){k+=parseFloat(d.borderTopWidth)||0;o+=parseFloat(d.borderLeftWidth)||0}e=b.offsetParent}if(c.offset.subtractsBorderForOverflowNotVisible&&d.overflow!=="visible"){k+=
parseFloat(d.borderTopWidth)||0;o+=parseFloat(d.borderLeftWidth)||0}d=d}if(d.position==="relative"||d.position==="static"){k+=l.offsetTop;o+=l.offsetLeft}if(c.offset.supportsFixedPosition&&d.position==="fixed"){k+=Math.max(h.scrollTop,l.scrollTop);o+=Math.max(h.scrollLeft,l.scrollLeft)}return{top:k,left:o}};c.offset={initialize:function(){var a=t.body,b=t.createElement("div"),d,e,f,h=parseFloat(c.css(a,"marginTop"))||0;c.extend(b.style,{position:"absolute",top:0,left:0,margin:0,border:0,width:"1px",
height:"1px",visibility:"hidden"});b.innerHTML="<div style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;'><div></div></div><table style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;' cellpadding='0' cellspacing='0'><tr><td></td></tr></table>";a.insertBefore(b,a.firstChild);d=b.firstChild;e=d.firstChild;f=d.nextSibling.firstChild.firstChild;this.doesNotAddBorder=e.offsetTop!==5;this.doesAddBorderForTableAndCells=
f.offsetTop===5;e.style.position="fixed";e.style.top="20px";this.supportsFixedPosition=e.offsetTop===20||e.offsetTop===15;e.style.position=e.style.top="";d.style.overflow="hidden";d.style.position="relative";this.subtractsBorderForOverflowNotVisible=e.offsetTop===-5;this.doesNotIncludeMarginInBodyOffset=a.offsetTop!==h;a.removeChild(b);c.offset.initialize=c.noop},bodyOffset:function(a){var b=a.offsetTop,d=a.offsetLeft;c.offset.initialize();if(c.offset.doesNotIncludeMarginInBodyOffset){b+=parseFloat(c.css(a,
"marginTop"))||0;d+=parseFloat(c.css(a,"marginLeft"))||0}return{top:b,left:d}},setOffset:function(a,b,d){var e=c.css(a,"position");if(e==="static")a.style.position="relative";var f=c(a),h=f.offset(),l=c.css(a,"top"),k=c.css(a,"left"),o=e==="absolute"&&c.inArray("auto",[l,k])>-1;e={};var x={};if(o)x=f.position();l=o?x.top:parseInt(l,10)||0;k=o?x.left:parseInt(k,10)||0;if(c.isFunction(b))b=b.call(a,d,h);if(b.top!=null)e.top=b.top-h.top+l;if(b.left!=null)e.left=b.left-h.left+k;"using"in b?b.using.call(a,
e):f.css(e)}};c.fn.extend({position:function(){if(!this[0])return null;var a=this[0],b=this.offsetParent(),d=this.offset(),e=Ia.test(b[0].nodeName)?{top:0,left:0}:b.offset();d.top-=parseFloat(c.css(a,"marginTop"))||0;d.left-=parseFloat(c.css(a,"marginLeft"))||0;e.top+=parseFloat(c.css(b[0],"borderTopWidth"))||0;e.left+=parseFloat(c.css(b[0],"borderLeftWidth"))||0;return{top:d.top-e.top,left:d.left-e.left}},offsetParent:function(){return this.map(function(){for(var a=this.offsetParent||t.body;a&&!Ia.test(a.nodeName)&&
c.css(a,"position")==="static";)a=a.offsetParent;return a})}});c.each(["Left","Top"],function(a,b){var d="scroll"+b;c.fn[d]=function(e){var f=this[0],h;if(!f)return null;if(e!==B)return this.each(function(){if(h=fa(this))h.scrollTo(!a?e:c(h).scrollLeft(),a?e:c(h).scrollTop());else this[d]=e});else return(h=fa(f))?"pageXOffset"in h?h[a?"pageYOffset":"pageXOffset"]:c.support.boxModel&&h.document.documentElement[d]||h.document.body[d]:f[d]}});c.each(["Height","Width"],function(a,b){var d=b.toLowerCase();
c.fn["inner"+b]=function(){return this[0]?parseFloat(c.css(this[0],d,"padding")):null};c.fn["outer"+b]=function(e){return this[0]?parseFloat(c.css(this[0],d,e?"margin":"border")):null};c.fn[d]=function(e){var f=this[0];if(!f)return e==null?null:this;if(c.isFunction(e))return this.each(function(l){var k=c(this);k[d](e.call(this,l,k[d]()))});if(c.isWindow(f))return f.document.compatMode==="CSS1Compat"&&f.document.documentElement["client"+b]||f.document.body["client"+b];else if(f.nodeType===9)return Math.max(f.documentElement["client"+
b],f.body["scroll"+b],f.documentElement["scroll"+b],f.body["offset"+b],f.documentElement["offset"+b]);else if(e===B){f=c.css(f,d);var h=parseFloat(f);return c.isNaN(h)?f:h}else return this.css(d,typeof e==="string"?e:e+"px")}})})(window);

$.Cafe24_SDK = false;
$.Cafe24_SDK_Url = false;

$.Cafe24_SDK_Config_Url = function(url) {
	$.Cafe24_SDK_Url = url;
};

$.Cafe24_SDK_Config_Set = function(domain, appid) {
    $.Cafe24_SDK =
    {
        'Domain': domain,
        'AppID': appid,
        'debug': false
    };
};

$.Cafe24_SDK_Config_Clear = function() {
    $.Cafe24_SDK = false;
};

$.fn.Cafe24_SDK_Upload = function(options) {
    if (!$.Cafe24_SDK) {
        alert('Cafe24_SDK: Configration not defined.');
    
        return false;
    };
    
    if ($(this).find('input[name=FILE_UPLOAD_INSTANCE]').length) {
    	alert('Cafe24_SDK: File upload has already been processed.');
    	
    	return false;
    }

    var sID = $(this).attr('id');
    var sName = $(this).attr('name');
    
    if (!sID && !sName) {
    	alert('Cafe24_SDK: Can not find the target file upload form id/name.');
    	
    	return false;
    }
    
    if (!sID) {
    	$(this).attr('id', sName);
    	sID = sName;
    }
    
    if (!sName) {
    	$(this).attr('name', sID);
    	sName = sID;
    }    
    
    var sUploadFormID = '__'+sID;

    $('<form>').attr({'id':sUploadFormID, 'name':sUploadFormID, 'action':$.Cafe24_SDK_Url, 'method':'POST'}).css('display','none').appendTo('body');
    
    $(this).find('input').each(function(){
        if ($(this).attr('type').toLowerCase()=='file') {
            $(this).appendTo($('#'+sUploadFormID));
        };
    });
    
    var sUploadKey = $.Cafe24_SDK.Domain + '_' + $.Cafe24_SDK.AppID + '_' + (new Date().getTime());
    
    options = $.extend(true, options, {
        url: $.Cafe24_SDK_Url,
        data: {'TYPE': 'FILE', 'DOMAIN': $.Cafe24_SDK.Domain, 'APP_ID': $.Cafe24_SDK.AppID, 'KEY':sUploadKey},
        dataType: 'html',
        type: 'POST',
        iframe: true,
        error: function(a, b, c) {
        	UploadFormSubmit();
        },
        success: function(responseText, statusText, xhr, form) {
        	UploadFormSubmit();
        }
    });    
    
    function UploadFormSubmit() {
    	var sFormID = '#'+sID;
    	
        $('#'+sUploadFormID).remove();
        
        $(sFormID).find('input').each(function(){
            if ($(this).attr('type').toLowerCase()=='file') {
                $(this).remove();
            };
        });	            
        
        $('<input>').attr({'type':'hidden', 'value':sUploadKey, 'name':'FILE_UPLOAD_INSTANCE'}).appendTo($(sFormID));
        $(sFormID).attr({'method':'POST'});
        
    	if (typeof options.callback == 'function') {
    		options.callback('FILE_UPLOAD_INSTANCE', sUploadKey);
        }        
        
        $(sFormID).submit();
    };
    
    $('#'+sUploadFormID).Cafe24_SDK_Upload_(options);
    
    return false;
};

/**
 * Cafe24_SDK_Upload() provides a mechanism for immediately submitting
 * an HTML form using AJAX.
 */
$.fn.Cafe24_SDK_Upload_ = function(options) {
    if (!this.length) {
        $.Cafe24_SDK_Log('Cafe24_SDK_Upload: skipping submit process - no element selected');
        return this;
    }
    
    var method, action, url, $form = this;

    if (typeof options == 'function') {
        options = { success: options };
    }

    method = this.attr('method');
    action = this.attr('action');
    url = (typeof action === 'string') ? $.trim(action) : '';
    url = url || window.location.href || '';
    if (url) {
        // clean url (don't include hash vaue)
        url = (url.match(/^([^#]+)/)||[])[1];
    }

    options = $.extend(true, {
        url:  url,
        success: $.ajaxSettings.success,
        type: method || 'GET',
        iframeSrc: /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank'
    }, options);

    // hook for manipulating the form data before it is extracted;
    // convenient for use with rich editors like tinyMCE or FCKEditor
    var veto = {};
    this.trigger('form-pre-serialize', [this, options, veto]);
    if (veto.veto) {
        $.Cafe24_SDK_Log('Cafe24_SDK_Upload: submit vetoed via form-pre-serialize trigger');
        return this;
    }

    // provide opportunity to alter form data before it is serialized
    if (options.beforeSerialize && options.beforeSerialize(this, options) === false) {
        $.Cafe24_SDK_Log('Cafe24_SDK_Upload: submit aborted via beforeSerialize callback');
        return this;
    }

    var traditional = options.traditional;
    if ( traditional === undefined ) {
        traditional = $.ajaxSettings.traditional;
    }
    
    var qx,n,v,a = $.fn.Cafe24_SDK_Upload_formToArray(options.semantic);
    if (options.data) {
        options.extraData = options.data;
        qx = $.param(options.data, traditional);
    }

    // give pre-submit callback an opportunity to abort the submit
    if (options.beforeSubmit && options.beforeSubmit(a, this, options) === false) {
        $.Cafe24_SDK_Log('Cafe24_SDK_Upload: submit aborted via beforeSubmit callback');
        return this;
    }

    // fire vetoable 'validate' event
    this.trigger('form-submit-validate', [a, this, options, veto]);
    if (veto.veto) {
        $.Cafe24_SDK_Log('Cafe24_SDK_Upload: submit vetoed via form-submit-validate trigger');
        return this;
    }

    var q = $.param(a, traditional);
    if (qx) {
        q = ( q ? (q + '&' + qx) : qx );
    }	
    if (options.type.toUpperCase() == 'GET') {
        options.url += (options.url.indexOf('?') >= 0 ? '&' : '?') + q;
        options.data = null;  // data is null for 'get'
    }
    else {
        options.data = q; // data is the query string for 'post'
    }

    var callbacks = [];

    // perform a load on the target only if dataType is not provided
    if (!options.dataType && options.target) {
        var oldSuccess = options.success || function(){};
        callbacks.push(function(data) {
            var fn = options.replaceTarget ? 'replaceWith' : 'html';
            $(options.target)[fn](data).each(oldSuccess, arguments);
        });
    }
    else if (options.success) {
        callbacks.push(options.success);
    }

    options.success = function(data, status, xhr) { // jQuery 1.4+ passes xhr as 3rd arg
        var context = options.context || options;	// jQuery 1.4+ supports scope context 
        for (var i=0, max=callbacks.length; i < max; i++) {
            callbacks[i].apply(context, [data, status, xhr || $form, $form]);
        }
    };

    // are there files to upload?
    var fileInputs = $('input:file:enabled[value]', this); // [value] (issue #113)
    var hasFileInputs = fileInputs.length > 0;
    var mp = 'multipart/form-data';
    var multipart = ($form.attr('enctype') == mp || $form.attr('encoding') == mp);

    var fileAPI = !!(hasFileInputs && fileInputs.get(0).files && window.FormData);
    $.Cafe24_SDK_Log("fileAPI :" + fileAPI);
    var shouldUseFrame = (hasFileInputs || multipart) && !fileAPI;

    // options.iframe allows user to force iframe mode
    // 06-NOV-09: now defaulting to iframe mode if file input is detected
    if (options.iframe !== false && (options.iframe || shouldUseFrame)) {
        // hack to fix Safari hang (thanks to Tim Molendijk for this)
        // see:  http://groups.google.com/group/jquery-dev/browse_thread/thread/36395b7ab510dd5d
        if (options.closeKeepAlive) {
            $.get(options.closeKeepAlive, function() {
                fileUploadIframe(a);
            });
        }
        else {
            fileUploadIframe(a);
        }
    }
    else if ((hasFileInputs || multipart) && fileAPI) {
        options.progress = options.progress || $.noop;
        fileUploadXhr(a);
    }
    else {
        $.ajax(options);
    }

     // fire 'notify' event
     this.trigger('form-submit-notify', [this, options]);
     return this;

     // XMLHttpRequest Level 2 file uploads (big hat tip to francois2metz)
    function fileUploadXhr(a) {
        var formdata = new FormData();

        for (var i=0; i < a.length; i++) {
            if (a[i].type == 'file')
                continue;
            formdata.append(a[i].name, a[i].value);
        }

        $form.find('input:file:enabled').each(function(){
            var name = $(this).attr('name'), files = this.files;
            if (name) {
                for (var i=0; i < files.length; i++)
                    formdata.append(name, files[i]);
            }
        });

        if (options.extraData) {
            for (var k in options.extraData)
                formdata.append(k, options.extraData[k])
        }

        options.data = null;

        var s = $.extend(true, {}, $.ajaxSettings, options, {
            contentType: false,
            processData: false,
            cache: false,
            type: 'POST'
        });

        //s.context = s.context || s;

        s.data = null;
        var beforeSend = s.beforeSend;
        s.beforeSend = function(xhr, o) {
		    o.data = formdata;
		    if(xhr.upload) { // unfortunately, jQuery doesn't expose this prop (http://bugs.jquery.com/ticket/10190)
		        xhr.upload.onprogress = function(event) {
		            o.progress(event.position, event.total);
		        };
		    }
            if(beforeSend)
			    beforeSend.call(o, xhr, options);
        };
        
        $.ajax(s);
	}

    // private function for handling file uploads (hat tip to YAHOO!)
    function fileUploadIframe(a) {
        var form = $form[0], el, i, s, g, id, $io, io, xhr, sub, n, timedOut, timeoutHandle;
        var useProp = !!$.fn.prop;

        if (a) {
            if ( useProp ) {
                // ensure that every serialized input is still enabled
                for (i=0; i < a.length; i++) {
                    el = $(form[a[i].name]);
                    el.prop('disabled', false);
                }
            } else {
                for (i=0; i < a.length; i++) {
                    el = $(form[a[i].name]);
                    el.removeAttr('disabled');
                }
            };
        }

        if ($(':input[name=submit],:input[id=submit]', form).length) {
            // if there is an input with a name or id of 'submit' then we won't be
            // able to invoke the submit fn on the form (at least not x-browser)
            alert('Error: Form elements must not have name or id of "submit".');
            return;
        }
        
        s = $.extend(true, {}, $.ajaxSettings, options);
        s.context = s.context || s;
        id = 'jqFormIO' + (new Date().getTime());
        if (s.iframeTarget) {
            $io = $(s.iframeTarget);
            n = $io.attr('name');
            if (n == null)
                $io.attr('name', id);
            else
                id = n;
        }
        else {
            $io = $('<iframe name="' + id + '" src="'+ s.iframeSrc +'" />');
            $io.css({ position: 'absolute', top: '-1000px', left: '-1000px' });
        }
        io = $io[0];


        xhr = { // mock object
            aborted: 0,
            responseText: null,
            responseXML: null,
            status: 0,
            statusText: 'n/a',
            getAllResponseHeaders: function() {},
            getResponseHeader: function() {},
            setRequestHeader: function() {},
            abort: function(status) {
                var e = (status === 'timeout' ? 'timeout' : 'aborted');
                $.Cafe24_SDK_Log('aborting upload... ' + e);
                this.aborted = 1;
                $io.attr('src', s.iframeSrc); // abort op in progress
                xhr.error = e;
                s.error && s.error.call(s.context, xhr, e, status);
                g && $.event.trigger("ajaxError", [xhr, s, e]);
                s.complete && s.complete.call(s.context, xhr, e);
            }
        };

        g = s.global;
        // trigger ajax global events so that activity/block indicators work like normal
        if (g && ! $.active++) {
            $.event.trigger("ajaxStart");
        }
        if (g) {
            $.event.trigger("ajaxSend", [xhr, s]);
        }

        if (s.beforeSend && s.beforeSend.call(s.context, xhr, s) === false) {
            if (s.global) {
                $.active--;
            }
            return;
        }
        if (xhr.aborted) {
            return;
        }

        // add submitting element to data if we know it
        sub = form.clk;
        if (sub) {
            n = sub.name;
            if (n && !sub.disabled) {
                s.extraData = s.extraData || {};
                s.extraData[n] = sub.value;
                if (sub.type == "image") {
                    s.extraData[n+'.x'] = form.clk_x;
                    s.extraData[n+'.y'] = form.clk_y;
                }
            }
        }
        
        var CLIENT_TIMEOUT_ABORT = 1;
        var SERVER_ABORT = 2;

        function getDoc(frame) {
            var doc = frame.contentWindow ? frame.contentWindow.document : frame.contentDocument ? frame.contentDocument : frame.document;
            return doc;
        }
        
        // Rails CSRF hack (thanks to Yvan Barthelemy)
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var csrf_param = $('meta[name=csrf-param]').attr('content');
        if (csrf_param && csrf_token) {
            s.extraData = s.extraData || {};
            s.extraData[csrf_param] = csrf_token;
        }

        // take a breath so that pending repaints get some cpu time before the upload starts
        function doSubmit() {
            // make sure form attrs are set
            var t = $form.attr('target'), a = $form.attr('action');

            // update form attrs in IE friendly way
            form.setAttribute('target',id);
            if (!method) {
                form.setAttribute('method', 'POST');
            }
            if (a != s.url) {
                form.setAttribute('action', s.url);
            }

            // ie borks in some cases when setting encoding
            if (! s.skipEncodingOverride && (!method || /post/i.test(method))) {
                $form.attr({
                    encoding: 'multipart/form-data',
                    enctype:  'multipart/form-data'
                });
            }

            // support timout
            if (s.timeout) {
                timeoutHandle = setTimeout(function() { timedOut = true; cb(CLIENT_TIMEOUT_ABORT); }, s.timeout);
            }
            
            // look for server aborts
            function checkState() {
                try {
                    var state = getDoc(io).readyState;
                    $.Cafe24_SDK_Log('state = ' + state);
                    if (state && state.toLowerCase() == 'uninitialized')
                        setTimeout(checkState,50);
                }
                catch(e) {
                    $.Cafe24_SDK_Log('Server abort: ' , e, ' (', e.name, ')');
                    cb(SERVER_ABORT);
                    timeoutHandle && clearTimeout(timeoutHandle);
                    timeoutHandle = undefined;
                }
            }

            // add "extra" data to form if provided in options
            var extraInputs = [];
            try {
                if (s.extraData) {
                    for (var n in s.extraData) {
                        extraInputs.push(
                            $('<input type="hidden" name="'+n+'">').attr('value',s.extraData[n])
                                .appendTo(form)[0]);
                    }
                }

                if (!s.iframeTarget) {
                    // add iframe to doc and submit the form
                    $io.appendTo('body');
                    io.attachEvent ? io.attachEvent('onload', cb) : io.addEventListener('load', cb, false);
                }
                
                setTimeout(checkState,15);
                form.submit();
            }
            finally {
                // reset attrs and remove "extra" input elements
                form.setAttribute('action',a);
                if(t) {
                    form.setAttribute('target', t);
                } else {
                    $form.removeAttr('target');
                }
                $(extraInputs).remove();
            }
        }

        if (s.forceSync) {
            doSubmit();
        }
        else {
            setTimeout(doSubmit, 10); // this lets dom updates render
        }

        var data, doc, domCheckCount = 50, callbackProcessed;

        function cb(e) {
            if (xhr.aborted || callbackProcessed) {
                return;
            }
            
            if (!jQuery.browser.mozilla && !jQuery.browser.msie) {
            	xhr.abort('not supported');
            	return;
            }
            
            try {
                doc = getDoc(io);
            }
            catch(ex) {
                $.Cafe24_SDK_Log('cannot access response document: ', ex);
                e = SERVER_ABORT;
            }

            if (e === CLIENT_TIMEOUT_ABORT && xhr) {
                xhr.abort('timeout');
                return;
            }
            else if (e == SERVER_ABORT && xhr) {
                xhr.abort('server abort');
                return;
            }

            if (!doc || doc.location.href == s.iframeSrc) {
                // response not received yet
                if (!timedOut)
                    return;
            }
            io.detachEvent ? io.detachEvent('onload', cb) : io.removeEventListener('load', cb, false);

            var status = 'success', errMsg;
            try {
                if (timedOut) {
                    throw 'timeout';
                }

                var isXml = s.dataType == 'xml' || doc.XMLDocument || $.isXMLDoc(doc);
                $.Cafe24_SDK_Log('isXml='+isXml);
                if (!isXml && window.opera && (doc.body == null || doc.body.innerHTML == '')) {
                    if (--domCheckCount) {
                        // in some browsers (Opera) the iframe DOM is not always traversable when
                        // the onload callback fires, so we loop a bit to accommodate
                        $.Cafe24_SDK_Log('requeing onLoad callback, DOM not available');
                        setTimeout(cb, 250);
                        return;
                    }
                    // let this fall through because server response could be an empty document
                    //$.Cafe24_SDK_Log('Could not access iframe DOM after mutiple tries.');
                    //throw 'DOMException: not available';
                }

                //$.Cafe24_SDK_Log('response detected');
                var docRoot = doc.body ? doc.body : doc.documentElement;
                xhr.responseText = docRoot ? docRoot.innerHTML : null;
                xhr.responseXML = doc.XMLDocument ? doc.XMLDocument : doc;
                if (isXml)
                    s.dataType = 'xml';
                xhr.getResponseHeader = function(header){
                    var headers = {'content-type': s.dataType};
                    return headers[header];
                };
                // support for XHR 'status' & 'statusText' emulation :
                if (docRoot) {
                    xhr.status = Number( docRoot.getAttribute('status') ) || xhr.status;
                    xhr.statusText = docRoot.getAttribute('statusText') || xhr.statusText;
                }

                var dt = (s.dataType || '').toLowerCase();
                var scr = /(json|script|text)/.test(dt);
                if (scr || s.textarea) {
                    // see if user embedded response in textarea
                    var ta = doc.getElementsByTagName('textarea')[0];
                    if (ta) {
                        xhr.responseText = ta.value;
                        // support for XHR 'status' & 'statusText' emulation :
                        xhr.status = Number( ta.getAttribute('status') ) || xhr.status;
                        xhr.statusText = ta.getAttribute('statusText') || xhr.statusText;
                    }
                    else if (scr) {
                        // account for browsers injecting pre around json response
                        var pre = doc.getElementsByTagName('pre')[0];
                        var b = doc.getElementsByTagName('body')[0];
                        if (pre) {
                            xhr.responseText = pre.textContent ? pre.textContent : pre.innerText;
                        }
                        else if (b) {
                            xhr.responseText = b.textContent ? b.textContent : b.innerText;
                        }
                    }
                }
                else if (dt == 'xml' && !xhr.responseXML && xhr.responseText != null) {
                    xhr.responseXML = toXml(xhr.responseText);
                }

                try {
                    data = httpData(xhr, dt, s);
                }
                catch (e) {
                    status = 'parsererror';
                    xhr.error = errMsg = (e || status);
                }
            }
            catch (e) {
                $.Cafe24_SDK_Log('error caught: ',e);
                status = 'error';
                xhr.error = errMsg = (e || status);
            }

            if (xhr.aborted) {
                $.Cafe24_SDK_Log('upload aborted');
                status = null;
            }

            if (xhr.status) { // we've set xhr.status
                status = (xhr.status >= 200 && xhr.status < 300 || xhr.status === 304) ? 'success' : 'error';
            }

            // ordering of these callbacks/triggers is odd, but that's how $.ajax does it
            if (status === 'success') {
                s.success && s.success.call(s.context, data, 'success', xhr);
                g && $.event.trigger("ajaxSuccess", [xhr, s]);
            }
            else if (status) {
                if (errMsg == undefined)
                    errMsg = xhr.statusText;
                s.error && s.error.call(s.context, xhr, status, errMsg);
                g && $.event.trigger("ajaxError", [xhr, s, errMsg]);
            }

            g && $.event.trigger("ajaxComplete", [xhr, s]);

            if (g && ! --$.active) {
                $.event.trigger("ajaxStop");
            }

            s.complete && s.complete.call(s.context, xhr, status);

            callbackProcessed = true;
            if (s.timeout)
                clearTimeout(timeoutHandle);

            // clean up
            setTimeout(function() {
                if (!s.iframeTarget)
                    $io.remove();
                xhr.responseXML = null;
            }, 100);
        }

        var toXml = $.parseXML || function(s, doc) { // use parseXML if available (jQuery 1.5+)
            if (window.ActiveXObject) {
                doc = new ActiveXObject('Microsoft.XMLDOM');
                doc.async = 'false';
                doc.loadXML(s);
            }
            else {
                doc = (new DOMParser()).parseFromString(s, 'text/xml');
            }
            return (doc && doc.documentElement && doc.documentElement.nodeName != 'parsererror') ? doc : null;
        };
        var parseJSON = $.parseJSON || function(s) {
            return window['eval']('(' + s + ')');
        };

        var httpData = function( xhr, type, s ) { // mostly lifted from jq1.4.4

            var ct = xhr.getResponseHeader('content-type') || '',
                xml = type === 'xml' || !type && ct.indexOf('xml') >= 0,
                data = xml ? xhr.responseXML : xhr.responseText;

            if (xml && data.documentElement.nodeName === 'parsererror') {
                $.error && $.error('parsererror');
            }
            if (s && s.dataFilter) {
                data = s.dataFilter(data, type);
            }
            if (typeof data === 'string') {
                if (type === 'json' || !type && ct.indexOf('json') >= 0) {
                    data = parseJSON(data);
                } else if (type === "script" || !type && ct.indexOf("javascript") >= 0) {
                    $.globalEval(data);
                }
            }
            return data;
        };
    }
};

/**
 * formToArray() gathers form element data into an array of objects that can
 * be passed to any of the following ajax functions: $.get, $.post, or load.
 * Each object in the array has both a 'name' and 'value' property.  An example of
 * an array for a simple login form might be:
 *
 * [ { name: 'username', value: 'jresig' }, { name: 'password', value: 'secret' } ]
 *
 * It is this array that is passed to pre-submit callback functions provided to the
 * Cafe24_SDK_Upload() and ajaxForm() methods.
 */
$.fn.Cafe24_SDK_Upload_formToArray = function(semantic) {
	var a = [];
	if (this.length === 0) {
		return a;
	}

	var form = this[0];
	var els = semantic ? form.getElementsByTagName('*') : form.elements;
	if (!els) {
		return a;
	}

	var i,j,n,v,el,max,jmax;
	for(i=0, max=els.length; i < max; i++) {
		el = els[i];
		n = el.name;
		if (!n) {
			continue;
		}

		if (semantic && form.clk && el.type == "image") {
			// handle image inputs on the fly when semantic == true
			if(!el.disabled && form.clk == el) {
				a.push({name: n, value: $(el).val(), type: el.type });
				a.push({name: n+'.x', value: form.clk_x}, {name: n+'.y', value: form.clk_y});
			}
			continue;
		}

		v = $.Cafe24_SDK_Upload_fieldValue(el, true);
		if (v && v.constructor == Array) {
			for(j=0, jmax=v.length; j < jmax; j++) {
				a.push({name: n, value: v[j]});
			}
		}
		else if (v !== null && typeof v != 'undefined') {
			a.push({name: n, value: v, type: el.type});
		}
	}

	if (!semantic && form.clk) {
		// input type=='image' are not found in elements array! handle it here
		var $input = $(form.clk), input = $input[0];
		n = input.name;
		if (n && !input.disabled && input.type == 'image') {
			a.push({name: n, value: $input.val()});
			a.push({name: n+'.x', value: form.clk_x}, {name: n+'.y', value: form.clk_y});
		}
	}
	return a;
};

/**
 * Returns the value(s) of the element in the matched set.  For example, consider the following form:
 *
 *  <form><fieldset>
 *	  <input name="A" type="text" />
 *	  <input name="A" type="text" />
 *	  <input name="B" type="checkbox" value="B1" />
 *	  <input name="B" type="checkbox" value="B2"/>
 *	  <input name="C" type="radio" value="C1" />
 *	  <input name="C" type="radio" value="C2" />
 *  </fieldset></form>
 *
 *  var v = $(':text').Cafe24_SDK_Upload_fieldValue();
 *  // if no values are entered into the text inputs
 *  v == ['','']
 *  // if values entered into the text inputs are 'foo' and 'bar'
 *  v == ['foo','bar']
 *
 *  var v = $(':checkbox').Cafe24_SDK_Upload_fieldValue();
 *  // if neither checkbox is checked
 *  v === undefined
 *  // if both checkboxes are checked
 *  v == ['B1', 'B2']
 *
 *  var v = $(':radio')_fieldValue();
 *  // if neither radio is checked
 *  v === undefined
 *  // if first radio is checked
 *  v == ['C1']
 *
 * The successful argument controls whether or not the field element must be 'successful'
 * (per http://www.w3.org/TR/html4/interact/forms.html#successful-controls).
 * The default value of the successful argument is true.  If this value is false the value(s)
 * for each element is returned.
 *
 * Note: This method *always* returns an array.  If no valid value can be determined the
 *	array will be empty, otherwise it will contain one or more values.
 */
$.fn.Cafe24_SDK_Upload_fieldValue = function(successful) {
	for (var val=[], i=0, max=this.length; i < max; i++) {
		var el = this[i];
		var v = $.Cafe24_SDK_Upload_fieldValue(el, successful);
		if (v === null || typeof v == 'undefined' || (v.constructor == Array && !v.length)) {
			continue;
		}
		v.constructor == Array ? $.merge(val, v) : val.push(v);
	}
	return val;
};

/**
 * Returns the value of the field element.
 */
$.Cafe24_SDK_Upload_fieldValue = function(el, successful) {
	var n = el.name, t = el.type, tag = el.tagName.toLowerCase();
	if (successful === undefined) {
		successful = true;
	}

	if (successful && (!n || el.disabled || t == 'reset' || t == 'button' ||
		(t == 'checkbox' || t == 'radio') && !el.checked ||
		(t == 'submit' || t == 'image') && el.form && el.form.clk != el ||
		tag == 'select' && el.selectedIndex == -1)) {
			return null;
	}

	if (tag == 'select') {
		var index = el.selectedIndex;
		if (index < 0) {
			return null;
		}
		var a = [], ops = el.options;
		var one = (t == 'select-one');
		var max = (one ? index+1 : ops.length);
		for(var i=(one ? index : 0); i < max; i++) {
			var op = ops[i];
			if (op.selected) {
				var v = op.value;
				if (!v) { // extra pain for IE...
					v = (op.attributes && op.attributes['value'] && !(op.attributes['value'].specified)) ? op.text : op.value;
				}
				if (one) {
					return v;
				}
				a.push(v);
			}
		}
		return a;
	}
	return $(el).val();
};

$.Cafe24_SizeRefresh = function() {
	if (parent && parent!=undefined && parent!=null && typeof(parent.APPS_Func_SizeFrameByAppsXansiFrame)=='function') {
		parent.APPS_Func_SizeFrameByAppsXansiFrame();
	}
};

$.Cafe24_SDK_Log = function() {
	if (!$.Cafe24_SDK.debug) 
		return;
	var msg = '[Cafe24-SDK] ' + Array.prototype.join.call(arguments,'');
	if (window.console && window.console.log) {
		window.console.log(msg);
	}
	else if (window.opera && window.opera.postError) {
		window.opera.postError(msg);
	}
};
/*
* php의 sprintf와 사용방법은 비슷하나 문자열 포멧의 type specifier는 %s만 사용
* 참조 : http://wiki.simplexi.com/pages/viewpage.action?pageId=125338699
*/
function sprintf()
{
    var pattern = /%([0-9]+)\$s/g;
    
    var text = arguments[0];
    var extract = text.match(pattern, text);

    if (extract == null || extract.length < 0) {
        var split = text.split('%s');
        var count = split.length;
        var tmp = new Array();
        
        for (var i = 0; i < count; i++) {
            if (typeof arguments[i + 1] != 'undefined') {
                tmp.push(split[i] + arguments[i + 1]);
            } else {
                tmp.push(split[i]);
            }
        }
        
        return tmp.join('');
    } else {
        var count = extract.length;
        
        for (var i = 0; i < count; i++) {
            var index = extract[i].replace(pattern, '$1');
            if (typeof arguments[index] != 'undefined') {
                text = text.replace('%' + index + '$s', arguments[index]);
            }
        }
        
        return text;
    }
}
/*
 * 각개체 별 항목 컨트롤 을 위해서 차후 확장을 고려 하여 별도로 추출
 * 
 */

secondZipcodeHidden();

function secondZipcodeHidden () {
    
    //Front Page 우편번호 2번째 엘레멘트 리스트
    var secondZipcodeElementId = new Array (
            "postcode2",
            "rzipcode2",
            "ozipcode2",
            "zip2",
            "address_zip2"
            );

    for (var i in secondZipcodeElementId) {
        try {
            document.getElementById(secondZipcodeElementId[i]).style.display = "none";
        } catch (e){ }
    }

    // 구디자인 회원 가입수정 zip2 제거
    try {
        document.frm.zip2.style.display = "none";
    } catch (e) { }

    // 구디자인 배송목록 zip2 제거
    try {
        document.addr_set.rcv_zipcode2.style.display = "none";
    } catch (e) { }

    // 구디자인 주문서 작성 zip2 제거
    try {
        document.frm.rzipcode2.style.display = "none";
        document.frm.ozipcode2.style.display = "none";
    } catch (e) { }

    // 구디자인 세금계산서 신청약식 zip2 제거
    try {
        document.frm.mall_zipcode2.style.display = "none";
    } catch (e) { }
}

/*! Copyright (c) 2013 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version 3.0.0
 */

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    $.fn.bgiframe = function(s) {
        s = $.extend({
            top         : 'auto', // auto == borderTopWidth
            left        : 'auto', // auto == borderLeftWidth
            width       : 'auto', // auto == offsetWidth
            height      : 'auto', // auto == offsetHeight
            opacity     : true,
            src         : 'javascript:false;',
            conditional : /MSIE 6.0/.test(navigator.userAgent) // expresion or function. return false to prevent iframe insertion
        }, s);

        // wrap conditional in a function if it isn't already
        if (!$.isFunction(s.conditional)) {
            var condition = s.conditional;
            s.conditional = function() { return condition; };
        }

        var $iframe = $('<iframe class="bgiframe"frameborder="0"tabindex="-1"src="'+s.src+'"'+
                           'style="display:block;position:absolute;z-index:-1;"/>');

        return this.each(function() {
            var $this = $(this);
            if ( s.conditional(this) === false ) { return; }
            var existing = $this.children('iframe.bgiframe');
            var $el = existing.length === 0 ? $iframe.clone() : existing;
            $el.css({
                'top': s.top == 'auto' ?
                    ((parseInt($this.css('borderTopWidth'),10)||0)*-1)+'px' : prop(s.top),
                'left': s.left == 'auto' ?
                    ((parseInt($this.css('borderLeftWidth'),10)||0)*-1)+'px' : prop(s.left),
                'width': s.width == 'auto' ? (this.offsetWidth + 'px') : prop(s.width),
                'height': s.height == 'auto' ? (this.offsetHeight + 'px') : prop(s.height),
                'opacity': s.opacity === true ? 0 : undefined
            });

            if ( existing.length === 0 ) {
                $this.prepend($el);
            }
        });
    };

    // old alias
    $.fn.bgIframe = $.fn.bgiframe;

    function prop(n) {
        return n && n.constructor === Number ? n + 'px' : n;
    }

}));
/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * Create a cookie with the given name and value and other optional parameters.
 *
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Set the value of a cookie.
 * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
 * @desc Create a cookie with all available options.
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Create a session cookie.
 * @example $.cookie('the_cookie', null);
 * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
 *       used when the cookie was set.
 *
 * @param String name The name of the cookie.
 * @param String value The value of the cookie.
 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
 *                             when the the browser exits.
 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
 *                        require a secure protocol (like HTTPS).
 * @type undefined
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */

/**
 * Get the value of a cookie with the given name.
 *
 * @example $.cookie('the_cookie');
 * @desc Get the value of a cookie.
 *
 * @param String name The name of the cookie.
 * @return The value of the cookie.
 * @type String
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options = $.extend({}, options); // clone object since it's unexpected behavior if the expired property were changed
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // NOTE Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
/* Copyright (c) 2007 Paul Bakaus (paul.bakaus@googlemail.com) and Brandon Aaron (brandon.aaron@gmail.com || http://brandonaaron.net)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * $LastChangedDate: 2007-12-20 08:46:55 -0600 (Thu, 20 Dec 2007) $
 * $Rev: 4259 $
 *
 * Version: 1.2
 *
 * Requires: jQuery 1.2+
 */

(function($){

$.dimensions = {
    version: '1.2'
};

// Create innerHeight, innerWidth, outerHeight and outerWidth methods
$.each( [ 'Height', 'Width' ], function(i, name){

    // innerHeight and innerWidth
    $.fn[ 'inner' + name ] = function() {
    if (!this[0]) return;

    var torl = name == 'Height' ? 'Top'    : 'Left',  // top or left
        borr = name == 'Height' ? 'Bottom' : 'Right'; // bottom or right

    return this.is(':visible') ? this[0]['client' + name] : num( this, name.toLowerCase() ) + num(this, 'padding' + torl) + num(this, 'padding' + borr);
    };

    // outerHeight and outerWidth
    $.fn[ 'outer' + name ] = function(options) {
    if (!this[0]) return;

    var torl = name == 'Height' ? 'Top'    : 'Left',  // top or left
        borr = name == 'Height' ? 'Bottom' : 'Right'; // bottom or right

    options = $.extend({ margin: false }, options || {});

    var val = this.is(':visible') ?
    this[0]['offset' + name] :
    num( this, name.toLowerCase() )
    + num(this, 'border' + torl + 'Width') + num(this, 'border' + borr + 'Width')
    + num(this, 'padding' + torl) + num(this, 'padding' + borr);

    return val + (options.margin ? (num(this, 'margin' + torl) + num(this, 'margin' + borr)) : 0);
    };
});

// Create scrollLeft and scrollTop methods
$.each( ['Left', 'Top'], function(i, name) {
    $.fn[ 'scroll' + name ] = function(val) {
    if (!this[0]) return;

    return val != undefined ?

    // Set the scroll offset
    this.each(function() {
    this == window || this == document ?
    window.scrollTo(
    name == 'Left' ? val : $(window)[ 'scrollLeft' ](),
    name == 'Top'  ? val : $(window)[ 'scrollTop'  ]()
    ) :
    this[ 'scroll' + name ] = val;
    }) :

    // Return the scroll offset
    this[0] == window || this[0] == document ?
    self[ (name == 'Left' ? 'pageXOffset' : 'pageYOffset') ] ||
    $.boxModel && document.documentElement[ 'scroll' + name ] ||
    document.body[ 'scroll' + name ] :
    this[0][ 'scroll' + name ];
    };
});

$.fn.extend({
    position: function() {
    var left = 0, top = 0, elem = this[0], offset, parentOffset, offsetParent, results;

    if (elem) {
    // Get *real* offsetParent
    offsetParent = this.offsetParent();

    // Get correct offsets
    offset       = this.offset();
    parentOffset = offsetParent.offset();

    // Subtract element margins
    offset.top  -= num(elem, 'marginTop');
    offset.left -= num(elem, 'marginLeft');

    // Add offsetParent borders
    parentOffset.top  += num(offsetParent, 'borderTopWidth');
    parentOffset.left += num(offsetParent, 'borderLeftWidth');

    // Subtract the two offsets
    results = {
    top:  offset.top  - parentOffset.top,
    left: offset.left - parentOffset.left
    };
    }

    return results;
    },

    offsetParent: function() {
    var offsetParent = this[0].offsetParent;
    while ( offsetParent && (!/^body|html$/i.test(offsetParent.tagName) && $.css(offsetParent, 'position') == 'static') )
    offsetParent = offsetParent.offsetParent;
    return $(offsetParent);
    }
});

function num(el, prop) {
    return parseInt($.curCSS(el.jquery?el[0]:el,prop,true))||0;
};

})(jQuery);

/*
 * jQuery Easing v1.1.1 - http://gsgd.co.uk/sandbox/jquery.easing.php
 *
 * Uses the built in easing capabilities added in jQuery 1.1
 * to offer multiple easing options
 *
 * Copyright (c) 2007 George Smith
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */

jQuery.extend(jQuery.easing, {
    easein: function(x, t, b, c, d) {
    return c*(t/=d)*t + b; // in
    },
    easeinout: function(x, t, b, c, d) {
    if (t < d/2) return 2*c*t*t/(d*d) + b;
    var ts = t - d/2;
    return -2*c*ts*ts/(d*d) + 2*c*ts/d + c/2 + b;
    },
    easeout: function(x, t, b, c, d) {
    return -c*t*t/(d*d) + 2*c*t/d + b;
    },
    expoin: function(x, t, b, c, d) {
    var flip = 1;
    if (c < 0) {
    flip *= -1;
    c *= -1;
    }
    return flip * (Math.exp(Math.log(c)/d * t)) + b;
    },
    expoout: function(x, t, b, c, d) {
    var flip = 1;
    if (c < 0) {
    flip *= -1;
    c *= -1;
    }
    return flip * (-Math.exp(-Math.log(c)/d * (t-d)) + c + 1) + b;
    },
    expoinout: function(x, t, b, c, d) {
    var flip = 1;
    if (c < 0) {
    flip *= -1;
    c *= -1;
    }
    if (t < d/2) return flip * (Math.exp(Math.log(c/2)/(d/2) * t)) + b;
    return flip * (-Math.exp(-2*Math.log(c/2)/d * (t-d)) + c + 1) + b;
    },
    bouncein: function(x, t, b, c, d) {
    return c - jQuery.easing['bounceout'](x, d-t, 0, c, d) + b;
    },
    bounceout: function(x, t, b, c, d) {
    if ((t/=d) < (1/2.75)) {
    return c*(7.5625*t*t) + b;
    } else if (t < (2/2.75)) {
    return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
    } else if (t < (2.5/2.75)) {
    return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
    } else {
    return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
    }
    },
    bounceinout: function(x, t, b, c, d) {
    if (t < d/2) return jQuery.easing['bouncein'] (x, t*2, 0, c, d) * .5 + b;
    return jQuery.easing['bounceout'] (x, t*2-d,0, c, d) * .5 + c*.5 + b;
    },
    elasin: function(x, t, b, c, d) {
    var s=1.70158;var p=0;var a=c;
    if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
    if (a < Math.abs(c)) { a=c; var s=p/4; }
    else var s = p/(2*Math.PI) * Math.asin (c/a);
    return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
    },
    elasout: function(x, t, b, c, d) {
    var s=1.70158;var p=0;var a=c;
    if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
    if (a < Math.abs(c)) { a=c; var s=p/4; }
    else var s = p/(2*Math.PI) * Math.asin (c/a);
    return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
    },
    elasinout: function(x, t, b, c, d) {
    var s=1.70158;var p=0;var a=c;
    if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
    if (a < Math.abs(c)) { a=c; var s=p/4; }
    else var s = p/(2*Math.PI) * Math.asin (c/a);
    if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
    return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
    },
    backin: function(x, t, b, c, d) {
    var s=1.70158;
    return c*(t/=d)*t*((s+1)*t - s) + b;
    },
    backout: function(x, t, b, c, d) {
    var s=1.70158;
    return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
    },
    backinout: function(x, t, b, c, d) {
    var s=1.70158;
    if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
    return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
    }
});
/*
 * Metadata - jQuery plugin for parsing metadata from elements
 *
 * Copyright (c) 2006 John Resig, Yehuda Katz, J�örn Zaefferer, Paul McLanahan
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * Revision: $Id$
 *
 */

/**
 * Sets the type of metadata to use. Metadata is encoded in JSON, and each property
 * in the JSON will become a property of the element itself.
 *
 * There are three supported types of metadata storage:
 *
 *   attr:  Inside an attribute. The name parameter indicates *which* attribute.
 *
 *   class: Inside the class attribute, wrapped in curly braces: { }
 *
 *   elem:  Inside a child element (e.g. a script tag). The
 *          name parameter indicates *which* element.
 *
 * The metadata for an element is loaded the first time the element is accessed via jQuery.
 *
 * As a result, you can define the metadata type, use $(expr) to load the metadata into the elements
 * matched by expr, then redefine the metadata type and run another $(expr) for other elements.
 *
 * @name $.metadata.setType
 *
 * @example <p id="one" class="some_class {item_id: 1, item_label: 'Label'}">This is a p</p>
 * @before $.metadata.setType("class")
 * @after $("#one").metadata().item_id == 1; $("#one").metadata().item_label == "Label"
 * @desc Reads metadata from the class attribute
 *
 * @example <p id="one" class="some_class" data="{item_id: 1, item_label: 'Label'}">This is a p</p>
 * @before $.metadata.setType("attr", "data")
 * @after $("#one").metadata().item_id == 1; $("#one").metadata().item_label == "Label"
 * @desc Reads metadata from a "data" attribute
 *
 * @example <p id="one" class="some_class"><script>{item_id: 1, item_label: 'Label'}</script>This is a p</p>
 * @before $.metadata.setType("elem", "script")
 * @after $("#one").metadata().item_id == 1; $("#one").metadata().item_label == "Label"
 * @desc Reads metadata from a nested script element
 *
 * @param String type The encoding type
 * @param String name The name of the attribute to be used to get metadata (optional)
 * @cat Plugins/Metadata
 * @descr Sets the type of encoding to be used when loading metadata for the first time
 * @type undefined
 * @see metadata()
 */

(function($) {

$.extend({
    metadata : {
    defaults : {
    type: 'class',
    name: 'metadata',
    cre: /({.*})/,
    single: 'metadata'
    },
    setType: function( type, name ){
    this.defaults.type = type;
    this.defaults.name = name;
    },
    get: function( elem, opts ){
    var settings = $.extend({},this.defaults,opts);
    // check for empty string in single property
    if ( !settings.single.length ) settings.single = 'metadata';

    var data = $.data(elem, settings.single);
    // returned cached data if it already exists
    if ( data ) return data;

    data = "{}";

    if ( settings.type == "class" ) {
    var m = settings.cre.exec( elem.className );
    if ( m )
    data = m[1];
    } else if ( settings.type == "elem" ) {
    if( !elem.getElementsByTagName )
    return undefined;
    var e = elem.getElementsByTagName(settings.name);
    if ( e.length )
    data = $.trim(e[0].innerHTML);
    } else if ( elem.getAttribute != undefined ) {
    var attr = elem.getAttribute( settings.name );
    if ( attr )
    data = attr;
    }

    if ( data.indexOf( '{' ) <0 )
    data = "{" + data + "}";

    data = eval("(" + data + ")");

    $.data( elem, settings.single, data );
    return data;
    }
    }
});

/**
 * Returns the metadata object for the first member of the jQuery object.
 *
 * @name metadata
 * @descr Returns element's metadata object
 * @param Object opts An object contianing settings to override the defaults
 * @type jQuery
 * @cat Plugins/Metadata
 */
$.fn.metadata = function( opts ){
    return $.metadata.get( this[0], opts );
};

})(jQuery);

CAPP_SHOP_FRONT_COMMON_UTIL = {
    findTargetFrame : function()
    {
        //팝업창 일경우에는 바로 opener를 반환
        if (CAPP_SHOP_FRONT_COMMON_UTIL.isPopupFromThisShopFront() === true) {
            return window.opener;
        }

        try {
            var bIsIframe = false;
            var sUrl = document.location.pathname + document.location.search;

            //parent의 프레임내용에서 현재주소와 동일 url을 가진 아이프레임이 있다면 아이프레임에서 실행된것으로 판단하고 parent를 반환
            $(parent.document).find('iframe').each(function() {
                if (sUrl === $(this).attr('src')) {
                    bIsIframe = true;
                    return false;
                };
            });
            if (bIsIframe === true) {
                return parent;
            }
        } catch(e) {}

        //그 이외(일반페이지, 프레임셋)에서는 현재페이지에서 이동되는것으로 함
        return document;
    },

    /**
     * 기존 코드와의 호환성 때문에 남겨둠
     * @return bool
     * @deprecated
     */
    isAdminOpener : function()
    {
        return this.isPopupFromThisShopFront();
    },

    /**
     * 현재 창이 동일 쇼핑몰 내의 프론트에서 열려진 팝업창인지 리턴
     * @return bool 동일 쇼핑몰 내의 프론트에서 열려진 팝업창이면 true, 아니면 false
     */
    isPopupFromThisShopFront : function()
    {
        try {
            // 팝업창이 아니면 false 리턴
            if (window.opener === null) {
                return false;
            }

            // 현재 창의 도메인과 opener의 도메인이 다르면 false 리턴
            if (window.location.host !== window.opener.location.host) {
                return false;
            }

            // 어드민으로부터 열려진 경우 false 리턴
            var regAdminUrl = /^(\/admin\/php\/|\/disp\/admin\/)/;
            if (regAdminUrl.test(window.opener.location.pathname) === true) {
                return false;
            }

            // 프론트로부터 열려진 경우이므로 true 리턴
            return true;

        } catch (e) {
            // window.opener에 접근 불가능한 케이스는 이미 본 창이 닫혔거나 도메인이 다른 것이므로 false 리턴
            return false;

        }
    },

    /**
     * url에서 파라미터 가져오기
     * @param string name 파라미터명
     * @return string 파라미터 값
     */
     getParameterByName : function (name) {
        name        = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regexS  = "[\\?&]" + name + "=([^&#]*)";
        var regex   = new RegExp(regexS);
        var results = regex.exec(window.location.href);

        if (results == null) {
            return '';
        } else {
            return decodeURIComponent(results[1].replace(/\+/g, " "));
        }
    },

    historyBack : function(sMsg)
    {
        if (typeof(sMsg) !== 'undefined' && sMsg !== '') {
            alert(sMsg);
        }

        if (this.isPopupFromThisShopFront() === true) {
            opener = window;
            window.close();
        } else {
            history.back();
        }
    }
};

$(document).ready(function() {
    // 엔터키 감지 후 해시태그 자동완성에 대한 처리
    $(this).keydown(function(event) {
        var oTarget = $('.autoDrop').find('li.selected');

        if (event.keyCode === 13 && oTarget.length > 0) {
            event.preventDefault();

            location.href = oTarget.children().attr('href');
        }
    });

    // 검색 input에 대한 ↑, ↓키 입력시 커서 이동 방지
    $('.keyword').keydown(function(event) {
        if (event.keyCode === 38 || event.keyCode === 40) {
            event.preventDefault();
        }
    });

    FwValidator.Handler.setRequireErrorMsg('keyword', __('검색어를 입력해주세요'));

    var oSearchForm = $('#searchForm');
    var oSearchFormKeyword = oSearchForm.find('#keyword');

    var SEARCHREGISTER = {

        eSearchType : function()
        {
            if (this.checkSearchType() === true) {
                $('#except_keyword_wrap_id').show();
            } else {
                $('#except_keyword_wrap_id').hide();
            }
        },

        eSubmit : function()
        {

            oSearchFormKeyword.removeAttr('fw-filter');

            if (this.checkSearchType() === true && this.checkExceptKeyword() === false) {
                return false;
            }

            var iCategoryNo = 0;

            if ($("#category_no").length > 0) {
                iCategoryNo = $("#category_no option").index($("#category_no option:selected"));
            }

            if (this.checkPrice() === false && this.getKeyword() === null) {
                if (iCategoryNo === 0) {
                    oSearchFormKeyword.attr('fw-filter', 'isFill');
                }
            }

            return true;
        },

        checkSearchType : function () {
            if ($("#search_type").length < 1) {
                return true;
            }
            if ($("#search_type option:selected").val() === 'product_name') {
                return true
            } else {
                return false;
            }
        },

        checkExceptKeyword : function ()
        {
            var sKeyword = this.getKeyword();

            var sExceptKeyWord = $.trim($('#exceptkeyword').val());
            if (sExceptKeyWord.length === 0) {
                return true;
            }


            if (sKeyword === null) {
                alert(__('제외검색어 입력 시 검색조건에 상품명을 반드시 입력하셔야 합니다.'));
                return false;
            }

            var iFindWord = sKeyword.indexOf(sExceptKeyWord);
            if (iFindWord !== -1) {
                alert(__('제외검색어가 검색어에 포함되어 있어 검색할 수 없습니다.\n다시 입력해주세요.'));
                return false;
            }

            return true;
        },

        getKeyword : function ()
        {
            var sKeyWord = $.trim(oSearchFormKeyword.val());
            if (sKeyWord.length === 0) {
                return null;
            }
            return sKeyWord;
        },

        checkPrice : function ()
        {
          var iProduct_price_min = $.trim($('#product_price1').val());
          var iProduct_price_max = $.trim($('#product_price2').val());

          if (iProduct_price_min.length === 0 && iProduct_price_max.length === 0) {
              return false;
          }
          return true;
        }
    }

    SEARCHREGISTER.eSearchType();

    $('#searchForm').submit(function(e) {
        if (SEARCHREGISTER.eSubmit() !== true) {
            return false;
        }

        if (FwValidator.inspection('searchForm').passed !== true) {
            return false;
        }

        return true;
    });

    $('#search_type').change(function(e) {
        SEARCHREGISTER.eSearchType();
    });

    $('#btn_search').click(function() {
        $('#searchBarForm').submit();
    });

    $('input[name="keyword"]').bind('keypress.ec-keyword-event', function(e) {
        if (e.keyCode == 13 && $.trim($(this).val()) === '') {
            alert(__('검색어를 입력해주세요'));
            return false;
        }
    });

    $('[id=searchBarForm]').submit(function(e) {

        if ($.trim($(this).find('#keyword').val())=='') {
            alert(__('검색어를 입력해주세요'));
            return false;
        }

        if (mobileWeb === true) {
            $Recentword.saveRecentWord($(this).find('#keyword').val());
        }
    });

    $('.btn_order').click(function() {
        $type = $(this).attr('rel');
        $('#order_by').val($type);

        $('#searchForm').submit();
    });

    $('.btn_view').click(function() {
        $view = $(this).attr('rel');

        if ($view != 'list') {
            $sAction = '/product/search_'+$view+'.html';
        } else {
            $sAction = '/product/search.html';
        }

        $('#view_type').val($view);
        $('#searchForm').attr('action', $sAction);
        $('#searchForm').submit();
    });

    // 검색어 관련 작업
    var aSearchKey = ReWriteSearchKey();
    if (aSearchKey !== false) {
        if (aSearchKey) {//ECHOSTING-44000
           var oSearchHeader = $(".xans-layout-searchheader").parent("form");
           oSearchHeader.find("#banner_action").val(aSearchKey.banner_action);
           oSearchHeader.find("#keyword").val(aSearchKey.msb_contents);
        }
    };

    if (mobileWeb === true) {
        $('#search_cancel').bind('click', function() {
            $('html, body').css({'overflowY': 'auto', height: 'auto', width: '100%'});
            $('.dimmed').toggle();
            $('.xans-layout-searchheader').hide();
        });

        $('.xans-layout-searchheader').find('button.btnDelete').bind('click', function() {
            $('#keyword').attr('value', '').focus();
            $('#banner_action').attr('value', ''); //ECQAINT-8961 Delete버튼 클릭시 value 초기화
        });

        // 검색페이지에서 삭제
        $('.xans-search-form').find('button.btnDelete').bind('click', function() {
            $('#searchForm').find('input#keyword').attr('value', '').focus();
        });

        $('.header .search button').bind('click', function() {
            if ($('#search_box').size() > 0) {
                $('html, body').css({'overflowY': 'hidden', height: '100%', width: '100%'});
                $('.dimmed').toggle();
                $('#header .xans-layout-searchheader').toggle();
            } else {
                $('#header .xans-layout-searchheader').toggle();
            }
        });
    }
});

function ReWriteSearchKey()
{
    if (typeof(sSearchBannerUseFlag) == "undefined") return false;
    if (sSearchBannerUseFlag == 'F') return false;
    if (typeof(aSearchBannerData) == "undefined") return false;
    if (aSearchBannerData.length === 0) return false;
    if (sSearchBannerType != 'F') return aSearchBannerData[Math.floor(Math.random() * aSearchBannerData.length)];

    var aResultData = null;
    var sSearchKey = $.cookie('iSearchKey');
    var iSearchKey = 0;

//    if ( sSearchKey !== null ) {//ECHOSTING-44000
    if ( sSearchKey != undefined ) {
        iSearchKey = parseInt(sSearchKey) + parseInt(1);
        if ( iSearchKey >= aSearchBannerData.length ) {
             iSearchKey = 0;
        }
    }
    $.cookie('iSearchKey', iSearchKey, {path : '/'});

    return aSearchBannerData[iSearchKey];
}


var popProduct = {

    selProduct: function(product_no,iPrdImg, sPrdName,sPrdPrice, sPrdTaxText, sCategoryName, iCategoryNo)
    {
        if (this.isGiftProduct(product_no) === false) {
            alert(sErrorMessage);
            return false;
        }

        try {
            $('#aPrdLink', opener.document).attr('href', this.getUrl(product_no));
            $('#aPrdNameLink', opener.document).attr('href', this.getUrl(product_no));
            $('#product_no', opener.document).val(product_no);
            $('#iPrdImg', opener.document).attr('src', iPrdImg);
            $('#sPrdName', opener.document).html(sPrdName.replace(/[\＂]/g, '"'));
            $('#sPrdPrice', opener.document).html(sPrdPrice);
            $('#sPrdCommonImg', opener.document).html('');

            if ($('#sPrdTaxText', opener.document).size() > 0) {
                $('#sPrdTaxText', opener.document).html(sPrdTaxText);
            }

            $('#iPrdView', opener.document).removeClass('displaynone').css('display', 'inline');
        } catch (e) {}

        // ECHOSTING-61590
        var iSelectedOptionIndex = $('#subject', opener.document).attr('selectedIndex');
        $('#subject option', opener.document).remove();
        $('input[name^="fix_title_form_"]', opener.document).each(function (iIndex) {
            var sSubject = popProduct.getConvertString($(this).val(), sPrdName, sCategoryName);
            var sOptionTag = '<option value="'+sSubject+'">'+sSubject+'</option>';
            $('#subject', opener.document).append(sOptionTag);
        });
        $('#subject', opener.document).attr('selectedIndex', iSelectedOptionIndex);
        $('#cate_no', opener.document).val(iCategoryNo);

        /**
         * thunmail이미지에 링크가 걸렸을경우 링크 처리
         */
        var eAnchor = opener.document.getElementById('iPrdImg').parentNode;
        if ('A' === eAnchor.tagName.toUpperCase()) {
            eAnchor.href = this.getUrl(product_no);
        }
        window.close();
    },

    getUrl: function(product_no)
    {
        var aPrdLink = opener.document.getElementById('aPrdLink').href;
        var iUrlIndex = aPrdLink.indexOf('product_no=');

        var aPrdLinkSplit = aPrdLink.split('product_no=');

        var aPrdParamSplit = aPrdLinkSplit[1].split('&');

        aPrdParamSplit.shift();

        return aPrdLink.substr(0, iUrlIndex)+'product_no='+product_no+(aPrdParamSplit.length > 0 ? '&'+aPrdParamSplit.join('&') : '');
    },
    // ECHOSTING-61590
    getConvertString : function(sSubject, sPrdName, sCategoryName)
    {
        sSubject = sSubject.replace('PRODUCT_NAME', sPrdName);
        return sSubject.replace('CATEGORY_NAME', sCategoryName);
    },
    isGiftProduct : function(iProductNum)
    {
        if (typeof aGiftReview === 'object') {
            if (aGiftReview[iProductNum] === 'F') {
                return false;
    }
        }
        return true;
    },
    END : function() {}
};

/**
 * 상품 검색 배너
 */
var SEARCH_BANNER = {
    /**
     * 상품 검색 Submit
     */
    submitSearchBanner : function(obj)
    {
        var form = $(obj).parents('form');

        if (form.find('#banner_action').val() != '') {
         // ECHOSTING-98878 상품검색키워드로 검색시에 폼전송이 되어 연결페이지로 이동이 안되고 검색페이지로 이동되는 오류 수정
         form.submit(function () {
          return false;
         });

            // 배너 연결 페이지 이동
            location.replace(form.find('#banner_action').val());
        } else {
            if ($.trim(form.find('#keyword').val())=='') {
                alert(__('검색어를 입력해주세요'));
                form.find('#keyword').focus();
                return;
            }

            form.submit();
        }
    },

    /**
     * 검색어 입력폼 클릭
     */
    clickSearchForm : function(obj)
    {
        //ECHOSTING-105207 상품검색 키워드설정시 모바일에서 검색 결과 없음
        var form = $(obj).parents('form');

        if (mobileWeb == true && form.find('#banner_action').val() != '') {
         // ECHOSTING-98878 상품검색키워드로 검색시에 폼전송이 되어 연결페이지로 이동이 안되고 검색페이지로 이동되는 오류 수정
         form.submit(function () {
          return false;
         });

            // 배너 연결 페이지 이동
            location.replace(form.find('#banner_action').val());
        }

        form.find('#banner_action').val('');
        if (mobileWeb !== true) { $(obj).val(''); }
    }
};

/**
 * 최근검색어
 */
var $Recentword = {
    // recent length
    recentNum : 10,

    // cookie expires
    expires : 10,

    // duplication key
    duplicateKey : 0,

    // recent string
    string : '',

    // recent string
    prefix : 'RECENT_WORD_',

    // sModuel
    sModule : 'xans-search-recentkeyword',

    // recent
    $recent : null,

    // recent list
    $recentList : null,

    // list size
    size : 0,

    // remove
    $remove : null,
    /**
     * save recent word
     */

    init : function()
    {
        this.setObj();
        this.action();
        this.dimmed();
    },

    dimmed : function()
    {
        try {
            $('.xans-layout-searchheader').after('<div class="dimmed"></div>');
        } catch(e) { }
    },

    setObj : function()
    {
        this.$recent = $('.' + this.sModule);

        this.$recentList = this.$recent.find('ul').find('li');

        this.size = this.$recentList.size();

        this.$remove = this.$recent.find('p');
    },

    action : function()
    {
        var $hot = $('.xans-search-hotkeyword'), $title = $('#keyword_title');

        if ($('.xans-layout-searchheader').find('ul.searchTab').hasClass('displaynone') === false) {
            this.$recent.hide();
            $title.hide();
        } else {
            $hot.hide();
        }

        $('.xans-layout-searchheader').find('ul.searchTab').find('li').click(function() {
           var index = $(this).index();
           $(this).addClass('selected').siblings().removeClass('selected');
           if (index == 0) { $Recentword.$recent.hide(); $hot.show(); }
           else { $Recentword.$recent.show(); $hot.hide(); }
        });
    },

    saveRecentWord : function(s)
    {
        this.string = s;

        // 중복처리
        if (this.duplication() === false) { this.cookieOrder(); }

        // 저장
        this.save();
    },

    save : function()
    {
        var bFull = true;
        for (var i=1; i<=this.recentNum; i++) {
            if ($.cookie(this.prefix + i) == null) {
                bFull = false;
                this.add(i);
                break;
            }
        }

        if (bFull == true) {
            this.removeFrist();
            this.add(this.recentNum);
        }
    },

    duplication : function()
    {
        for (var k=1; k<=this.recentNum; k++) {
            if ($.cookie(this.prefix + k) == this.string) {
                this.duplicateKey = k;
                $.cookie(this.prefix + k, null, { path: '/' });
                return false;
            }
        }
    },

    cookieOrder : function()
    {
        var s = this.duplicateKey + 1;
        for (var i=this.duplicateKey; i<=this.recentNum; i++) {
            if ($.cookie(this.prefix + s) != null) {
                this.add(i, $.cookie(this.prefix + s));
                this.removeCookie(s);
                s++;
            }
        }
    },

    removeFrist : function()
    {
        for (var i=2, k=1; i<=this.recentNum; i++,k++) {
            $.cookie(this.prefix + k, $.cookie(this.prefix + i), { expires: this.expires, path: '/'});
        }
    },

    add : function(key, duplicateString)
    {
        $.cookie(this.prefix + key, duplicateString || this.string, { expires: this.expires, path: '/'});
    },

    removeCookie : function(key)
    {
        $.cookie(this.prefix + key, null, { path: '/' });
    },

    removeAll : function()
    {
        for (var i=1; i<=this.recentNum; i++) { $.cookie(this.prefix + i, null, { path: '/' }); }
        this.setNoList();
    },

    removeOne : function(key)
    {
        try {
            this.removeCookie(key);
            this.$recentList.each(function() { if ($(this).data('index') == key) { $(this).remove(); } });
            this.size--;
            if (this.size == 0) { this.setNoList(); }
        } catch(e) {

        }
    },

    setNoList : function()
    {
        try {
            this.$recentList.each(function() { $(this).remove(); });
            this.$remove.removeClass('displaynone');
        } catch(e) {

        }
    }
};

/*
 * 해시태그 json 검색
 */
var SEARCH_HASHTAG = {
    // 해시태그 json ajax url
    sAjaxHashtag: '/exec/front/shop/hashtag?type=',

    // 해시태그 DB
    oJsonDB: null,

    // 기본 검색어 uri
    sSearchUrl: '/product/search.html?keyword=',

    // 해시태그 json 파일 호출
    // oTarget: 검색 input object
    // sType: 검색 대상 타입 (product 또는 category)
    getHashtag: function(oTarget, sType) {
        if (bUseElastic === false) {
            return;
        }

        var self = this;
        var sKeyword = $.trim(oTarget.val());
        var oDrop = oTarget.parent().find('.autoDrop');
        var event = window.event || arguments.callee.caller.arguments[0];

        // 기본 타입 설정
        if (typeof(sType) === 'undefined' || sType === '') {
            sType = 'product';
        }

        // 자동완성 영역이 있는 경우만 실행
        if (oDrop.length < 1) {
            return;
        }

        // ↑, ↓키를 눌렀을 경우에는 팝업에 대한 처리만 진행
        if (event.keyCode === 38 || event.keyCode === 40) {
            oTarget.blur();

            this.setKeyArrow(oDrop, event);

            setTimeout(function() {
                oTarget.focus();
            }, 10);

            return;
        }

        // 실제 키워드에 대한 자동완성 처리 부분
        if (sKeyword !== '') {
            if (mobileWeb === true && $('body').hasClass("eMobilePopup") === false) {
                $("#ec-product-searchdata-auto-list").show();
                $('body').addClass("eMobilePopup"); // fullsize 레이어팝업 노출시 body에 eMobilePopup 클래스 추가
                $('body').css("width", "100%");
            }
            if (this.oJsonDB === null) {
                // json 파일 존재여부 체크
                $.getJSON(this.sAjaxHashtag + sType, function(data) {
                    // 파일이 존재할 경우 url 리턴
                    // 리턴된 url로 json object 요청
                    if (data.url !== false) {
                        $.getJSON(data.url, function(data) {
                            if (data !== false) {
                                self.oJsonDB = TAFFY(data);

                                self.setHashtagKeyword(oDrop, sKeyword);
                            }
                        });
                    }
                });
            } else {
                this.setHashtagKeyword(oDrop, sKeyword);
            }
        } else {
            this.setHashtagHide(oDrop);
        }
    },

    // ↑, ↓키 처리 (drop 영역 키보드 컨트롤)
    setKeyArrow: function(oDrop, event) {
        var oTarget = oDrop.children('li');
        var oSelected = oDrop.children('li.selected');
        var oScroll = null;

        if (oTarget.length > 0) {
            oTarget.removeClass('selected');

            switch (event.keyCode) {
                // ↑
                case 38:
                    if (oSelected.length === 0 || oSelected.prev().length === 0) {
                        oScroll = oTarget.last().addClass('selected');
                    } else {
                        oScroll = oSelected.prev().addClass('selected');
                    }

                    break;
                // ↓
                case 40:
                    if (oSelected.length === 0 || oSelected.next().length === 0) {
                        oScroll = oTarget.first().addClass('selected');
                    } else {
                        oScroll = oSelected.next().addClass('selected');
                    }

                    break;
            }

            if (oScroll !== null && oSelected.length > 0) {
                oDrop.scrollTop(oScroll.position().top + oDrop.scrollTop() - oScroll.height() * 3);
            }
        }
    },

    // 검색된 해시태그 리스트 보이기/감추기
    setHashtagHide: function(oTarget, bFlag) {
        if (typeof(bFlag) === 'undefined' || bFlag === '') {
            bFlag = false;
        }

        if (bFlag === false) {
            oTarget.hide();
        } else {
            oTarget.show();
        }
    },

    // 저장된 해시태그 json 파일에 대해 키워드로 검색 후 결과 출력
    setHashtagKeyword: function(oDrop, sKeyword) {
        var self = this;
        var oJsonSearch = this.oJsonDB({tag: {like: sKeyword}}).order('tag asec').get();

        oDrop.html('');

        if (oJsonSearch.length !== 0) {
            this.setHashtagHide(oDrop, true);

            oJsonSearch.forEach(function(oResult) {
                // 검색된 키워드에 대해서 bold 처리 (검색 결과에서 검색어로 입력했던 문자만)
                if ($.trim(oResult.tag) !== '') {
                    oDrop.append('<li><a href="' + self.sSearchUrl + encodeURI(oResult.tag) + '">' + oResult.tag.replace(sKeyword, '<strong>' + sKeyword + '</strong>') + '</a></li>');
                }

            });
        } else {
            this.setHashtagHide(oDrop);
        }
    }
};

/**
 * FwValidator
 *
 * @package     jquery
 * @subpackage  validator
 */

var FwValidator = {

    /**
     * 디버그 모드
     */
    DEBUG_MODE : false,

    /**
     * 결과 코드
     */
    CODE_SUCCESS    : true,
    CODE_FAIL       : false,

    /**
     * 어트리뷰트 명
     */
    ATTR_FILTER     : 'fw-filter',
    ATTR_MSG        : 'fw-msg',
    ATTR_LABEL      : 'fw-label',
    ATTR_FIREON     : 'fw-fireon',
    ATTR_ALONE      : 'fw-alone',

    /**
     * 응답객체들
     */
    responses       : {},

    /**
     * 엘리먼트별 필수 입력 에러 메세지
     */
    requireMsgs     : {},

    /**
     * 엘리먼트의 특정 필터별 에러 메세지
     */
    elmFilterMsgs   : {},

    /**
     * Validator 기본 이벤트 등록
     */
    bind : function(formId, expand) {

        var self = this;
        var formInfo = this.Helper.getFormInfo(formId);

        if (formInfo === false) {
            alert('The form does not exist - bind');
            return false;
        }

        var elmForm = formInfo.instance;

        var Response = this._response(formId);

        this._fireon(formId, elmForm, Response);
        this._submit(formId, elmForm, expand);

        return true;

    },

    /**
     * Validator 검사 진행
     *
     * @param string formId
     * @return object | false
     */
    inspection : function(formId, expand) {

        expand = (expand === true) ? true : false;

        var self = this;
        var Response = this._response(formId);

        if (Response === false) {
            alert('The form does not exist - inspection');
            return false;
        }

        if (Response.elmsTarget.length == 0) {
            return this.Helper.getResult(Response, this.CODE_SUCCESS);
        }

        Response.elmsTarget.each(function(){
            self._execute(Response, this);
        });

        if (Response.elmsCurrErrorField.length > 0) {

            if (expand !== true) {
                this.Handler.errorHandler(Response.elmsCurrErrorField[0]);
            } else {
                this.Handler.errorHandlerByExapnd(Response);
            }

            return Response.elmsCurrErrorField[0];

        }

        return this.Helper.getResult(Response, this.CODE_SUCCESS);

    },

    /**
     * submit 이벤트 등록
     *
     * @param string    formId
     * @param object    elmForm
     */
    _submit : function(formId, elmForm, expand) {
        var self = this;

        elmForm.unbind('submit');
        elmForm.bind('submit', function(){
            var result = false;

            try{
                result = self.inspection(formId, expand);
            }catch(e){
                alert(e);
                return false;
            }

            if(!result || result.passed === self.CODE_FAIL){
                return false;
            };

            var callback = self._beforeSubmit(elmForm);

            return callback !== false ? true : false;
        });
    },

    /**
     * fireon 이벤트 등록
     *
     * @param string                formId
     * @param object                elmForm
     * @param FwValidator.Response  Response
     */
    _fireon : function(formId, elmForm, Response) {
        var self = this;
        var formInfo = this.Helper.getFormInfo(formId);

        $(formInfo.selector).find('*['+this.ATTR_FILTER+']['+this.ATTR_FIREON+']').each(function(){
            var elm = $(this);
            var evtName = $.trim(elm.attr(self.ATTR_FIREON));
            var elmMsg = '';

            elm.unbind(evtName);
            elm.bind(evtName, function(){
                var result = self._execute(Response, this);
                var targetField = Response.elmCurrField;

                //에러 메세지가 출력되 있다면 일단 지우고 체킹을 시작한다.
                if(typeof elmMsg == 'object'){
                    elmMsg.remove();
                }

                if(result > -1){
                    elmMsg = self.Handler.errorHandlerByFireon(Response.elmsCurrErrorField[result]);
                }else{
                    self.Handler.successHandlerByFireon(self.Helper.getResult(Response, self.CODE_FAIL));
                }
            });
        });
    },

    /**
     * Response 객체 생성
     *
     * @param string formId
     * @return FwValidator.Response | false
     */
    _response : function(formId) {

        var formInfo = this.Helper.getFormInfo(formId);

        if (formInfo === false) {
            alert('The form does not exist - find');
            return false;
        }

        var elmForm = formInfo.instance;
        var elmsTarget = $(formInfo.selector).find('*[' + this.ATTR_FILTER + ']');

        this.responses[formId] = new FwValidator.Response();

        this.responses[formId].formId = formId;
        this.responses[formId].elmForm = elmForm;
        this.responses[formId].elmsTarget = elmsTarget;

        return this.responses[formId];

    },

    /**
     * BeforeExecute 콜백함수 실행
     *
     * @param FwValidator.Response Response
     */
    _beforeExecute : function(Response) {

        var count = this.Handler.beforeExecute.length;

        if (count == 0) return;

        for (var i in this.Handler.beforeExecute) {
            this.Handler.beforeExecute[i].call(this, Response);
        }

    },

    /**
     * BeforeSubmit 콜백함수 실행
     *
     * @param object elmForm (jquery 셀렉터 문법으로 찾아낸 폼 객체)
     */
    _beforeSubmit : function(elmForm) {

        if(typeof this.Handler.beforeSubmit != 'function') return true;

        return this.Handler.beforeSubmit.call(this, elmForm);

    },

    /**
     * 엘리먼트별 유효성 검사 실행
     *
     * @param FwValidator.Response  Response
     * @param htmlElement           elmTarget
     * @return int(에러가 발생한 elmCurrField 의 인덱스값) | -1(성공)
     */
    _execute : function(Response, elmTarget) {

        var RESULT_SUCCESS = -1;

        Response.elmCurrField = $(elmTarget);
        Response.elmCurrLabel = Response.elmCurrField.attr(this.ATTR_LABEL);
        Response.elmCurrFieldType = this.Helper.getElmType(Response.elmCurrField);
        Response.elmCurrFieldDisabled = elmTarget.disabled;
        Response.elmCurrValue = this.Helper.getValue(Response.formId, Response.elmCurrField);
        Response.elmCurrErrorMsg = Response.elmCurrField.attr(this.ATTR_MSG);

        //_beforeExecute 콜백함수 실행
        this._beforeExecute(Response);

        //필드가 disabled 일 경우는 체크하지 않음.
        if (Response.elmCurrFieldDisabled === true) {
            return RESULT_SUCCESS;
        }

        var filter = $.trim( Response.elmCurrField.attr(this.ATTR_FILTER) );

        if (filter == '') {
            return RESULT_SUCCESS;
        }

        //is로 시작하지 않는것들은 정규표현식으로 간주
        if (/^is/i.test(filter)) {
            var filters = filter.split('&');
            var count = filters.length;

            //필수항목이 아닌경우 빈값이 들어왔을경우는 유효성 체크를 통과시킴

            if ((/isFill/i.test(filter) === false) && !Response.elmCurrValue) {
                return RESULT_SUCCESS;
            }

            for (var i=0; i < count; ++i) {
                var filter = filters[i];
                var param = '';
                var filtersInfo = this.Helper.getFilterInfo(filter);

                filter = Response.elmCurrFilter = filtersInfo.id;
                param = filtersInfo.param;

                //필수 입력 필터의 경우 항목관리에서 사용자가 메세지를 직접 지정하는 부분이 있어 이렇게 처리
                if (filter == 'isFill') {
                    Response.elmCurrValue = $.trim(Response.elmCurrValue);
                    Response.elmCurrErrorMsg = this.requireMsgs[elmTarget.id] ? this.requireMsgs[elmTarget.id] : this.msgs['isFill'];
                } else {
                    var msg = Response.elmCurrField.attr(this.ATTR_MSG);

                    if (msg) {
                        Response.elmCurrErrorMsg = msg;
                    } else if (this.Helper.getElmFilterMsg(elmTarget.id, filter)) {
                        Response.elmCurrErrorMsg = this.Helper.getElmFilterMsg(elmTarget.id, filter);
                    } else {
                        Response.elmCurrErrorMsg = this.msgs[filter];
                    }

                }

                //존재하지 않는 필터인 경우 에러코드 반환
                if(this.Filter[filter] === undefined){
                    Response.elmCurrErrorMsg = this.msgs['notMethod'];
                    var result = this.Helper.getResult(Response, this.CODE_FAIL);

                    Response.elmsCurrErrorField.push(result);
                    return Response.elmsCurrErrorField.length - 1;
                }

                //필터 실행
                var result = this.Filter[filter](Response, param);

                if (result == undefined || result.passed === this.CODE_FAIL) {
                    Response.elmsCurrErrorField.push(result);

                    //Debug를 위해 넣어둔 코드(확장형 필터를 잘못 등록해서 return값이 없는 경우를 체크하기 위함)
                    if (result == undefined) {
                        alert('Extension Filter Return error - ' + filter);
                    }

                    return Response.elmsCurrErrorField.length - 1;
                }
            }
        } else {
            var msg = Response.elmCurrErrorMsg;
            Response.elmCurrErrorMsg = msg ? msg : this.msgs['isRegex'];
            var result = this.Filter.isRegex(Response, filter);

            if(result.passed === this.CODE_FAIL){
                Response.elmsCurrErrorField.push(result);

                return Response.elmsCurrErrorField.length - 1;
            }
        }

        return RESULT_SUCCESS;
    }
};

/**
 * FwValidator.Response
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Response = function() {

    this.formId = null;
    this.elmForm = null;
    this.elmsTarget = null;
    this.elmsCurrErrorField = [];

    this.elmCurrField = null;
    this.elmCurrFieldType = null;
    this.elmCurrFieldDisabled = null;
    this.elmCurrLabel = null;
    this.elmCurrValue = null;
    this.elmCurrFilter = null;
    this.elmCurrErrorMsg = null;

    this.requireMsgs = {};

};

/**
 * FwValidator.Helper
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Helper = {

    parent : FwValidator,

    /**
     * 메세지 엘리먼트의 아이디 prefix
     */
    msgIdPrefix : 'msg_',

    /**
     * 메세지 엘리먼트의 클래스 명 prefix
     */
    msgClassNamePrefix : 'msg_error_mark_',

    /**
     * 결과 반환
     */
    getResult : function(Response, code, param) {

        //특수 파라미터 정보(특정 필터에서만 사용함)
        param = param != undefined ? param : {};

        var msg = '';

        if (code === this.parent.CODE_FAIL) {

            try {
                msg = Response.elmCurrErrorMsg.replace(/\{label\}/i, Response.elmCurrLabel);
            } catch(e) {
                msg = 'No Message';
            }

        } else {

            msg = 'success';

        }

        var result = {};
        result.passed = code;
        result.formid = Response.formId;
        result.msg = msg;
        result.param = param;

        try {
        result.element = Response.elmCurrField;
        result.elmid = Response.elmCurrField.attr('id');
        result.filter = Response.elmCurrFilter;
        } catch(e) {}

        return result;

    },

    /**
     * 필터 정보 반환(필터이름, 파라미터)
     */
    getFilterInfo : function(filter) {
        var matches = filter.match(/(is[a-z]*)((?:\[.*?\])*)/i);

        return {
            id : matches[1],
            param : this.getFilterParams(matches[2])
        };
    },

    /**
     * 필터의 파라미터 스트링 파싱
     * isFill[a=1][b=1][c=1] 이런식의 멀티 파라미터가 지정되어 있는 경우는 배열로 반환함
     * isFill[a=1] 단일 파라미터는 파라미터로 지정된 스트링값만 반환함
     */
    getFilterParams : function(paramStr) {
        if (paramStr == undefined || paramStr == null || paramStr == '') {
            return '';
        }

        var matches = paramStr.match(/\[.*?\]/ig);

        if (matches == null) {
            return '';
        }

        var count = matches.length;
        var result = [];

        for (var i=0; i < count; i++) {
            var p = matches[i].match(/\[(.*?)\]/);
            result.push(p[1]);
        }

        if (result.length == 1) {
            return result[0];
        }

        return result;
    },

    /**
     * 필드 타입 반환(select, checkbox, radio, textbox)
     */
    getElmType : function(elmField) {
        elmField = $(elmField);

        var elTag = elmField[0].tagName;
        var result = null;

        switch (elTag) {
            case 'SELECT' :
                result = 'select';
                break;

            case 'INPUT' :
                var _type = elmField.attr('type').toLowerCase();
                if(_type == 'checkbox') result = 'checkbox';
                else if(_type =='radio') result = 'radio';
                else result = 'textbox';

                break;

            case 'TEXTAREA' :
                result = 'textbox';
                break;

            default :
                result = 'textbox';
                break;
        }

        return result;
    },

    /**
     * 필드 값 반환
     */
    getValue : function(formId, elmField) {
        var result = '';
        var elmName = elmField.attr('name');
        var fieldType = this.getElmType(elmField);

        //checkbox 나 radio 박스는 value값을 반환하지 않음
        if (fieldType == 'checkbox' || fieldType == 'radio') {
            if(elmField.get(0).checked === true){
                result = elmField.val();
            }
            return result;
        }

        //alonefilter 속성이 Y 로 되어 있다면 해당 엘리먼트의 값만 반환함
        var aloneFilter = elmField.attr(this.parent.ATTR_ALONE);
        if(aloneFilter == 'Y' || aloneFilter == 'y'){
            return elmField.val();
        }

        //name이 배열형태로 되어 있다면 값을 모두 합쳐서 반환
        if( /\[.*?\]/.test(elmName) ){
            var formInfo = this.getFormInfo(formId);

            var groupElms = $(formInfo.selector +' [name="'+elmName+'"]');
            groupElms.each(function(i){
                var elm = $(this);
                result += elm.val();
            });
        }else{
            result = elmField.val();
        }

        return result;
    },

    /**
     * 에러메세지 엘리먼트 생성
     */
    createMsg : function(elm, msg, formId) {
        var elmMsg = document.createElement('span');

        elmMsg.id = this.msgIdPrefix + elm.attr('id');
        elmMsg.className = this.msgClassNamePrefix + formId;
        elmMsg.innerHTML = msg;

        return $(elmMsg);
    },

    /**
     * 에러메세지 엘리먼트 제거
     */
    removeMsg : function(elm) {
        var id = this.msgIdPrefix + elm.attr('id');
        var elmErr = $('#'+id);

        if (elmErr) elmErr.remove();
    },

    /**
     * 에러메세지 엘리먼트 모두 제거
     */
    removeAllMsg : function(formId) {
        var className = this.msgClassNamePrefix + formId;

        $('.' + className).remove();
    },

    /**
     * 문자열의 Byte 수 반환
     */
    getByte : function(str) {
        var encode = encodeURIComponent(str);
        var totalBytes = 0;
        var chr;
        var bytes;
        var code;

        for(var i = 0; i < encode.length; i++)
        {
            chr = encode.charAt(i);
            if(chr != "%") totalBytes++;
            else
            {
                code = parseInt(encode.substr(i+1,2),16);
                if(!(code & 0x80)) totalBytes++;
                else
                {
                    if((code & 0xE0) == 0xC0) bytes = 2;
                    else if((code & 0xF0) == 0xE0) bytes = 3;
                    else if((code & 0xF8) == 0xF0) bytes = 4;
                    else return -1;

                    i += 3 * (bytes - 1);

                    totalBytes += 2;
                }
                i += 2;
            }
        }

        return totalBytes;
    },

    /**
     * 지정한 엘리먼트의 필터 메세지가 존재하는가
     *
     * @param elmId (엘리먼트 아이디)
     * @param filter (필터명)
     * @return string | false
     */
    getElmFilterMsg : function(elmId, filter) {
        if (this.parent.elmFilterMsgs[elmId] == undefined) return false;
        if (this.parent.elmFilterMsgs[elmId][filter] == undefined) return false;

        return this.parent.elmFilterMsgs[elmId][filter];
    },

    /**
     * 폼 정보 반환
     *
     * @param formId (폼 아이디 혹은 네임)
     * @return array(
     *   'selector' => 셀렉터 문자,
     *   'instance' => 셀렉터 문법으로 검색해낸 폼 객체
     * ) | false
     */
    getFormInfo : function(formId) {
        var result = {};
        var selector = '#' + formId;
        var instance = $(selector);

        if (instance.length > 0) {
            result.selector = selector;
            result.instance = instance;

            return result;
        }

        selector = 'form[name="' + formId + '"]';
        instance = $(selector);

        if (instance.length > 0) {
            result.selector = selector;
            result.instance = instance;

            return result;
        }

        return false;
    },

    /**
     * 숫자형태의 문자열로 바꿔줌
     * 123,123,123
     * 123123,123
     * 123%
     * 123  %
     * 123.4
     * -123
     * ,123
     *
     * @param value
     * @return float
     */
    getNumberConv : function(value) {
        if (!value || value == undefined || value == null) return '';

        value = value + "";

        value = value.replace(/,/g, '');
        value = value.replace(/%/g, '');
        value = value.replace(/[\s]/g, '');

        if (this.parent.Verify.isFloat(value) === false) return '';

        return parseFloat(value);
    }
};

/**
 * FwValidator.Handler
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Handler = {

    parent : FwValidator,

    /**
     * 사용자 정의형 에러핸들러(엘리먼트 아이디별로 저장됨)
     */
    customErrorHandler : {},

    /**
     * 사용자 정의형 에러핸들러(필터별로 저장됨)
     */
    customErrorHandlerByFilter : {},

    /**
     * 사용자 정의형 성공핸들러(엘리먼트 아이디별로 저장됨)
     */
    customSuccessHandler : {},

    /**
     * 사용자 정의형 성공핸들러(필터별로 저장됨)
     */
    customSuccessHandlerByFilter : {},

    /**
     * FwValidator._execute에 의해 검사되기 전 실행되는 콜백함수
     */
    beforeExecute : [],

    /**
     * FwValidator._submit에서 바인딩한 onsubmit 이벤트 발생후 실행되는 콜백함수
     * {폼아이디 : 콜백함수, ...}
     */
    beforeSubmit : {},

    /**
     * 기본 메세지 전체를 오버라이딩
     */
    overrideMsgs : function(msgs) {
        if (typeof msgs != 'object') return;

        this.parent.msgs = msgs;
    },

    /**
     * 필드에 따른 필수 입력 에러메세지 설정
     */
    setRequireErrorMsg : function(field, msg) {
        this.parent.requireMsgs[field] = msg;
    },

    /**
     * 필터 타입에 따른 에러메세지 설정
     */
    setFilterErrorMsg : function(filter, msg) {
        this.parent.msgs[filter] = msg;
    },

    /**
     * 엘리먼트의 특정 필터에만 에러메세지를 설정
     */
    setFilterErrorMsgByElement : function(elmId, filter, msg) {
        if (this.parent.elmFilterMsgs[elmId] == undefined) {
            this.parent.elmFilterMsgs[elmId] = {};
        }

        this.parent.elmFilterMsgs[elmId][filter] = msg;
    },

    /**
     * 엘리먼트 아이디별 사용자정의형 에러핸들러 등록
     */
    setCustomErrorHandler : function(elmId, func) {
        if (typeof func != 'function') return;

        this.customErrorHandler[elmId] = func;
    },

    /**
     * 필터 타입별 사용자정의형 에러핸들러 등록
     */
    setCustomErrorHandlerByFilter : function(filter, func) {
        if (typeof func != 'function') return;

        this.customErrorHandlerByFilter[filter] = func;
    },

    /**
     * 엘리먼트 아이디별 사용자정의형 성공핸들러 등록
     */
    setCustomSuccessHandler : function(elmId, func) {
        if (typeof func != 'function') return;

        this.customSuccessHandler[elmId] = func;
    },

    /**
     * 필터 타입별 사용자정의형 성공핸들러 등록
     */
    setCustomSuccessHandlerByFilter : function(filter, func) {
        if (typeof func != 'function') return;

        this.customSuccessHandlerByFilter[filter] = func;
    },

    /**
     * 확장형 필터 등록
     */
    setExtensionFilter : function(filter, func) {
        if (typeof func != 'function') return;

        if (this.parent.Filter[filter] == undefined) {
            this.parent.Filter[filter] = func;
        }
    },

    /**
     * 각 엘리먼트가 FwValidator._execute에 의해 검사되기 전 실행되는 콜백함수 등록
     */
    setBeforeExecute : function(func) {
        if (typeof func != 'function') return;

        this.beforeExecute.push(func);
    },

    /**
     * FwValidator._submit 에서 바인딩된 onsubmit 이벤트의 콜백함수 등록(유효성 검사가 성공하면 호출됨)
     */
    setBeforeSubmit : function(func) {
        if (typeof func != 'function') return;

        this.beforeSubmit = func;
    },

    /**
     * 에러핸들러 - 기본
     */
    errorHandler : function(resultData) {
        if (this._callCustomErrorHandler(resultData) === true) return;

        alert(resultData.msg);
        resultData.element.focus();
    },

    /**
     * 에러핸들러 - 전체 펼침 모드
     */
    errorHandlerByExapnd : function(Response) {
        var count = Response.elmsCurrErrorField.length;

        //해당 폼에 출력된 에러메세지를 일단 모두 지운다.
        this.parent.Helper.removeAllMsg(Response.formId);

        for (var i=0; i < count; ++i) {
            var resultData = Response.elmsCurrErrorField[i];

            if (this._callCustomErrorHandler(resultData) === true) continue;

            var elmMsg = this.parent.Helper.createMsg(resultData.element, resultData.msg, resultData.formid).css({'color':'#FF3300'});
            elmMsg.appendTo(resultData.element.parent());
        }
    },

    /**
     * 에러핸들러 - fireon
     */
    errorHandlerByFireon : function(resultData) {
        if (this._callCustomErrorHandler(resultData) === true) return;

        //해당 항목의 에러메세지 엘리먼트가 있다면 먼저 삭제한다.
        this.parent.Helper.removeMsg(resultData.element);

        var elmMsg = this.parent.Helper.createMsg(resultData.element, resultData.msg, resultData.formid).css({'color':'#FF3300'});
        elmMsg.appendTo(resultData.element.parent());

        return elmMsg;
    },

    /**
     * 성공핸들러 - fireon
     */
    successHandlerByFireon : function(resultData) {

        this._callCustomSuccessHandler(resultData);

    },

    /**
     * 정의형 에러 핸들러 호출
     *
     * @return boolean (정의형 에러핸들러를 호출했을 경우 true 반환)
     */
    _callCustomErrorHandler : function(resultData) {
        //resultData 가 정의되어 있지 않은 경우
        if (resultData == undefined) {
            alert('errorHandler - resultData is not found');
            return true;
        }

        //해당 엘리먼트에 대한 Custom에러핸들러가 등록되어 있다면 탈출
        if (this.customErrorHandler[resultData.elmid] != undefined) {
            this.customErrorHandler[resultData.elmid].call(this.parent, resultData);
            return true;
        }

        //해당 필터에 대한 Custom에러핸들러가 등록되어 있다면 탈출
        if (this.customErrorHandlerByFilter[resultData.filter] != undefined) {
            this.customErrorHandlerByFilter[resultData.filter].call(this.parent, resultData);
            return true;
        }

        return false;
    },

    /**
     * 정의형 성공 핸들러 호출 - 기본적으로 fireon 속성이 적용된 엘리먼트에만 적용됨.
     */
    _callCustomSuccessHandler : function(resultData) {

        if (this.customSuccessHandler[resultData.elmid] != undefined) {
            this.customSuccessHandler[resultData.elmid].call(this.parent, resultData);
            return;
        }

        if (this.customSuccessHandlerByFilter[resultData.filter] != undefined) {
            this.customSuccessHandlerByFilter[resultData.filter].call(this.parent, resultData);
            return;
        }

    }
};

/**
 * FwValidator.Verify
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Verify = {

    parent : FwValidator,

    isNumber : function(value, cond) {
        if (value == '') return true;

        if (!cond) {
            cond = 1;
        }

        cond = parseInt(cond);

        pos = 1;
        nga = 2;
        minpos = 4;
        minnga = 8;

        result = 0;

        if ((/^[0-9]+$/).test(value) === true) {
            result = pos;
        } else if ((/^[-][0-9]+$/).test(value) === true) {
            result = nga;
        } else if ((/^[0-9]+[.][0-9]+$/).test(value) === true) {
            result = minpos;
        } else if ((/^[-][0-9]+[.][0-9]+$/).test(value) === true) {
            result = minnga;
        }

        if (result & cond) {
            return true;
        }

        return false;
    },

    isFloat : function(value) {
        if (value == '') return true;

        return (/^[\-0-9]([0-9]+[\.]?)*$/).test(value);
    },

    isIdentity : function(value) {
        if (value == '') return true;

        return (/^[a-z]+[a-z0-9_]+$/i).test(value);
    },

    isKorean : function(value) {
        if (value == '') return true;

        var count = value.length;

        for(var i=0; i < count; ++i){
            var cCode = value.charCodeAt(i);

            //공백은 무시
            if(cCode == 0x20) continue;

            if(cCode < 0x80){
                return false;
            }
        }

        return true;
    },

    isAlpha : function(value) {
        if (value == '') return true;

        return (/^[a-z]+$/i).test(value);
    },

    isAlphaUpper : function(value) {
        if (value == '') return true;

        return (/^[A-Z]+$/).test(value);
    },

    isAlphaLower : function(value) {
        if (value == '') return true;

        return (/^[a-z]+$/).test(value);
    },

    isAlphaNum : function(value) {
        if (value == '') return true;

        return (/^[a-z0-9]+$/i).test(value);
    },

    isAlphaNumUpper : function(value) {
        if (value == '') return true;

        return (/^[A-Z0-9]+$/).test(value);
    },

    isAlphaNumLower : function(value) {
        if (value == '') return true;

        return (/^[a-z0-9]+$/).test(value);
    },

    isAlphaDash : function(value) {
        if (value == '') return true;

        return (/^[a-z0-9_-]+$/i).test(value);
    },

    isAlphaDashUpper : function(value) {
        if (value == '') return true;

        return (/^[A-Z0-9_-]+$/).test(value);
    },

    isAlphaDashLower : function(value) {
        if (value == '') return true;

        return (/^[a-z0-9_-]+$/).test(value);
    },

    isSsn : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        if ( (/[0-9]{2}[01]{1}[0-9]{1}[0123]{1}[0-9]{1}[1234]{1}[0-9]{6}$/).test(value) === false ) {
            return false;
        }

        var sum = 0;
        var last = value.charCodeAt(12) - 0x30;
        var bases = "234567892345";
        for (var i=0; i<12; i++) {
            sum += (value.charCodeAt(i) - 0x30) * (bases.charCodeAt(i) - 0x30);
        };
        var mod = sum % 11;

        if ( (11 - mod) % 10 != last ) {
            return false;
        }

        return true;
    },

    isForeignerNo : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        if ( (/[0-9]{2}[01]{1}[0-9]{1}[0123]{1}[0-9]{1}[5678]{1}[0-9]{1}[02468]{1}[0-9]{2}[6789]{1}[0-9]{1}$/).test(value) === false ) {
            return false;
        }

        var sum = 0;
        var last = value.charCodeAt(12) - 0x30;
        var bases = "234567892345";
        for (var i=0; i<12; i++) {
            sum += (value.charCodeAt(i) - 0x30) * (bases.charCodeAt(i) - 0x30);
        };
        var mod = sum % 11;
        if ( (11 - mod + 2) % 10 != last ) {
            return false;
        }

        return true;
    },

    isBizNo : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        if ( (/[0-9]{3}[0-9]{2}[0-9]{5}$/).test(value) === false ) {
            return false;
        }

        var sum = parseInt(value.charAt(0));
        var chkno = [0, 3, 7, 1, 3, 7, 1, 3];
        for (var i = 1; i < 8; i++) {
            sum += (parseInt(value.charAt(i)) * chkno[i]) % 10;
        }
        sum += Math.floor(parseInt(parseInt(value.charAt(8))) * 5 / 10);
        sum += (parseInt(value.charAt(8)) * 5) % 10 + parseInt(value.charAt(9));

        if (sum % 10 != 0) {
            return false;
        }

        return true;
    },

    isJuriNo : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        if ( (/^([0-9]{6})-?([0-9]{7})$/).test(value) === false ) {
            return false;
        }

        var sum = 0;
        var last = parseInt(value.charAt(12), 10);
        for (var i=0; i<12; i++) {
            if (i % 2 == 0) {  // * 1
                sum += parseInt(value.charAt(i), 10);
            } else {    // * 2
                sum += parseInt(value.charAt(i), 10) * 2;
            };
        };

        var mod = sum % 10;
        if( (10 - mod) % 10 != last ){
            return false;
        }

        return true;
    },

    isPhone : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        return (/^(02|0[0-9]{2,3})[1-9]{1}[0-9]{2,3}[0-9]{4}$/).test(value);
    },

    isMobile : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        return (/^01[016789][1-9]{1}[0-9]{2,3}[0-9]{4}$/).test(value);
    },

    isZipcode : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        return (/^[0-9]{3}[0-9]{3}$/).test(value);
    },

    isIp : function(value) {
        if (value == '') return true;

        return (/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){2,}$/).test(value);
    },

    isEmail : function(value) {
        if (value == '') return true;

        return (/^([a-z0-9\_\-\.]+)@([a-z0-9\_\-]+\.)+[a-z]{2,63}$/i).test(value);
    },

    isUrl : function(value) {
        if (value == '') return true;

        return (/http[s]?:\/\/[a-z0-9_\-]+(\.[a-z0-9_\-]+)+/i).test(value);
    },

    isDate : function(value) {
        value = value.replace(/-/g, '');
        if (value == '') return true;

        return (/^[12][0-9]{3}(([0]?[1-9])|([1][012]))[0-3]?[0-9]$/).test(value);
    },

    isPassport : function(value) {
        if (value == '') return true;

        //일반 여권
        if ( (/^[A-Z]{2}[0-9]{7}$/).test(value) === true ) {
            return true;
        }

        //전자 여권
        if ( (/^[A-Z]{1}[0-9]{8}$/).test(value) === true ) {
            return true;
        }

        return false;
    },

    isNumberMin : function(value, limit) {
        value = this.parent.Helper.getNumberConv(value);
        limit = this.parent.Helper.getNumberConv(limit);

        if (value < limit) {
            return false;
        }

        return true;
    },

    isNumberMax : function(value, limit) {
        value = this.parent.Helper.getNumberConv(value);
        limit = this.parent.Helper.getNumberConv(limit);

        if (value > limit) {
            return false;
        }

        return true;
    },

    isNumberRange : function(value, min, max) {
        value = this.parent.Helper.getNumberConv(value);

        min = this.parent.Helper.getNumberConv(min);
        max = this.parent.Helper.getNumberConv(max);

        if (value < min || value > max) {
            return false;
        }

        return true;
    }
};

/**
 * FwValidator.Filter
 *
 * @package     jquery
 * @subpackage  validator
 */

FwValidator.Filter = {

    parent : FwValidator,

    isFill : function(Response, cond) {
        if (typeof cond != 'string') {
            var count = cond.length;
            var result = this.parent.Helper.getResult(Response, parent.CODE_SUCCESS);

            for (var i = 0; i < count; ++i) {
                result = this._fillConditionCheck(Response, cond[i]);

                if (result.passed === true) {
                    return result;
                }
            }

            return result;
        }

        return this._fillConditionCheck(Response, cond);
    },

    isMatch : function(Response, sField) {
        if(Response.elmCurrValue == ''){
            return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
        }

        //Radio 나 Checkbox의 경우 무시
        if(Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox'){
            return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
        }

        var elmTarget = $('#'+sField);
        var elmTargetValue = elmTarget.val();

        if (Response.elmCurrValue != elmTargetValue) {
            var label = elmTarget.attr(this.parent.ATTR_LABEL);
            var match = label ? label : sField;

            Response.elmCurrErrorMsg = Response.elmCurrErrorMsg.replace(/\{match\}/i, match);

            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isMax : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if (Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox') {
            var chkCount = 0;
            var sName = Response.elmCurrField.attr('name');

            $('input[name="'+sName+'"]').each(function(i){
                if ($(this).get(0).checked === true) {
                    ++chkCount;
                }
            });

            if (chkCount > iLen) {
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }

        } else {
            var len = Response.elmCurrValue.length;

            if (len > iLen) {
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }
        }

        if (result.passed === this.parent.CODE_FAIL) {
            result.msg = result.msg.replace(/\{max\}/i, iLen);
        }

        return result;
    },

    isMin : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox'){
            var chkCount = 0;
            var sName = Response.elmCurrField.attr('name');

            $('input[name="'+sName+'"]').each(function(i){
                if($(this).get(0).checked === true){
                    ++chkCount;
                }
            });

            if (chkCount < iLen) {
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }

        }else{
            var len = Response.elmCurrValue.length;

            if(len < iLen){
                result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            }
        }

        if(result.passed === this.parent.CODE_FAIL){
            result.msg = result.msg.replace(/\{min\}/i, iLen);
        }

        return result;
    },

    isNumber : function(Response, iCond) {
        var result = this.parent.Verify.isNumber(Response.elmCurrValue, iCond);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isIdentity : function(Response){
        var result = this.parent.Verify.isIdentity(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isKorean : function(Response){
        var result = this.parent.Verify.isKorean(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlpha : function(Response){
        var result = this.parent.Verify.isAlpha(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaLower : function(Response){
        var result = this.parent.Verify.isAlphaLower(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaUpper : function(Response){
        var result = this.parent.Verify.isAlphaUpper(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaNum : function(Response){
        var result = this.parent.Verify.isAlphaNum(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaNumLower : function(Response){
        var result = this.parent.Verify.isAlphaNumLower(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaNumUpper : function(Response){
        var result = this.parent.Verify.isAlphaNumUpper(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaDash : function(Response){
        var result = this.parent.Verify.isAlphaDash(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaDashLower : function(Response){
        var result = this.parent.Verify.isAlphaDashLower(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isAlphaDashUpper : function(Response){
        var result = this.parent.Verify.isAlphaDashUpper(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isSsn : function(Response){
        var result = this.parent.Verify.isSsn(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isForeignerNo : function(Response){
        var result = this.parent.Verify.isForeignerNo(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isBizNo : function(Response){
        var result = this.parent.Verify.isBizNo(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isJuriNo : function(Response){
        var result = this.parent.Verify.isJuriNo(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isPhone : function(Response){
        var result = this.parent.Verify.isPhone(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isMobile : function(Response){
        var result = this.parent.Verify.isMobile(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isZipcode : function(Response){
        var result = this.parent.Verify.isZipcode(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isIp : function(Response){
        var result = this.parent.Verify.isIp(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isEmail : function(Response){
        var result = this.parent.Verify.isEmail(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isUrl : function(Response){
        var result = this.parent.Verify.isUrl(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isDate : function(Response){
        var result = this.parent.Verify.isDate(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isRegex : function(Response, regex){
        regex = eval(regex);

        if( regex.test(Response.elmCurrValue) === false ){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isPassport : function(Response){
        var result = this.parent.Verify.isPassport(Response.elmCurrValue);

        if(result === false){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);
    },

    isSimplexEditorFill : function(Response){

        var result = eval(Response.elmCurrValue + ".isEmptyContent();");

        if(result === true){
            return this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
        }

        return this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

    },

    isMaxByte : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var len = this.parent.Helper.getByte(Response.elmCurrValue);

        if (len > iLen) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{max\}/i, iLen);
        }

        return result;
    },

    isMinByte : function(Response, iLen) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var len = this.parent.Helper.getByte(Response.elmCurrValue);

        if (len < iLen) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iLen);
        }

        return result;
    },

    isByteRange : function(Response, range) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var rangeInfo = this._getRangeNum(range);
        var iMin = rangeInfo.min;
        var iMax = rangeInfo.max;

        var len = this.parent.Helper.getByte(Response.elmCurrValue);

        if (len < iMin || len > iMax) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iMin);
            result.msg = result.msg.replace(/\{max\}/i, iMax);
        }

        return result;
    },

    isLengthRange : function(Response, range) {
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        var rangeInfo = this._getRangeNum(range);
        var iMin = rangeInfo.min;
        var iMax = rangeInfo.max;

        var resultMin = this.isMin(Response, iMin);
        var resultMax = this.isMax(Response, iMax);

        if (resultMin.passed === this.parent.CODE_FAIL || resultMax.passed === this.parent.CODE_FAIL) {
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iMin);
            result.msg = result.msg.replace(/\{max\}/i, iMax);
        }

        return result;
    },

    isNumberMin : function(Response, iLimit) {
        var check = this.parent.Verify.isNumberMin(Response.elmCurrValue, iLimit);
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(check === false){
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iLimit);
        }

        return result;
    },

    isNumberMax : function(Response, iLimit) {
        var check = this.parent.Verify.isNumberMax(Response.elmCurrValue, iLimit);
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(check === false){
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{max\}/i, iLimit);
        }

        return result;
    },

    isNumberRange : function(Response, range) {
        var iMin = range[0];
        var iMax = range[1];

        var check = this.parent.Verify.isNumberRange(Response.elmCurrValue, iMin, iMax);
        var result = this.parent.Helper.getResult(Response, this.parent.CODE_SUCCESS);

        if(check === false){
            result = this.parent.Helper.getResult(Response, this.parent.CODE_FAIL);
            result.msg = result.msg.replace(/\{min\}/i, iMin);
            result.msg = result.msg.replace(/\{max\}/i, iMax);
        }

        return result;
    },

    _getRangeNum : function(range) {
        var result = {};

        result.min = range[0] <= 0 ? 0 : parseInt(range[0]);
        result.max = range[1] <= 0 ? 0 : parseInt(range[1]);

        return result;
    },

    _fillConditionCheck : function(Response, cond) {
        cond = $.trim(cond);

        var parent = this.parent;

        //조건식이 들어오면 조건식에 맞을 경우만 필수값을 체크함
        if (cond) {
            var conditions = cond.split('=');
            var fieldId = $.trim(conditions[0]);
            var fieldVal = $.trim(conditions[1]);

            try {
                var val = parent.Helper.getValue(Response.formId, $('#'+fieldId));
                val = $.trim(val);

                if(fieldVal != val) {
                    return parent.Helper.getResult(Response, parent.CODE_SUCCESS);
                }
            } catch(e) {
                if (parent.DEBUG_MODE == true) {
                    Response.elmCurrErrorMsg = parent.msgs['isFillError'];
                    Response.elmCurrErrorMsg = Response.elmCurrErrorMsg.replace(/\{condition\}/i, cond);
                    return parent.Helper.getResult(Response, parent.CODE_FAIL);
                }

                return parent.Helper.getResult(Response, parent.CODE_SUCCESS);
            }
        }

        //Radio 나 Checkbox의 경우 선택한값이 있는지 여부를 체크함
        if (Response.elmCurrFieldType == 'radio' || Response.elmCurrFieldType == 'checkbox') {

            var sName = Response.elmCurrField.attr('name');
            var result = parent.Helper.getResult(Response, parent.CODE_FAIL);

            $('input[name="'+sName+'"]').each(function(i){
                if ($(this).get(0).checked === true) {
                    result = parent.Helper.getResult(Response, parent.CODE_SUCCESS);
                }
            });

            return result;

        }

        //일반 텍스트 박스
        if (Response.elmCurrValue != '') {
            return parent.Helper.getResult(Response, parent.CODE_SUCCESS);
        }

        return parent.Helper.getResult(Response, parent.CODE_FAIL);
    }
};

FwValidator.msgs = {

    //기본
    'isFill' : '{label} 항목은 필수 입력값입니다.',

    'isNumber' : '{label} 항목이 숫자 형식이 아닙니다.',

    'isEmail' : '{label} 항목이 이메일 형식이 아닙니다.',

    'isIdentity' : '{label} 항목이 아이디 형식이 아닙니다.',

    'isMax' : '{label} 항목이 {max}자(개) 이하로 해주십시오.',

    'isMin' : '{label} 항목이 {min}자(개) 이상으로 해주십시오 .',

    'isRegex' : '{label} 항목이 올바른 입력값이 아닙니다.',

    'isAlpha' : '{label} 항목이 영문이 아닙니다',

    'isAlphaLower' : '{label} 항목이 영문 소문자 형식이 아닙니다',

    'isAlphaUpper' : '{label} 항목이 영문 대문자 형식이 아닙니다',

    'isAlphaNum' : '{label} 항목이 영문이나 숫자 형식이 아닙니다.',

    'isAlphaNumLower' : '{label} 항목이 영문 소문자 혹은 숫자 형식이 아닙니다.',

    'isAlphaNumUpper' : '{label} 항목이 영문 대문자 혹은 숫자 형식이 아닙니다.',

    'isAlphaDash' : '{label} 항목이 [영문,숫자,_,-] 형식이 아닙니다.',

    'isAlphaDashLower' : '{label} 항목이 [영문 소문자,숫자,_,-] 형식이 아닙니다.',

    'isAlphaDashUpper' : '{label} 항목이 [영문 대문자,숫자,_,-] 형식이 아닙니다.',

    'isKorean' : '{label} 항목이 한국어 형식이 아닙니다.',

    'isUrl' : '{label} 항목이 URL 형식이 아닙니다.',

    'isSsn' : '{label} 항목이 주민등록번호 형식이 아닙니다.',

    'isForeignerNo' : '{label} 항목이 외국인등록번호 형식이 아닙니다.',

    'isBizNo' : '{label} 항목이 사업자번호 형식이 아닙니다.',

    'isPhone' : '{label} 항목이 전화번호 형식이 아닙니다.',

    'isMobile' : '{label} 항목이 핸드폰 형식이 아닙니다.',

    'isZipcode' : '{label} 항목이 우편번호 형식이 아닙니다.',

    'isJuriNo' : '{label} 항목이 법인번호 형식이 아닙니다.',

    'isIp' : '{label} 항목이 아이피 형식이 아닙니다.',

    'isDate' : '{label} 항목이 날짜 형식이 아닙니다.',

    'isMatch' : '{label} 항목과 {match} 항목이 같지 않습니다.',

    'isSuccess' : '{label} 항목의 데이터는 전송할 수 없습니다.',

    'isSimplexEditorFill' : '{label}(을/를) 입력하세요',

    'isPassport' : '{label} 항목이 여권번호 형식이 아닙니다.',

    'isMaxByte' : '{label} 항목은 {max}bytes 이하로 해주십시오.',

    'isMinByte' : '{label} 항목은 {min}bytes 이상으로 해주십시오.',

    'isByteRange' : '{label} 항목은 {min} ~ {max}bytes 범위로 해주십시오.',

    'isLengthRange' : '{label} 항목은 {min} ~ {max}자(개) 범위로 해주십시오.',

    'isNumberMin' : '{label} 항목은 {min} 이상으로 해주십시오.',

    'isNumberMax' : '{label} 항목은 {max} 이하로 해주십시오.',

    'isNumberRange' : '{label} 항목은 {min} ~ {max} 범위로 해주십시오.',


    //디버깅
    'notMethod' : '{label} 항목에 존재하지 않는 필터를 사용했습니다.',

    'isFillError' : "[{label}] 필드의 isFill {condition} 문장이 잘못되었습니다.\r\n해당 필드의 아이디를 확인하세요."

};

FwValidator.Handler.overrideMsgs({

    //기본
    'isFill' : sprintf(__('%s 항목은 필수 입력값입니다.'), '{label}'),

    'isNumber' : sprintf(__('%s 항목이 숫자 형식이 아닙니다.'), '{label}'),

    'isEmail' : sprintf(__('%s 항목이 이메일 형식이 아닙니다.'), '{label}'),

    'isIdentity' : sprintf(__('%s 항목이 아이디 형식이 아닙니다.'), '{label}'),

    'isMax' : sprintf(__('%1$s 항목이 %2$s자(개) 이하로 해주십시오.'), '{label}', '{max}'),

    'isMin' : sprintf(__('%1$s 항목이 %2$s자(개) 이상으로 해주십시오.'), '{label}', '{min}'),

    'isRegex' : sprintf(__('%s 항목이 올바른 입력값이 아닙니다.'), '{label}'),

    'isAlpha' : sprintf(__('%s 항목이 영문이 아닙니다.'), '{label}'),

    'isAlphaLower' : sprintf(__('%s 항목이 영문 소문자 형식이 아닙니다.'), '{label}'),

    'isAlphaUpper' : sprintf(__('%s 항목이 영문 대문자 형식이 아닙니다.'), '{label}'),

    'isAlphaNum' : sprintf(__('%s 항목이 영문이나 숫자 형식이 아닙니다.'), '{label}'),

    'isAlphaNumLower' : sprintf(__('%s 항목이 영문 소문자 혹은 숫자 형식이 아닙니다.'), '{label}'),

    'isAlphaNumUpper' : sprintf(__('%s 항목이 영문 대문자 혹은 숫자 형식이 아닙니다.'), '{label}'),

    'isAlphaDash' : sprintf(__('%s 항목이 [영문,숫자,_,-] 형식이 아닙니다.'), '{label}'),

    'isAlphaDashLower' : sprintf(__('%s 항목이 [영문 소문자,숫자,_,-] 형식이 아닙니다.'), '{label}'),

    'isAlphaDashUpper' : sprintf(__('%s 항목이 [영문 대문자,숫자,_,-] 형식이 아닙니다.'), '{label}'),

    'isKorean' : sprintf(__('%s 항목이 한국어 형식이 아닙니다.'), '{label}'),

    'isUrl' : sprintf(__('%s 항목이 URL 형식이 아닙니다.'), '{label}'),

    'isSsn' : sprintf(__('%s 항목이 주민등록번호 형식이 아닙니다.'), '{label}'),

    'isForeignerNo' : sprintf(__('%s 항목이 외국인등록번호 형식이 아닙니다.'), '{label}'),

    'isBizNo' : sprintf(__('%s 항목이 사업자번호 형식이 아닙니다.'), '{label}'),

    'isPhone' : sprintf(__('%s 항목이 전화번호 형식이 아닙니다.'), '{label}'),

    'isMobile' : sprintf(__('%s 항목이 핸드폰 형식이 아닙니다.'), '{label}'),

    'isZipcode' : sprintf(__('%s 항목이 우편번호 형식이 아닙니다.'), '{label}'),

    'isJuriNo' : sprintf(__('%s 항목이 법인번호 형식이 아닙니다.'), '{label}'),

    'isIp' : sprintf(__('%s 항목이 아이피 형식이 아닙니다.'), '{label}'),

    'isDate' : sprintf(__('%s 항목이 날짜 형식이 아닙니다.'), '{label}'),

    'isMatch' : sprintf(__('%1$s 항목과 %2$s 항목이 같지 않습니다.'), '{label}', '{match}'),

    'isSuccess' : sprintf(__('%s 항목의 데이터는 전송할 수 없습니다.'), '{label}'),

    'isSimplexEditorFill' : sprintf(__('%s(을/를) 입력하세요.'), '{label}'),

    'isPassport' : sprintf(__('%s 항목이 여권번호 형식이 아닙니다.'), '{label}'),

    'isMaxByte' : sprintf(__('%1$s 항목은 %2$sbytes 이하로 해주십시오.'), '{label}', '{max}'),

    'isMinByte' : sprintf(__('%1$s 항목은 %2$sbytes 이상으로 해주십시오.'), '{label}', '{min}'),

    'isByteRange' : sprintf(__('%1$s 항목은 %2$s ~ %3$sbytes 범위로 해주십시오.'), '{label}', '{min}', '{max}'),

    'isLengthRange' : sprintf(__('%1$s 항목은 %2$s ~ %3$s자(개) 범위로 해주십시오.'), '{label}', '{min}', '{max}'),

    'isNumberMin' : sprintf(__('%1$s 항목은 %2$s 이상으로 해주십시오.'), '{label}', '{min}'),

    'isNumberMax' : sprintf(__('%1$s 항목은 %2$s 이하로 해주십시오.'), '{label}', '{max}'),

    'isNumberRange' : sprintf(__('%1$s 항목은 %2$s ~ %3$s 범위로 해주십시오.'), '{label}', '{min}', '{max}'),


    //디버깅
    'notMethod' : sprintf(__('%s 항목에 존재하지 않는 필터를 사용했습니다.'), '{label}'),

    'isFillError' : sprintf(__('[%1$s] 필드의 isFill %2$s 문장이 잘못되었습니다.\r\n해당 필드의 아이디를 확인하세요.'), '{label}', '{condition}')

});
$(document).ready(function(){
    /**
     * 이미지 롤오버
     * */
    $('img[id^="cate_img_"]')
        .parent()
        .mouseover(function(){
            var $img = $(this).find('img');

            if (!$img.attr('org_src')) $img.attr('org_src', $img.attr('src'));

            $img.attr('src', $img.attr('rollover'));
        })
        .mouseout(function(){
            var $img = $(this).find('img');

            $img.attr('src', $img.attr('org_src'));
        });
        
    /**
     * 카테고리 상세분류를 보기위한 처리
     * 모바일은 온마우스 안됨
     * -구스킨은 레이어 무조건 노출중이라사용안함 
     */
    if (mobileWeb != true) {
        $('.xans-product-displaycategory .button').hover(
            function() {
                $(this).addClass('selected');
            },
            function() {
                $(this).removeClass('selected');
            }
        );
    } else {
        $('.icoClose').live('click', function(v) {
            $('.xans-product-displaycategory .button').removeClass('selected');
            // event bubbling으로 추가
            return false;
        });
        $('.xans-product-displaycategory .button').live('click', function(v) {
            $('.xans-product-displaycategory .button').removeClass('selected');
            $(this).closest('div .button').addClass('selected');
        });
    }
    
    /**
     * 서브카테고리 display - mouseOver
     * */
    /*
    $('.xans-product-listcategory a').mouseover(function(){
        
        var pNode = $(this).parents('li');
        var sHref = $(this).attr('href')
        sHref = sHref.substr(sHref.indexOf('?'));
        var sUrl = '/product/sub_category.html'+sHref; 

        $.get(sUrl, '', function(result) {
            if (result != '') {
                $('#product-listcategory-read').remove();
                $(pNode).append('<div id="product-listcategory-read">'+result+'</div>');
                
                $('.xans-product-subcategory').css('left', '100px');
                subTop = $('.xans-product-subcategory').css('top').replace('px','') - 20;
                $('.xans-product-subcategory').css('top', subTop);
                $('.xans-product-subcategory').mouseover(function() {
                    $('.xans-product-subcategory').show();
                });
                
            }
        });
    });

    $('.xans-product-listcategory a').mouseout(function(){
        //$('#product-listcategory-read').remove();
    });
    
    $('[id^="sub_cate"]').mouseout(function(){
        $(this).css('display:none;');
    });  
    */
});

var EC_SHOP_FRONT_NEW_LIKE_BROWSER_CACHE = {
    /**
     * 로컬 스토리지 지원 여부
     * @return bool 지원하면 true, 지원하지 않으면 false
     */
    isSupport: function() {
        if (window.localStorage) {
            return true;
        } else {
            return false;
        }
    },

    /**
     * 로컬 스토리지에 데이터 셋팅
     * @param string sKey 키
     * @param mixed mData 저장할 데이터
     * @param int iLifeTime 살아있는 시간(초) (기본 1일)
     * @return bool 정상 저장 여부
     */
    setItem: function(sKey, mData, iLifeTime) {
        if (this.isSupport() === false) {
            return false;
        }

        iLifeTime = iLifeTime || 86400;

        try {
            window.localStorage.setItem(sKey, JSON.stringify({
                iExpireTime: Math.floor(new Date().getTime() / 1000) + iLifeTime,
                mContent: mData
            }));
        } catch (e) {
            return false;
        }

        return true;
    },

    /**
     * 로컬 스토리지에서 데이터 리턴
     * @param string sKey 키
     * @return mixed 데이터
     */
    getItem: function(sKey) {
        if (this.isSupport() === false) {
            return null;
        }

        var sData = window.localStorage.getItem(sKey);
        try {
            if (sData) {
                var aData = JSON.parse(sData);
                if (aData.iExpireTime > Math.floor(new Date().getTime() / 1000)) {
                    return aData.mContent;
                } else {
                    window.localStorage.removeItem(sKey);
                }
            }
        } catch (e) { }

        return null;
    },

    /**
     * 로컬 스토리지에서 데이터 삭제
     * @param string sKey 키
     */
    removeItem: function(sKey) {
        if (this.isSupport() === false) {
            return;
        }

        window.localStorage.removeItem(sKey);
    }
};

/**
 * 좋아요 관련 공통
 */
var EC_SHOP_FRONT_NEW_LIKE_COMMON = {
    CACHE_LIFE_TIME: 3600,
    CACHE_KEY_MY_LIKE_CATEGORY: 'localMyLikeCategoryNoList',
    CACHE_KEY_MY_LIKE_PRODUCT: 'localMyLikeProductNoList',

    aConfig: {
        bIsUseLikeProduct: false,
        bIsUseLikeCategory: false
    },

    init: function(aConfig)
    {
        this.aConfig = aConfig;
    },

    /**
     * 내 분류 좋아요 번호 리스트를 가져와서 successCallbackFn 콜백 함수를 실행합니다.
     * @param function successCallbackFn 성공시 실행할 콜백 함수
     * @param function completeCallbackFn ajax 호출 완료 후 실행할 콜백 함수
     */
    getMyLikeCategoryNoInList: function(successCallbackFn, completeCallbackFn)
    {
        var self = this;

        var aData = EC_SHOP_FRONT_NEW_LIKE_BROWSER_CACHE.getItem(self.CACHE_KEY_MY_LIKE_CATEGORY);
        if (aData !== null) {
            successCallbackFn(aData);
            completeCallbackFn();

        } else {
            $.ajax({
                url: '/exec/front/shop/LikeCommon',
                type: 'get',
                data: {
                    'mode'   : 'getMyLikeCategoryNoInList'
                },
                dataType: 'json',
                success: function(oReturn) {
                    if (oReturn.bResult === true) {
                        aData = oReturn.aData;
                        EC_SHOP_FRONT_NEW_LIKE_BROWSER_CACHE.setItem(self.CACHE_KEY_MY_LIKE_CATEGORY, aData, self.CACHE_LIFE_TIME);
                        successCallbackFn(aData);
                    }
                },
                complete: function() {
                    completeCallbackFn();
                }
            });
        }
    },

    /**
     * 내 분류 좋아요 번호 리스트 캐시를 퍼지합니다.
     */
    purgeMyLikeCategoryNoInList: function()
    {
        EC_SHOP_FRONT_NEW_LIKE_BROWSER_CACHE.removeItem(this.CACHE_KEY_MY_LIKE_CATEGORY);
    },

    /**
     * 내 상품 좋아요 번호 리스트를 가져와서 successCallbackFn 콜백 함수를 실행합니다.
     * @param function successCallbackFn 성공시 실행할 콜백 함수
     * @param function completeCallbackFn ajax 호출 완료 후 실행할 콜백 함수
     */
    getMyLikeProductNoInList: function(successCallbackFn, completeCallbackFn)
    {
        var self = this;

        var aData = EC_SHOP_FRONT_NEW_LIKE_BROWSER_CACHE.getItem(self.CACHE_KEY_MY_LIKE_PRODUCT);
        if (aData !== null) {
            successCallbackFn(aData);
            completeCallbackFn();

        } else {
            $.ajax({
                url: '/exec/front/shop/LikeCommon',
                type: 'get',
                data: {
                    'mode'   : 'getMyLikeProductNoInList'
                },
                dataType: 'json',
                success: function(oReturn) {
                    if (oReturn.bResult === true) {
                        aData = oReturn.aData;
                        EC_SHOP_FRONT_NEW_LIKE_BROWSER_CACHE.setItem(self.CACHE_KEY_MY_LIKE_PRODUCT, aData, self.CACHE_LIFE_TIME);
                        successCallbackFn(aData);
                    }
                },
                complete: function() {
                    completeCallbackFn();
                }
            });
        }
    },

    /**
     * 내 상품 좋아요 번호 리스트 캐시를 퍼지합니다.
     */
    purgeMyLikeProductNoInList: function()
    {
        EC_SHOP_FRONT_NEW_LIKE_BROWSER_CACHE.removeItem(this.CACHE_KEY_MY_LIKE_PRODUCT);
    },
    // 숫자 관련 콤마 제거 처리(ECHOSTING-260504)
    getNumericRemoveCommas : function(mText) {
        var sSearchCommas = ',';
        var sReplaceEmpty = '';

        if ($.inArray(typeof(mText), ['number', 'undefined']) > -1) {
            return mText;
        }

        while (mText.indexOf(sSearchCommas) > -1) {
            mText = mText.replace(sSearchCommas, sReplaceEmpty);
        }

        return mText;
    },
    // 숫자 관련 콤마 처리 (ECHOSTING-260504)
    getNumberFormat : function(iNumber)
    {
        iNumber += '';

        var objRegExp = new RegExp('(-?[0-9]+)([0-9]{3})');
        while (objRegExp.test(iNumber)) {
            iNumber = iNumber.replace(objRegExp, '$1,$2');
        }

        return iNumber;
    }
};

/**
 * 목록 > 분류 좋아요.
 */
var EC_SHOP_FRONT_NEW_LIKE_COMMON_CATEGORY = {
    bIsReady     : false,   // 좋아요 클릭준비완료 여부.
    bIsSetEvent  : false,   // 좋아요 버튼 이벤트 지정 여부.
    aImgSrc      : [],      // 좋아요(On/Off) 아이콘 경로.
    aMyLikeCateNo: [],      // 유저가 이미 좋아요 선택한 분류번호

    // 분류 좋아요 초기화
    init : function() {
        // 분류 좋아요 사용안함시
        if (EC_SHOP_FRONT_NEW_LIKE_COMMON.aConfig.bIsUseLikeCategory !== true) {
            return;
        }

        // ajax 유저가 이미 좋아요 선택한 분류번호 얻기 + 아이콘세팅
        this.setLoadData();
    },

    // 유저가 이미 좋아요 선택한 분류번호 얻기 + 아이콘세팅
    setLoadData : function() {
        if ($('.likeCateIcon').count < 1) {
            return;
        }

        var self = this;

        EC_SHOP_FRONT_NEW_LIKE_COMMON.getMyLikeCategoryNoInList(function(aData) {
            self.aImgSrc = aData.imgSrc;
            self.aMyLikeCateNo = aData.rows;

            // 아이콘(on) 세팅
            self.setMyLikeCategoryIconOn();

            // 좋아요 클릭 이벤트핸들러 지정
            if (self.bIsSetEvent === false) {
                self.setEventHandler();
                self.bIsSetEvent = true;
            }
        }, function() {
            self.bIsReady = true;
        });
    },

    // 페이지 로드시 유저가 좋아요한 분류 On.아이콘으로 변경
    setMyLikeCategoryIconOn : function() {
        var aData = this.aMyLikeCateNo;

        for (var i=0; i < aData.length; i++) {
            // selected 스타일 적용
            $(".likeCate_" + aData[i].category_no).each(function() {
                $(this).addClass('selected');
            });

            // 아이콘 이미지경로 변경
            $(".likeCateIcon[category_no='" + aData[i].category_no + "']").each(function() {
                $(this).attr({'src':EC_SHOP_FRONT_NEW_LIKE_COMMON_CATEGORY.aImgSrc.on, 'icon_status':'on'});
            });
        }
    },

    setEventHandler : function() {
        $('.likeCate').live('click', EC_SHOP_FRONT_NEW_LIKE_COMMON_CATEGORY.clickLikeIcon);
    },

    clickLikeIcon : function() {
        if (EC_SHOP_FRONT_NEW_LIKE_COMMON_CATEGORY.bIsReady === false ) {
            return;
        }

        // 클릭한 분류 좋아요수 + 아이콘 정보 얻기
        var iCateNo = $('.likeCateIcon', this).attr('category_no');
        var sIconStatus= $('.likeCateIcon', this).attr('icon_status');
        // 카운트 string > int 형으로 변환 (ECHOSTING-260504)
        var iLikeCount = EC_SHOP_FRONT_NEW_LIKE_COMMON.getNumericRemoveCommas($('.likeCateCount', this).text());

        // 아이콘경로 및 좋아요수 증감처리
        var sNewImgSrc = sNewIconStatus = "";
        var iNewLikeCount = 0;
        var oLikeWrapNode = $(".likeCate_" + iCateNo);

        if (sIconStatus === 'on') {
            sNewIconStatus = 'off';
            sNewImgSrc = EC_SHOP_FRONT_NEW_LIKE_COMMON_CATEGORY.aImgSrc.off;
            if (iLikeCount > 0) {
                iNewLikeCount = --iLikeCount;
            }

            oLikeWrapNode.each(function() {
                $(this).removeClass('selected');
            });
        } else {
            sNewIconStatus = 'on';
            sNewImgSrc = EC_SHOP_FRONT_NEW_LIKE_COMMON_CATEGORY.aImgSrc.on;
            iNewLikeCount = ++iLikeCount;

            // 동일상품 selected 스타일적용
            oLikeWrapNode.each(function() {
                $(this).addClass('selected');
            });
        }

        // 좋아요 카운트 number_format (ECHOSTING-260504)
        iNewLikeCount = EC_SHOP_FRONT_NEW_LIKE_COMMON.getNumberFormat(iNewLikeCount);

        // 동일분류 아이콘 변경
        $(".likeCateIcon[category_no='" + iCateNo + "']").each(function() {
            $(this).attr({'src':sNewImgSrc, 'icon_status':sNewIconStatus});
        });

        // 동일분류 좋아요수 변경
        $('.likeCateCount_' + iCateNo).each(function() {
            $(this).text(iNewLikeCount);
        });

        // ajax 호출 좋아요수(상품) + 마이쇼핑 좋아요 저장
        EC_SHOP_FRONT_NEW_LIKE_COMMON_CATEGORY.submitMyLikeCategory(iCateNo, sNewIconStatus);
    },

    // 분류 좋아요수 + 마이쇼핑 좋아요 저장
    submitMyLikeCategory : function(iCateNo, sIconStatus) {
        if (sIconStatus === 'on') {
            this.aMyLikeCateNo.push(iCateNo);
        } else {
            this.aMyLikeCateNo.pop(iCateNo);
        }

        $.ajax({
            url: '/exec/front/shop/LikeCommon',
            type: 'get',
            data: {
                'mode'   : 'saveMyLikeCategory',
                'iCateNo' : iCateNo,
                'sIconStatus': sIconStatus
            },
            dataType: 'json',
            success: function(oReturn) {
                if (oReturn.bResult === true) {
                    EC_SHOP_FRONT_NEW_LIKE_COMMON.purgeMyLikeCategoryNoInList();
                }
            },
            complete: function() {
                EC_SHOP_FRONT_NEW_LIKE_COMMON_CATEGORY.bIsReady = true;
            }
        });
    }
};

$(document).ready(function() {
    EC_SHOP_FRONT_NEW_LIKE_COMMON_CATEGORY.init(); // 분류 좋아요.
});

var EC_SHOP_FRONT_REVIEW_TALK_REVIEW_COUNT = {
    aProductNo : [],
    bIsReviewTalk : 'F',
    setReviewTalkCnt : function() {
        var bIsUse = this.checkUseReviewTalk();

        if (bIsUse === true) {
            this.setDataProductNo();
            this.setResponseCountData();
        }
    },

    checkUseReviewTalk : function() {
        return (this.bIsReviewTalk === 'T' && $('.reviewtalk_review_count').length > 0) ? true : false;
    },

    setDataProductNo : function() {
        var aAllProductNo = [];
        $('.reviewtalk_review_count').each(function() {
            aAllProductNo.push($(this).attr('data-product-no'));
        });

        EC_SHOP_FRONT_REVIEW_TALK_REVIEW_COUNT.aProductNo = $.unique(aAllProductNo);
    },

    setResponseCountData : function() {
        if (this.aProductNo.length < 1) {
            return;
        }

        $.ajax({
            url: '/exec/front/shop/ApiReviewtalkReviewcnt',
            type: 'get',
            data: {
                'product_no' : this.aProductNo
            },
            dataType: 'json',
            success: function(oResponse) {
                if (oResponse.result === true) {
                    EC_SHOP_FRONT_REVIEW_TALK_REVIEW_COUNT.setResponseData(oResponse.data);
                }
            }
        });
    },

    setResponseData : function(oResponseData) {
       var oProductReviewCnt = oResponseData;

       if (this.checkUseReviewTalk() === true) {
           $('.reviewtalk_review_count').each(function() {
               var iProductNo = $(this).attr('data-product-no');
               var sFormat = $(this).attr('data-format');
               var iReviewCount = 0;

               if (oProductReviewCnt.hasOwnProperty(iProductNo) === true && oProductReviewCnt[iProductNo].hasOwnProperty('review_count') === true) {
                   iReviewCount = oProductReviewCnt[iProductNo].review_count;
               }

               $(this).text(sFormat.replace('REVIEWTALKCOUNT', iReviewCount));
           });
       }
    }
}

$(document).ready(function() {
    EC_SHOP_FRONT_REVIEW_TALK_REVIEW_COUNT.setReviewTalkCnt();
});


/**
 * 쇼핑몰 금액 라이브러리
 */
var SHOP_PRICE = {

    /**
     * iShopNo 쇼핑몰의 결제화폐에 맞게 리턴합니다.
     * @param float fPrice 금액
     * @param bool bIsNumberFormat number_format 적용 유무
     * @param int iShopNo 쇼핑몰번호
     * @return float|string
     */
    toShopPrice: function(fPrice, bIsNumberFormat, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 결제화폐 정보
        var aCurrencyInfo = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo;

        return SHOP_PRICE.toPrice(fPrice, aCurrencyInfo, bIsNumberFormat);
    },

    /**
     * iShopNo 쇼핑몰의 참조화폐에 맞게 리턴합니다.
     * @param float fPrice 금액
     * @param bool bIsNumberFormat number_format 적용 유무
     * @param int iShopNo 쇼핑몰번호
     * @return float|string
     */
    toShopSubPrice: function(fPrice, bIsNumberFormat, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 참조화폐 정보
        var aSubCurrencyInfo = SHOP_CURRENCY_INFO[iShopNo].aShopSubCurrencyInfo;

        if ( ! aSubCurrencyInfo) {
            // 참조화폐가 없으면
            return '';

        } else {
            // 결제화폐 정보
            var aCurrencyInfo = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo;
            if (aSubCurrencyInfo.currency_code === aCurrencyInfo.currency_code) {
                // 결제화폐와 참조화폐가 동일하면
                return '';
            } else {
                return SHOP_PRICE.toPrice(fPrice, aSubCurrencyInfo, bIsNumberFormat);
            }
        }
    },

    /**
     * 쇼핑몰의 기준화폐에 맞게 리턴합니다.
     * @param float fPrice 금액
     * @param bool bIsNumberFormat number_format 적용 유무
     * @param int iShopNo 쇼핑몰번호
     * @return float
     */
    toBasePrice: function(fPrice, bIsNumberFormat, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 기준화폐 정보
        var aBaseCurrencyInfo = SHOP_CURRENCY_INFO[iShopNo].aBaseCurrencyInfo;

        return SHOP_PRICE.toPrice(fPrice, aBaseCurrencyInfo, bIsNumberFormat);
    },

    /**
     * 결제화폐 금액을 참조화폐 금액으로 변환하여 리턴합니다.
     * @param float fPrice 금액
     * @param bool bIsNumberFormat number_format 적용 유무
     * @param int iShopNo 쇼핑몰번호
     * @return float 참조화폐 금액
     */
    shopPriceToSubPrice: function(fPrice, bIsNumberFormat, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 결제화폐 금액 => 참조화폐 금액
        fPrice = fPrice * (SHOP_CURRENCY_INFO[iShopNo].fExchangeSubRate || 0);

        return SHOP_PRICE.toShopSubPrice(fPrice, bIsNumberFormat, iShopNo);
    },

    /**
     * 결제화폐 대비 기준화폐 환율 리턴
     * @param int iShopNo 쇼핑몰번호
     * @return float 결제화폐 대비 기준화폐 환율
     */
    getRate: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        return SHOP_CURRENCY_INFO[iShopNo].fExchangeRate;
    },

    /**
     * 결제화폐 대비 참조화폐 환율 리턴
     * @param int iShopNo 쇼핑몰번호
     * @return float 결제화폐 대비 참조화폐 환율 (참조화폐가 없는 경우 null을 리턴합니다.)
     */
    getSubRate: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        return SHOP_CURRENCY_INFO[iShopNo].fExchangeSubRate;;
    },

    /**
     * 금액을 원하는 화폐코드의 제약조건(소수점 절삭)에 맞춰 리턴합니다.
     * @param float fPrice 금액
     * @param string aCurrencyInfo 원하는 화폐의 화폐 정보
     * @param bool bIsNumberFormat number_format 적용 유무
     * @return float|string
     */
    toPrice: function(fPrice, aCurrencyInfo, bIsNumberFormat)
    {
        // 소수점 아래 절삭
        var iPow = Math.pow(10, aCurrencyInfo['decimal_place']);
        fPrice = fPrice * iPow;
        if (aCurrencyInfo['round_method_type'] === 'F') {
            fPrice = Math.floor(fPrice);
        } else if (aCurrencyInfo['round_method_type'] === 'C') {
            fPrice = Math.ceil(fPrice);
        } else {
            fPrice = Math.round(fPrice);
        }
        fPrice = fPrice / iPow;

        if ( ! fPrice) {
            // 가격이 없는 경우
            return 0;

        } else if (bIsNumberFormat === true) {
            // 3자리씩 ,로 끊어서 리턴
            var sPrice = fPrice.toFixed(aCurrencyInfo['decimal_place']);
            var regexp = /^(-?[0-9]+)([0-9]{3})($|\.|,)/;
            while (regexp.test(sPrice)) {
                sPrice = sPrice.replace(regexp, "$1,$2$3");
            }
            return sPrice;

        } else {
            // 숫자만 리턴
            return fPrice;

        }
    }    
};

/**
 * 화폐 포맷
 */
var SHOP_CURRENCY_FORMAT = {
    /**
     * 어드민 페이지인지
     * @var bool
     */
    _bIsAdmin: /^\/(admin\/php|disp\/admin|exec\/admin)\//.test(location.pathname) ? true : false,

    /**
     * iShopNo 쇼핑몰의 결제화폐 포맷을 리턴합니다.
     * @param int iShopNo 쇼핑몰번호
     * @return array head,tail
     */
    getShopCurrencyFormat: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 결제화폐 코드
        var sCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo.currency_code;

        if (SHOP_CURRENCY_FORMAT._bIsAdmin === true) {
            // 어드민

            // 기준화폐 코드
            var sBaseCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aBaseCurrencyInfo.currency_code;

            if (sCurrencyCode === sBaseCurrencyCode) {
                // 결제화폐와 기준화폐가 동일한 경우
                return {
                    'head': '',
                    'tail': ''
                };

            } else {
                return {
                    'head': sCurrencyCode + ' ',
                    'tail': ''
                };
            }

        } else {
            // 프론트
            return SHOP_CURRENCY_INFO[iShopNo].aFrontCurrencyFormat;
        }
    },

    /**
     * iShopNo 쇼핑몰의 참조화폐의 포맷을 리턴합니다.
     * @param int iShopNo 쇼핑몰번호
     * @return array head,tail
     */
    getShopSubCurrencyFormat: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 참조화폐 정보
        var aSubCurrencyInfo = SHOP_CURRENCY_INFO[iShopNo].aShopSubCurrencyInfo;

        if ( ! aSubCurrencyInfo) {
            // 참조화폐가 없으면
            return {
                'head': '',
                'tail': ''
            };

        } else if (SHOP_CURRENCY_FORMAT._bIsAdmin === true) {
            // 어드민
            return {
                'head': '(' + aSubCurrencyInfo.currency_code + ' ',
                'tail': ')'
            };

        } else {
            // 프론트
            return SHOP_CURRENCY_INFO[iShopNo].aFrontSubCurrencyFormat;
        }

    },

    /**
     * 쇼핑몰의 기준화폐의 포맷을 리턴합니다.
     * @param int iShopNo 쇼핑몰번호
     * @return array head,tail
     */
    getBaseCurrencyFormat: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        // 기준화폐 코드
        var sBaseCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aBaseCurrencyInfo.currency_code;

        // 결제화폐 코드
        var sCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo.currency_code;

        if (sCurrencyCode === sBaseCurrencyCode) {
            // 기준화폐와 결제화폐가 동일하면
            return {
                'head': '',
                'tail': ''
            };

        } else {
            // 어드민
            return {
                'head': '(' + sBaseCurrencyCode + ' ',
                'tail': ')'
            };

        }
    },

    /**
     * 금액 입력란 화폐 포맷용 head,tail
     * @param int iShopNo 쇼핑몰번호
     * @return array head,tail
     */
    getInputFormat: function(iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var sCurrencyCode = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo;

        // 멀티쇼핑몰이 아니고 단위가 '원화'인 경우
        if (SHOP.isMultiShop() === false && sCurrencyCode === 'KRW') {
            return {
                'head': '',
                'tail': '원'
            };

        } else {
            return {
                'head': '',
                'tail': sCurrencyCode
            };
        }
    }

};

/**
 * 금액 포맷
 */
var SHOP_PRICE_FORMAT = {
    /**
     * iShopNo 쇼핑몰의 결제화폐에 맞도록 하고 포맷팅하여 리턴합니다.
     * @param float fPrice 금액
     * @param int iShopNo 쇼핑몰번호
     * @return string
     */
    toShopPrice: function(fPrice, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var aFormat = SHOP_CURRENCY_FORMAT.getShopCurrencyFormat(iShopNo);
        var sPrice = SHOP_PRICE.toShopPrice(fPrice, true, iShopNo);
        return aFormat.head + sPrice + aFormat.tail;
    },

    /**
     * iShopNo 쇼핑몰의 참조화폐에 맞도록 하고 포맷팅하여 리턴합니다.
     * @param float fPrice 금액
     * @param int iShopNo 쇼핑몰번호
     * @return string
     */
    toShopSubPrice: function(fPrice, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var aFormat = SHOP_CURRENCY_FORMAT.getShopSubCurrencyFormat(iShopNo);
        var sPrice = SHOP_PRICE.toShopSubPrice(fPrice, true, iShopNo);
        return aFormat.head + sPrice + aFormat.tail;
    },

    /**
     * 쇼핑몰의 기준화폐에 맞도록 하고 포맷팅하여 리턴합니다.
     * @param float fPrice 금액
     * @param int iShopNo 쇼핑몰번호
     * @return string
     */
    toBasePrice: function(fPrice, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var aFormat = SHOP_CURRENCY_FORMAT.getBaseCurrencyFormat(iShopNo);
        var sPrice = SHOP_PRICE.toBasePrice(fPrice, true, iShopNo);
        return aFormat.head + sPrice + aFormat.tail;
    },

    /**
     * 결제화폐 금액을 참조화폐 금액으로 변환하고 포맷팅하여 리턴합니다.
     * @param float fPrice 금액
     * @param int iShopNo 쇼핑몰번호
     * @return string
     */
    shopPriceToSubPrice: function(fPrice, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var aFormat = SHOP_CURRENCY_FORMAT.getShopSubCurrencyFormat(iShopNo);
        var sPrice = SHOP_PRICE.shopPriceToSubPrice(fPrice, true, iShopNo);
        return aFormat.head + sPrice + aFormat.tail;
    },
    

    /**
     * 금액을 적립금 단위 명칭 설정에 따라 반환
     * @param float fPrice 금액
     * @return float|string
     */
    toShopMileagePrice: function (fPrice, iShopNo) {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;
        
        var sPrice = SHOP_PRICE.toShopPrice(fPrice, true, iShopNo);
        if (typeof sMileageUnit != 'undefined' && $.trim(sMileageUnit) != '') {
            sConvertMileageUnit = sMileageUnit.replace('[:가격:]', sPrice);
            return sConvertMileageUnit;
        } else {
            return SHOP_PRICE_FORMAT.toShopPrice(fPrice);
        }
    },

    /**
     * 금액을 예치금 단위 명칭 설정에 따라 반환
     * @param float fPrice 금액
     * @return float|string
     */
    toShopDepositPrice: function (fPrice, iShopNo) {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;
        
        var sPrice = SHOP_PRICE.toShopPrice(fPrice, true, iShopNo);
        if (typeof sDepositUnit != 'undefined' || $.trim(sDepositUnit) != '') {
            return sPrice + sDepositUnit;
        } else {
            return SHOP_PRICE_FORMAT.toShopPrice(fPrice);
        }
    },

    /**
     * 금액을 부가결제수단(통합포인트) 단위 명칭 설정에 따라 반환
     * @param float fPrice 금액
     * @return float|string
     */
    toShopAddpaymentPrice: function (fPrice, sAddpaymentUnit, iShopNo) {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var sPrice = SHOP_PRICE.toShopPrice(fPrice, true, iShopNo);
        if (typeof sDepositUnit != 'undefined' || $.trim(sDepositUnit) != '') {
            return sPrice + sAddpaymentUnit;
        } else {
            return SHOP_PRICE_FORMAT.toShopPrice(fPrice);
        }
    }

};

var SHOP_PRICE_UTIL = {
    /**
     * iShopNo 쇼핑몰의 결제화폐 금액 입력폼으로 만듭니다.
     * @param Element elem 입력폼
     */
    toShopPriceInput: function(elem, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var iDecimalPlace = SHOP_CURRENCY_INFO[iShopNo].aShopCurrencyInfo.decimal_place;
        SHOP_PRICE_UTIL._toPriceInput(elem, iDecimalPlace);
    },

    /**
     * iShopNo 쇼핑몰의 참조화폐 금액 입력폼으로 만듭니다.
     * @param Element elem 입력폼
     */
    toShopSubPriceInput: function(elem, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var iDecimalPlace = SHOP_CURRENCY_INFO[iShopNo].aShopSubCurrencyInfo.decimal_place;
        SHOP_PRICE_UTIL._toPriceInput(elem, iDecimalPlace);
    },

    /**
     * iShopNo 쇼핑몰의 기준화폐 금액 입력폼으로 만듭니다.
     * @param Element elem 입력폼
     */
    toBasePriceInput: function(elem, iShopNo)
    {
        iShopNo = parseInt(iShopNo) || EC_SDE_SHOP_NUM;

        var iDecimalPlace = SHOP_CURRENCY_INFO[iShopNo].aBaseCurrencyInfo.decimal_place;
        SHOP_PRICE_UTIL._toPriceInput(elem, iDecimalPlace);
    },

    /**
     * 소수점 iDecimalPlace까지만 입력 가능하도록 처리
     * @param Element elem 입력폼
     * @param int iDecimalPlace 허용 소수점
     */
    _toPriceInput: function(elem, iDecimalPlace)
    {
        attachEvent(elem, 'keyup', function(e) {
            e = e || window.event;
            replaceToPrice(e.srcElement);
        });
        attachEvent(elem, 'blur', function(e) {
            e = e || window.event;
            replaceToPrice(e.srcElement);
        });

        function replaceToPrice(target)
        {
            var value = target.value;

            var regExpTest = new RegExp('^[0-9]*' + (iDecimalPlace ? '' : '\\.[0-9]{0, ' + iDecimalPlace + '}' ) + '$');
            if (regExpTest.test(value) === false) {
                value = value.replace(/[^0-9.]/g, '');
                if (parseInt(iDecimalPlace)) {
                    value = value.replace(/^([0-9]+\.[0-9]+)\.+.*$/, '$1');
                    value = value.replace(new RegExp('(\\.[0-9]{' + iDecimalPlace + '})[0-9]*$'), '$1');
                } else {
                    value = value.replace(/\.+[0-9]*$/, '');
                }
                target.value = value;
            }
        }

        function attachEvent(elem, sEventName, fn)
        {
            if ( elem.addEventListener ) {
                elem.addEventListener( sEventName, fn, false );

            } else if ( elem.attachEvent ) {
                elem.attachEvent( "on" + sEventName, fn );
            }
        }

    }
};

if (window.jQuery !== undefined) {
    $.fn.extend({
        toShopPriceInput : function(iShopNo)
        {
            return this.each(function(){
                var iElementShopNo = $(this).data('shop_no') || iShopNo;
                SHOP_PRICE_UTIL.toShopPriceInput(this, iElementShopNo);
            });
        },
        toShopSubPriceInput : function(iShopNo)
        {
            return this.each(function(){
                var iElementShopNo = $(this).data('shop_no') || iShopNo;
                SHOP_PRICE_UTIL.toShopSubPriceInput(this, iElementShopNo);
            });
        },
        toBasePriceInput : function(iShopNo)
        {
            return this.each(function(){
                var iElementShopNo = $(this).data('shop_no') || iShopNo;
                SHOP_PRICE_UTIL.toBasePriceInput(this, iElementShopNo);
            });
        }
    });
}

/**
 * jQuery JSON Plugin
 * version: 2.3 (2011-09-17)
 *
 * This document is licensed as free software under the terms of the
 * MIT License: http://www.opensource.org/licenses/mit-license.php
 *
 * Brantley Harris wrote this plugin. It is based somewhat on the JSON.org
 * website's http://www.json.org/json2.js, which proclaims:
 * "NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.", a sentiment that
 * I uphold.
 *
 * It is also influenced heavily by MochiKit's serializeJSON, which is
 * copyrighted 2005 by Bob Ippolito.
 */

(function( $ ) {

    var escapeable = /["\\\x00-\x1f\x7f-\x9f]/g,
        meta = {
            '\b': '\\b',
            '\t': '\\t',
            '\n': '\\n',
            '\f': '\\f',
            '\r': '\\r',
            '"' : '\\"',
            '\\': '\\\\'
        };

    /**
     * jQuery.toJSON
     * Converts the given argument into a JSON respresentation.
     *
     * @param o {Mixed} The json-serializble *thing* to be converted
     *
     * If an object has a toJSON prototype, that will be used to get the representation.
     * Non-integer/string keys are skipped in the object, as are keys that point to a
     * function.
     *
     */
    $.toJSON = typeof JSON === 'object' && JSON.stringify
        ? JSON.stringify
        : function( o ) {

        if ( o === null ) {
            return 'null';
        }

        var type = typeof o;

        if ( type === 'undefined' ) {
            return undefined;
        }
        if ( type === 'number' || type === 'boolean' ) {
            return '' + o;
        }
        if ( type === 'string') {
            return $.quoteString( o );
        }
        if ( type === 'object' ) {
            if ( typeof o.toJSON === 'function' ) {
                return $.toJSON( o.toJSON() );
            }
            if ( o.constructor === Date ) {
                var month = o.getUTCMonth() + 1,
                    day = o.getUTCDate(),
                    year = o.getUTCFullYear(),
                    hours = o.getUTCHours(),
                    minutes = o.getUTCMinutes(),
                    seconds = o.getUTCSeconds(),
                    milli = o.getUTCMilliseconds();

                if ( month < 10 ) {
                    month = '0' + month;
                }
                if ( day < 10 ) {
                    day = '0' + day;
                }
                if ( hours < 10 ) {
                    hours = '0' + hours;
                }
                if ( minutes < 10 ) {
                    minutes = '0' + minutes;
                }
                if ( seconds < 10 ) {
                    seconds = '0' + seconds;
                }
                if ( milli < 100 ) {
                    milli = '0' + milli;
                }
                if ( milli < 10 ) {
                    milli = '0' + milli;
                }
                return '"' + year + '-' + month + '-' + day + 'T' +
                    hours + ':' + minutes + ':' + seconds +
                    '.' + milli + 'Z"';
            }
            if ( o.constructor === Array ) {
                var ret = [];
                for ( var i = 0; i < o.length; i++ ) {
                    ret.push( $.toJSON( o[i] ) || 'null' );
                }
                return '[' + ret.join(',') + ']';
            }
            var name,
                val,
                pairs = [];
            for ( var k in o ) {
                type = typeof k;
                if ( type === 'number' ) {
                    name = '"' + k + '"';
                } else if (type === 'string') {
                    name = $.quoteString(k);
                } else {
                    // Keys must be numerical or string. Skip others
                    continue;
                }
                type = typeof o[k];

                if ( type === 'function' || type === 'undefined' ) {
                    // Invalid values like these return undefined
                    // from toJSON, however those object members
                    // shouldn't be included in the JSON string at all.
                    continue;
                }
                val = $.toJSON( o[k] );
                pairs.push( name + ':' + val );
            }
            return '{' + pairs.join( ',' ) + '}';
        }
    };

    /**
     * jQuery.evalJSON
     * Evaluates a given piece of json source.
     *
     * @param src {String}
     */
    $.evalJSON = typeof JSON === 'object' && JSON.parse
        ? JSON.parse
        : function( src ) {
        return eval('(' + src + ')');
    };

    /**
     * jQuery.secureEvalJSON
     * Evals JSON in a way that is *more* secure.
     *
     * @param src {String}
     */
    $.secureEvalJSON = typeof JSON === 'object' && JSON.parse
        ? JSON.parse
        : function( src ) {

        var filtered =
            src
            .replace( /\\["\\\/bfnrtu]/g, '@' )
            .replace( /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']')
            .replace( /(?:^|:|,)(?:\s*\[)+/g, '');

        if ( /^[\],:{}\s]*$/.test( filtered ) ) {
            return eval( '(' + src + ')' );
        } else {
            throw new SyntaxError( 'Error parsing JSON, source is not valid.' );
        }
    };

    /**
     * jQuery.quoteString
     * Returns a string-repr of a string, escaping quotes intelligently.
     * Mostly a support function for toJSON.
     * Examples:
     * >>> jQuery.quoteString('apple')
     * "apple"
     *
     * >>> jQuery.quoteString('"Where are we going?", she asked.')
     * "\"Where are we going?\", she asked."
     */
    $.quoteString = function( string ) {
        if ( string.match( escapeable ) ) {
            return '"' + string.replace( escapeable, function( a ) {
                var c = meta[a];
                if ( typeof c === 'string' ) {
                    return c;
                }
                c = a.charCodeAt();
                return '\\u00' + Math.floor(c / 16).toString(16) + (c % 16).toString(16);
            }) + '"';
        }
        return '"' + string + '"';
    };

})( jQuery );

/**
 * 상품연동형 js - for 프론트
 */


;(function($) {

    var $Olnk = {
         iOlinkTotalPrice  : 0, // 저장형 옵션의 가격
         iAddOptionTotalPrice  : 0, // 추가 구성상품의 가격
         aOptionData : new Array(), // 순차적 로딩을 위한 배열
         iOptionAddNum : 1, // 필수값을 표시하기 위한 번호
         iOptionAddProductNum : 1,
         aOptionAddProductNum : new Array(),
         aOptionProductData : new Array(),
         aOptionProductDataListKey : new Array(),
         bAllSelectedOption : false,

         getOlnkSelectedItem : function(aStockData, bButton, sDispNonePrice, iProductPrice)
         {
             var aOption = new Array();
             var bItemSelected = false;
             var bResult = true;
             var sOptionId = '';
             var iOptPrice = 0;
             var iPrdPrice = SHOP_PRICE.toShopPrice(iProductPrice);

             // 운영방식설정 > 회원/비회원 가격표시 설정 반영
             if (sDispNonePrice == 'T') {
                 iTotalPrice = 0;
             } else {
                 $('select[id^="product_option_id"]').each(function() {
                     var iValNo = parseInt($(this).val());

                     if (isNaN(iValNo) === true) {
                         return;
                     }

                     iOptPrice += SHOP_PRICE.toShopPrice(aStockData[iValNo].option_price);
                     sOptionId =  iValNo;

                 });

                 iTotalPrice = iPrdPrice + iOptPrice;
             }

             $('select[id^="' + product_option_id + '"]').each(function() {

                 if (Boolean($(this).attr('required')) === false && $(this).val() === '*') {
                     return true;
                 }
                 aOption.push($(this).val());
             });

             // 전부 선택인 옵션만 있고 선택된 옵션이 없을때
             if ((Olnk.bAllSelectedOption === true || bButton === true) && aOption.length === 0) {
                 bItemSelected = true;
                 sOptionId = sProductCode;
             } else if (ITEM.isOptionSelected(aOption) === true) {
                 bItemSelected = true;
             }

          // 버튼으로 처리 했을때 선택이 모두 되어 있지 않다면 튕겨 내자
             if (bButton === true && bItemSelected === false && aOption.length > 0) {
                 alert(__('필수 옵션을 선택해주세요.'));
                 bResult = false;
             }

             // 추가입력옵션 체크!!
             if (bButton === true && checkAddOption() === false) {
                 bItemSelected = false;
             }

             return {'bResult' : bResult, 'bItemSelected' : bItemSelected, 'aOption' : aOption, 'sOptionId' : sOptionId, 'iTotalPrice' : iTotalPrice};
         },

        /**
         * 최종가격 표시 핸들링 - 상품상세
         */
        handleTotalPrice : function(sOptionStockData, iProductPrice, sDispNonePrice, bButton, iManualQuantity) {
            var aStockData = $.parseJSON(sOptionStockData);
            var sOptionId = '';
            var iTotalPrice = 0;
            var iCnt = 1;
            var sQuantity = '('+sprintf(__('%s개'), iCnt)+')';
            var sPrice = '';

            // 옵션 선택 완료 되었을때 check
            var aOption = new Array();
            var aRequiredData = new Array();
            var sOptionText = '';
            var aOptionText = new Array();
            var bItemSelected = false, bSoldOut = false;
            var iTotalQuantity = 0;

            var aItemSelectInfo = Olnk.getOlnkSelectedItem(aStockData, bButton, sDispNonePrice, iProductPrice);

            bResult = aItemSelectInfo.bResult;
            bItemSelected = aItemSelectInfo.bItemSelected;
            aOption = aItemSelectInfo.aOption;
            if (aItemSelectInfo.sOptionId !== '') {
                sOptionId = aItemSelectInfo.sOptionId;
            }
            iTotalPrice = aItemSelectInfo.iTotalPrice;


            if (bItemSelected === true) {
                var sOptionText   = '';
                var iStockNumber  = aStockData[sOptionId].stock_number;
                var bStock        = aStockData[sOptionId].use_stock;
                var useSoldOut    = aStockData[sOptionId].use_soldout;
                var sIsDisplay    = aStockData[sOptionId].is_display;
                var sIsSelling    = aStockData[sOptionId].is_selling;
                var sIsReserveStat    = aStockData[sOptionId].is_reserve_stat; //예약주문R|Q당일발송

                var iBuyUnit  = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getBuyUnitQuantity('base');
                var iProductMin = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getProductMinQuantity();

                var iQuantity = (iBuyUnit >= iProductMin ? iBuyUnit : iProductMin);
                
                if (typeof(iManualQuantity) !== 'undefined') {
                    iQuantity = iManualQuantity;
                }
                if (sIsSelling == 'F' || ((iStockNumber < buy_unit || iStockNumber <= 0) && ( (bStock === true  && useSoldOut === 'T' ) || sIsDisplay == 'F'))) {
                    bSoldOut = true;
                    sOptionText =  ' <span class="soldOut">['+__('품절')+']</span>';
                }

                if (bSoldOut === true && isNewProductSkin() === false) {
                    alert(__('이 상품은 현재 재고가 부족하여 판매가 잠시 중단되고 있습니다.') + '\n\n' + __('제품명') + ' : ' + product_name );
                    return;
                }

                //( 품절 or 추가메시지)
                if (aReserveStockMessage['show_stock_message'] === 'T' && sIsReserveStat !== 'N') {
                    var sReserveStockMessage = '';
                    bSoldOut = false; //품절 사용 안함

                    sReserveStockMessage = aReserveStockMessage[sIsReserveStat];
                    sReserveStockMessage = sReserveStockMessage.replace(aReserveStockMessage['stock_message_replace_name'], iStockNumber);
                    sOptionText = sOptionText.replace(sReserveStockMessage, '') + ' <span class="soldOut">'+sReserveStockMessage+'</span>';
                }

                // 옵션 선택시 재고 수량이 현재 선택되어진 수량보다 적을 경우 alert처리후에 return합니다.
                $('.option_box_id').each(function(i) {
                    iTotalQuantity += parseInt($('#' + $(this).attr('id').replace('id','quantity')).val());
                });

                if (iTotalQuantity > 0) {
                    iTotalQuantity += iQuantity;
                    if (((iStockNumber < iTotalQuantity || iStockNumber <= 0) && ((bStock === true  && useSoldOut === 'T' ) || sIsDisplay == 'F'))) {
                        alert(__('재고 수량이 부족하여 더이상 옵션을 추가하실 수 없습니다.'));
                        return;
                    }
                }

                sOptionId = '';
                if ((Olnk.bAllSelectedOption === true || bButton === true) && aOption.length === 0) {
                    $('select[id^="' + product_option_id + '"]').each(function() {
                        sSelectedOptionId = $(this).attr('id');
                        sOptionId += $(this).val() + '_'+$(this).attr('option_code') +'||';
                    });
                    aOptionText.push( __('선택한 옵션 없음'));
                } else {
                    $('select[id^="' + product_option_id + '"]').each(function() {
                        if ($(this).attr('required') === false && $(this).val() === '*') {
                            return true;
                        }
                        if (Olnk.getCheckValue($(this).val(),'') === true) {
                            sSelectedOptionId = $(this).attr('id');
                            aOptionText.push( $('#'+sSelectedOptionId+ ' option:selected').text());
                        }
                        sOptionId += $(this).val() + '_'+$(this).attr('option_code') +'||';
                    });
                }

                iProductPrice = getProductPrice(iQuantity, iTotalPrice, sOptionId, bSoldOut, function(iProductPrice){
                    if (isNewProductSkin() === false) {
                        if (sIsDisplayNonmemberPrice == 'T') {
                            $('#span_product_price_text').html(sNonmemberPrice);
                        } else {
                            $('#span_product_price_text').html(SHOP_PRICE_FORMAT.toShopPrice(iProductPrice));
                        }
                    } else {
                        setOptionBox(sOptionId, (aOptionText.join('/')) + ' ' + sOptionText , iProductPrice, bSoldOut, sSelectedOptionId, sIsReserveStat, iManualQuantity);
                    }

                });


            }

        },
        getOlinkOptionKey : function()
        {
            var sOptionId = '';
            $('select[id^="' + product_option_id + '"]').each(function() {
                if ($(this).attr('required') === false && $(this).val() === '*') {
                    return true;
                }
                sOptionId += $(this).val() + '_'+$(this).attr('option_code') +'||';
            });
            return sOptionId;
        },

        /**
         * 장바구니 담기시 필요한 파라미터 생성
         */
        getSelectedItemForBasket : function(sProductCode, oTargets, iQuantity) {
            var options = {};
            var aOptionData ,aOptionTmp;
            var bCheckNum = false;
            oTargets.each(function() {
                aOptionData = {};

                if ($(this).val().indexOf('||') >= 0) {
                    aOptionTmp = $(this).val().split('||');
                    for (i = 0 ; i < aOptionTmp.length ; i++) {
                        if (aOptionTmp[i] !== '') {
                            aOptionData = aOptionTmp[i].split('_');
                        }

                        if (Olnk.getCheckValue(aOptionData[0],'') === true) {
                            options[aOptionData[1]] = aOptionData[0];
                            bCheckNum = true;
                        }
                    }
                } else {
                    var optCode = $(this).attr('option_code');
                    var optValNo = parseInt($(this).val());

                    if (optCode == '' || optCode == null) {
                        return null;
                    }
                    if (isNaN(optValNo) === true) {
                        optValNo = '';
                    }

                    if (optValNo !== '') {
                        options[optCode] = optValNo;
                        bCheckNum = true;
                    }

                }
            });


            return {
                'product_code' : sProductCode,
                'quantity' : iQuantity,
                'options' : options,
                'bCheckNum' : bCheckNum
            };
        },

        /**
         * 관심상품 담기시 필요한 파라미터 생성
         */
        getSelectedItemForWish : function(sProductCode, oTargets) {
            var options = {};
            var bCheckNum = false;

            var aOptionData ,aOptionTmp;
            $(oTargets).each(function() {

                aOptionTmp = $(this).val().split('||');
                aOptionData = {};
                options = {};

                for (i = 0 ; i < aOptionTmp.length ; i++) {
                    if (aOptionTmp[i] !== '') {
                        aOptionData = aOptionTmp[i].split('_');
                    }
                    //if (/^\*+$/.test(aOptionData[0]) === false) {
                    if (Olnk.getCheckValue(aOptionData[0],'') === true) {
                        options[aOptionData[1]] = aOptionData[0];
                        bCheckNum = true;
                    }
                }
            });

            return {
                'product_code' : sProductCode,
                'options' : options,
                'bCheckNum' : bCheckNum
            };
        },

        /**
         * 선택된 품목정보 반환
         * 상품연동형에서는 item_code 가 선택한 옵션을 뜻하지 않으므로
         * 호환성을 위한 모조 값만 할당해준다.
         */
        getMockItemInfo : function(aInfo) {
            var aResult = {
                'product_no' : aInfo.product_no,
                'item_code' : aInfo.product_code + '000A',
                'opt_id' : '000A',
                'opt_str' : ''
            };

            return aResult;
        },

        /**
         * 상품연동형 옵션인지 여부 반환
         */
        isLinkageType : function(sOptionType) {
            if (typeof sOptionType == 'string' && sOptionType == 'E') {
                return true;
            }

            return false;
        },

        /**
         * 상품상세(NewProductAction) 관련 js 스크립트를 보면, create_layer 라는 함수가 있다.
         * 해당 함수는 ajax 콜을 해서 레이어 팝업으로 띄울 소스코드를 불러오게 되는데, 이때 스크립트 태그도 같이 따라온다.
         * 해당 스크립트 태그에서 불러오는 js 파일내부에는 동일한 jquery 코드가 다시한번 오버라이딩이 되는데
         * 이렇게 되면 기존에 물려있던 extension 메소드들은 초기화되어 날아가게 된다.
         *
         * 레이어 팝업이 뜨고 나서, $ 내에 존재해야할 메소드나 멤버변수들이 사라졌다면 이와 같은 현상때문이다.
         * 가장 이상적인 처리는 스크립트 태그를 없애는게 가장 좋으나 호출되는 스크립트에 의존적인 코드가 존재하는것으로 보인다.
         * 해당영역이 완전히 파악되기 전까진 필요한 부분에서만 예외적으로 동작할 수 있도록 한다.
         */
        bugfixCreateLayerForWish : function() {
            var __nil = jQuery.noConflict(true);
        },

        /**
         * 장바구니 담기시 필요한 파라미터를 일부 조작
         */
        hookParamForBasket : function(aParam, aInfo) {
            if (aInfo.option_type != 'E') {
                return aParam;
            }

            var aItemCode = this.getSelectedItemForBasket(aInfo.product_code, aInfo.targets, aInfo.quantity);

            aParam['item_code_before'] = '';
            aParam['option_type'] = 'E';
            aParam['selected_item_by_etype[]'] = $.toJSON(aItemCode);

            return aParam;
        },

        /**
         * 관심상품 담기시 필요한 파라미터를 일부 조작
         */
        hookParamForWish : function(aParam, aInfo) {
            if (aInfo.option_type != 'E') {
                return aParam;
            }

            var aItemCode = {};

            //
            // aInfo.targets 는 구스킨을 사용했을 때 출력되는 옵션 셀렉트 박스의 엘리먼트 객체인데,
            // 현재 뉴스킨과 구스킨 구분을 아이디값이 wishlist_option_modify_layer_ 에 해당되는 노드가
            // 있는지로 판별하기 때문에 모호함이 존재한다.
            // 즉, 뉴스킨을 사용해도 해당 노드가 존재하지 않는 조건이 발생할 수 있기 때문이다.
            // 예를 들면, 관심상품상에 담긴 리스트가 모두 옵션이 없는 상품만 있는 경우이거나 아니면
            // 옵션이 존재하지만 아무것도 선택되지 않은 상품인 경우 발견이 되지 않을 수 있다.
            // 그러므로 이런 경우엔 셀렉트박스를 통해 선택된 옵션을 파악하는 것이 아니라,
            // 현재 할당되어 있는 데이터를 기준으로 파라미터를 세팅하도록 한다.
            //
            if (aInfo.targets.length > 0) {
                aItemCode = this.getSelectedItemForBasket(aInfo.product_code, aInfo.targets, aInfo.quantity);
            } else {
                aItemCode = aInfo.selected_item_by_etype;
            }

            aParam.push('option_type=E');
            aParam.push('selected_item_by_etype[]=' + $.toJSON(aItemCode));

            return aParam;
        },
        /**
         * 장바구니 담기시 필요한 파라미터 생성 - 구스킨 전용 뉴스킨 사용안함.
         */
        getSelectedItemForBasketOldSkin : function(sProductCode, oTargets, iQuantity) {
            var options   = {};
            var optCode   = '';
            var optValNo  = '';
            var bCheckNum = false;
            oTargets.each(function() {
                optCode = $(this).attr('option_code');
                optValNo = parseInt($(this).val());

                if (optCode == '' || optCode == null) {
                    return null;
                }

                if (isNaN(optValNo) === false) {
                    options[optCode] = $(this).val();
                    bCheckNum = true;
                }
            });

            return {
                'product_code' : sProductCode,
                'quantity' : iQuantity,
                'options' : options,
                'bCheckNum' : bCheckNum
            };
        },
        /**
         * 관심상품 담기시 필요한 파라미터 생성
         */
        getSelectedItemForWishOldSkin : function(sProductCode, oTargets) {
            var options = {};
            var isReturn = true;
            var bCheckNum = false;
            oTargets.each(function() {
                if (isReturn === false) {
                    isReturn = false;
                    return;
                }

                var optCode = $(this).attr('option_code');
                var optValNo = parseInt($(this).val());

                //
                // 필수입력값 체크
                //
                if (Boolean($(this).attr('required')) === true) {
                    if (isNaN(optValNo) === true) {
                        isReturn = false;
                        return false;
                    }
                }

                if (optCode == '' || optCode == null) {
                    isReturn = false;
                    return;
                }

                if (isNaN(optValNo) === false) {
                    options[optCode] = optValNo;
                    bCheckNum = true;
                }
            });

            if (isReturn === true) {
                return {
                    'product_code' : sProductCode,
                    'options' : options,
                    'bCheckNum' : bCheckNum
                };
            }

            return false;
        },

        /*
         * 상단 옵션 선택후 alert후 옵션 재세팅 ( 상위 옵션이 재 세팅되면 해당 옵션에 하단 옵션들은 reset)
         */
        getOptionCheckData : function(oTarget) {
            //if ((/^\*+$/.test(oTarget.val()) === true && Boolean(oTarget.attr('required')) === true) || oTarget.attr('id') === undefined) {
            if ((Olnk.getCheckValue(oTarget.val(),'') === false && Boolean(oTarget.attr('required')) === true) || oTarget.attr('id') === undefined) {
                return false;
            }

            return true;
        },
        /**
         * 재고 체크 ( 구스킨에서 action시에 필요함.
         * 각각의 수량을 전부 합치고 그 합친 수량과 재고 체크
         * @param sOptionId 옵션 id
         * @returns 품절여부
         */
        getStockValidate : function (sOptionId , iQuantity) {
            var aStockData = $.parseJSON(option_stock_data);
            var bSoldOut = false;
            var iStockNumber , bStock , bStockSoldOut;
            // get_stock_info
            if (aStockData[sOptionId] == undefined) {
                iStockNumber  = -1;
                bStock        = false;
                bStockSoldOut = 'F';
            } else {
                iStockNumber  = aStockData[sOptionId].stock_number;
                bStock        = aStockData[sOptionId].use_stock;
                bStockSoldOut = aStockData[sOptionId].use_soldout;

            }
            if (bStockSoldOut == 'T' && bStock === true && (iStockNumber < iQuantity)) {
                bSoldOut = true;
            }
            return bSoldOut;
        },
        /*
         * check value
         */
        getCheckValue : function (oTargetValue , oTarget) {
            if (/^\*+$/.test(oTargetValue) === true) {
                if (oTarget !== '') {
                    oTarget.val('*');
                }
                return false;
            }
            return true;
        },
        /*
         * 추가 구성상품의 재고 체크
         * @param aOptionBoxInfo 추가 구성상품 데이터
         */
        getAddProductStock : function (aOptionBoxInfo) {
            var iTotalQuantity = aOptionBoxInfo['iTotalQuantity'];
            if (this.isLinkageType(aOptionBoxInfo['option_type']) === true) {
                $('.option_add_box_'+aOptionBoxInfo['product_no']).each(function() {
                    // 수량 증가시 본인꺼는 빼야 한다..
                    if (aOptionBoxInfo['sOptionBoxId'] !== $(this).attr('id')) {
                        iTotalQuantity += parseInt(iQuantity = $('#' + $(this).attr('id').replace('id','quantity')).val());
                    }

                });
                if (aOptionBoxInfo['is_stock'] === true && aOptionBoxInfo['use_soldout'] === true && aOptionBoxInfo['stock_number'] < iTotalQuantity) {
                    alert(sprintf(__('%s 의 재고가 부족합니다.'), aOptionBoxInfo['title']));
                    //alert(aOptionBoxInfo['title'] + ' - ' + __('의 재고가 부족합니다.'));
                    return false;
                }
            }
        },
        /*
         * 모든 상품의 옵션이 선택일때 옵션박스가 떨궈지지 않았을 경우 (아무것도 선택안하면 option_box 안생김)
         * @param aOptionBoxInfo 추가 구성상품 데이터
         */
        getProductAllSelected : function (sProductCode, oTargets, iQuantity) {
            var bAllSelected = true;
            var options = {};
            oTargets.each(function(i) {
                if ($(this).val().indexOf('||') >= 0) {
                    aOptionTmp = $(this).val().split('||');
                    for (i = 0 ; i < aOptionTmp.length ; i++) {
                        if (aOptionTmp[i] !== '') {
                            aOptionData = aOptionTmp[i].split('_');
                        }
                        options[aOptionData[1]] = '';
                    }
                } else {
                    if (Boolean($(this).attr('required')) === true || Olnk.getCheckValue($(this).val() , '') === true) {
                        bAllSelected = false;
                        return false;
                    }
                    var optCode  = $(this).attr('option_code');
                    var optValNo = parseInt($(this).val());

                    if (optCode == '' || optCode == null) {
                        return null;
                    }
                    if (isNaN(optValNo) === true) {
                        optValNo = '';
                    }
                    options[optCode] = optValNo;
                }
            });

            if (bAllSelected === true) {
                return {
                    'product_code' : sProductCode,
                    'quantity' : iQuantity,
                    'options' : options
                };
            } else {
                return false;
            }

        },

        /*
         * 옵션 추가버튼 ( 신규 스킨의 연동형 옵션일때 품목 추가 버튼 생김)
         * totalProducts가 있을때 신규 스킨
         * ( NewProductOption.js에 isNewProductSkin이 있지만 의존적 처리가 어려움)
         * oPushButton 품목 추가 버튼 Object
         */
        getOptionPushbutton : function(oPushButton) {
            if (typeof(option_push_button) !== 'undefined' && option_push_button === 'T' &&  oPushButton.size() >  0  && isNewProductSkin() === true) {
                return true;
            } else {
                return false;
            }

        },

        /*
         * 옵션 추가버튼 action. php 에서 assign된 함수
         */
        setOptionPushButton : function(){
            Olnk.handleTotalPrice(option_stock_data, product_price, sIsDisplayNonmemberPrice , true);
        },
        /**
         * 옵션 추가 버튼 연동형 옵션인 경우에만 동작 하자.(이건 추가구성상품)
         * @param iProductNum 상품번호
         */
        setAddOptionPushButton : function(iProductNum) {
            ProductAdd.setAddProductOptionPushButton(iProductNum);
        },
        setSetOptionPushButton : function(iProductNum) {
            ProductSet.setSetProductOptionPushButton(iProductNum);
        }
    };

    //
    // 공개 인터페이스
    //
    window['Olnk'] = $Olnk;

})($);


/**
 * 품절품목일 경우 품절 문구에대한 처리
 */
var EC_SHOP_FRONT_NEW_OPTION_EXTRA_SOLDOUT = {
    /**
     * 품절문구 설정 정보
     */
    aSoldoutText : null,

    /**
     * 필수 메서드
     * @param iProductNum 상품번호
     * @param sItemCode 품목코드
     * @returns 설정에따라 품절문구 리턴
     * @final
     */
    get : function(iProductNum, sItemCode) {
        return this.getStockText(iProductNum, sItemCode);
    },

    /**
     * 품절문구 설정(기존로직 그대로
     * @param iProductNum 상품번호
     * @returns 해당 상품의 품절 설정 문구
     */
    getSoldoutDiplayText: function (iProductNum) {
        if (typeof(aSoldoutDisplay) === 'undefined') {
            return EC_SHOP_FRONT_NEW_OPTION_CONS.OPTION_SOLDOUT_DEFAULT_TEXT;
        }

        if (this.aSoldoutText === null) {
            if (typeof(aSoldoutDisplay) === 'string') {
                this.aSoldoutText = $.parseJSON(aSoldoutDisplay);
            } else {
                this.aSoldoutText = aSoldoutDisplay;
            }
        }

        if (typeof(this.aSoldoutText[iProductNum]) === 'undefined') {
            this.aSoldoutText[iProductNum] = EC_SHOP_FRONT_NEW_OPTION_CONS.OPTION_SOLDOUT_DEFAULT_TEXT;
        }

        return this.aSoldoutText[iProductNum];
    },

    /**
     * 해당 품목이 품목일 경우 표시될 품절표시 Text
     * @param iProductNum 상품번호
     * @param sItemCode 아이템코드
     * @returns 표시될 품절문구
     */
    getStockText : function(iProductNum, sItemCode) {
        var sSoldoutText = '';
        var bIsSoldout = EC_SHOP_FRONT_NEW_OPTION_COMMON.isSoldout(iProductNum, sItemCode);

        if (bIsSoldout === true) {
            sSoldoutText = ' [' + this.getSoldoutDiplayText(iProductNum) + ']';
        }

        if (typeof(aReserveStockMessage) === 'undefined') {
            return sSoldoutText;
        }

        var aStockData = EC_SHOP_FRONT_NEW_OPTION_COMMON.getProductStockData(iProductNum);

        if (typeof(aStockData[sItemCode]) === 'undefined') {
            return sSoldoutText;
        }

        if (aStockData[sItemCode].is_reserve_stat !== 'N') {
            sSoldoutText = aReserveStockMessage[aStockData[sItemCode].is_reserve_stat];
            sSoldoutText = sSoldoutText.replace(aReserveStockMessage['stock_message_replace_name'], aStockData[sItemCode].stock_number);
        }

        return sSoldoutText;
    }
};

/**
 * 해당 품목에 대한 추가금액 표시여부
 */
var EC_SHOP_FRONT_NEW_OPTION_EXTRA_PRICE = {
    /**
     * 추가금액 표시여부 설정
     */
    aOptionPriceDisplayConf : [],

    oChooseObject : null,

    /**
     * 필수 메서드
     * @param iProductNum 상품번호
     * @param sItemCode 품목코드
     * @param eChooseObject 현재 선택한 옵션 Object
     * @returns 설정에따라 표시할 경우 품목의 추가금액 리턴
     * @final
     */
    get : function(iProductNum, sItemCode, eChooseObject) {
        this.oChooseObject = eChooseObject;
        return this.getAddPriceText(iProductNum, sItemCode);
    },

    /**
     * 각 옵션선택시마다 실행되는 가격관련 메서드
     * @param oOptionChoose 구분할 옵션박스 object
     * @returns bool
     */
    eachCallback : function(oOptionChoose) {
        //구스킨에서 옵션선택시마다 표시항목 판매가부분의 가격에 옵션추가듬액 계산
        this.setDisplayProductPriceForOldSkin(oOptionChoose);
    },

    /**
     * 구스킨에서 옵션선택시마다 표시항목 판매가부분의 가격에 옵션추가듬액 계산
     * @param oOptionChoose 구분할 옵션박스 object
     */
    setDisplayProductPriceForOldSkin : function(oOptionChoose) {
        //뉴스킨이라면 패스 (ECHOSTING-241102 모바일 관심상품리스트 오류)
        if ($('#totalProducts').length > 0) {
            return;
        }

        //해당 function이 존재할때만 실행
        if (typeof(setOldTotalPrice) !== 'function') {
            return;
        }

        var sID = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionChooseID(oOptionChoose);

        //상품상세 메인상품에 대해서만 실행
        if (/^product_option_id+/.test(sID) !== true) {
            return;
        }

        //구스킨일 경우 각 옵션선택시마다 실행
        try {
            setOldTotalPrice();
        } catch(e) {
            EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(oOptionChoose, '*');
        }
    },

    /**
     * 옵션 추가금액에대한 Display텍스트
     * @param iProductNum 상품번호
     * @param sItemCode 품목코드
     * @returns 옵션 추가금액 Text
     */
    getAddPriceText : function(iProductNum, sItemCode) {
        //추가금액 표시여부
        var bIsDisplayOptionPrice = this.getOptionPriceDisplay(iProductNum);

        if (bIsDisplayOptionPrice === false) {
            return '';
        }

        var iAddPrice = this.getAddPrice(iProductNum, sItemCode);

        if (iAddPrice !== false) {
            var sPrefix = '';
            if (iAddPrice > 0.00) {
                sPrefix = '+';
            } else {
                sPrefix = '-';
            }

            //화폐단위가 +- 기호 뒤에와야해서 여기서 양수로 바꿈
            iAddPrice = Math.abs(iAddPrice);

            var sStr =  ' (' + sPrefix + SHOP_PRICE_FORMAT.toShopPrice(iAddPrice) + ')';
            //그냥 값을 더할경우 원표시(\)가 &#8361;로 변환되어서 clone으로 다시가져오게 처리
            return $('<div>').append(sStr).html();
        }

        return '';
    },

    /**
     * 해당 품목의 추가금액을 가져온다(없을 경우에는 false를 리턴
     * @param iProductNum 상품번호
     * @param sItemCode 품목코드
     * @returns 추가금액
     */
    getAddPrice : function(iProductNum, sItemCode) {
        var aStockData = EC_SHOP_FRONT_NEW_OPTION_COMMON.getProductStockData(iProductNum);
        if (typeof(aStockData[sItemCode].stock_price) !== 'undefined' && parseFloat(aStockData[sItemCode].stock_price) !== 0.00) {
            return parseFloat(aStockData[sItemCode].stock_price);
        }

        return false;
    },

    /**
     * 옵션 추가금액 표시여부 설정
     * @param iProductNum 상품번호
     * @returns 표시여부
     */
    getOptionPriceDisplay : function(iProductNum) {
        if (typeof(EC_SHOP_FRONT_NEW_OPTION_DATA.aOptionPriceDisplayConf[iProductNum]) === 'undefined') {
            return 'T';
        }

        return (EC_SHOP_FRONT_NEW_OPTION_DATA.aOptionPriceDisplayConf[iProductNum] === 'T');
    }
};

/**
 * 옵션 선택 또는 품목선택완료시 상세이미지 변경
 */
var EC_SHOP_FRONT_NEW_OPTION_EXTRA_IMAGE = {
    /**
     * 모바일과 상세이미지 클래스가 틀려서
     */
    sDetailImageClass : '',

    /**
     * 세트상품의 이미지 영역
     */
    sSetProductImageID : '',

    /**
     * 스와이프기능을 사용하는 상품상세인지 확인(모바일전용)
     */
    isSwipe : false,

    /**
     * 세트상품인지 여부
     */
    bIsSetProduct : false,

    /**
     * 각 옵션선택시마다 이미지가 있다면 상세이미지에 반영되도록 함
     * @param oOptionChoose 구분할 옵션박스 object
     * @returns null
     */
    eachCallback : function(oOptionChoose) {
        this.bIsSetProduct = false;

        //세트상품일 경우에 대한 처리
        if (/^setproduct_option_+/.test(EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectGroup(oOptionChoose)) === true) {
            this.bIsSetProduct = true;
            this.sSetProductImageID = '#ec-set-product-composed-product-';
        }

        if (/^addproduct_option_+/.test(EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectGroup(oOptionChoose)) === true) {
            this.bIsSetProduct = true;
            this.sSetProductImageID = '#ec-add-product-composed-product-';
        }

        if (this.isDisplayImage(oOptionChoose) === false) {
            return;
        }

        var oSelectedOption = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectedElement(oOptionChoose);

        if (typeof(oSelectedOption.attr('link_image')) === 'undefined' || oSelectedOption.attr('link_image').length < 1) {
            return;
        }

        this.setImage(oSelectedOption.attr('link_image'), true, oOptionChoose);
    },

    /**
     * 옵션 전체 선택완료후 해당 옵션품목에 연결된 이미지를 상세이미지에 반영되도록 함
     * @todo 이거 아직 안했어여 ㅠㅠ
     * @param oOptionChoose 구분할 옵션박스 object
     * @returns null
     */
    completeCallback : function(oOptionChoose) {
        //연동형은 제외
        if (Olnk.isLinkageType(EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionType(oOptionChoose)) === true) {
            return ;
        }

        if (this.isDisplayImage(oOptionChoose) === false) {
            return;
        }

        var sItemCode = EC_SHOP_FRONT_NEW_OPTION_COMMON.getItemCode(oOptionChoose);

        if (sItemCode === false) {
            return;
        }

        var iProductNo = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionProductNum(oOptionChoose);

        var aStockData = EC_SHOP_FRONT_NEW_OPTION_DATA.getProductStockData(iProductNo);

        if (typeof(aStockData[sItemCode].item_image_file) !== 'undefined' && $.trim(aStockData[sItemCode].item_image_file) !== '') {
            this.setImage(aStockData[sItemCode].item_image_file, false, oOptionChoose);
        }
    },

    /**
     * 이미지 출력이 가능한지 확인
     */
    isDisplayImage : function(oOptionChoose) {
        var sOptionGroup = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectGroup(oOptionChoose);
        //세트상품일 경우에 대한 처리
        if (this.bIsSetProduct === true) {
            return this.isDisplayImageDesignForSetProduct(EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionProductNum(oOptionChoose));
        } else {
            //추가구성상품등은 모두 제외하고 상품상세의 대표상품만 변경
            return this.isDisplayImageDesign();
        }

        return false;

    },

    /**
     * 세트상품에서 구성상품의 옵션선택시 이미비 변경 가능여부
     * @param iProductNum 상품번호
     * @returns {boolean}
     */
    isDisplayImageDesignForSetProduct : function(iProductNum)
    {
        var oSetProductImageElement = $(this.sSetProductImageID + iProductNum);

        //해당 구성상품의 이미지영역이 없거나 id가 지정되지 않았으면 false
        if (oSetProductImageElement.length < 1) {
            return false;
        }

        return true;
    },

    /**
     * 디자인에서 이미지가 노출될수있는 디자인인지 확인
     * 상품상세에서 동일하게 사용하기위해서 따로 메서드로 분리
     * @returns {boolean}
     */
    isDisplayImageDesign : function()
    {
        var isMobile = false;
        if (typeof(mobileWeb) !== 'undefined' && mobileWeb === true) {
            isMobile = true;
            this.sDetailImageClass = '.bigImage';
        } else {
            this.sDetailImageClass = '.BigImage';
        }

        if (isMobile === true) {
            if ($('.xans-product-mobileimage').length > 0) {
                this.isSwipe = true;
            }
        }

        //상세이미지가 없다면 패스
        if (this.isSwipe === false && $(this.sDetailImageClass).length < 1) {
            return false;
        }

        return true;
    },

    /**
     * 각 디자인에 따라 옵션 도는 품목이미지를 상세이미지에 노출
     * @param sUrl 이미지주소
     * @param isOptionFlag 각 옵션의 이미지가 아닌 모든옵션 선택후 품목의 이미지이면 false
     */
    setImage : function(sUrl, isOptionFlag, oOptionChoose)
    {
        if (this.bIsSetProduct === true) {
            $(this.sSetProductImageID + EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionProductNum(oOptionChoose)).attr('src', sUrl);
        } else {
            //스와이프기능을 사용할때
            if (this.isSwipe === true) {
                if (isOptionFlag === false) {
                    //모든 옵션 선택후 품목에 연결이미지
                    this.setSwipeImage(sUrl, false);
                } else {
                    //각 업션에 대한 옵션이미지
                    this.setSwipeImage('', true);

                    var iIndex = $('div.xans-product-mobileimage').find('li img[src="' + sUrl + '"]').parent().index();
                    $('div.typeSwipe').find('span > button:eq(' + iIndex + ')').trigger('click');
                }
            } else {
                //스와이프기능을 사용안할때
                $(this.sDetailImageClass).attr('src', sUrl);
            }
        }
    },

    /**
     * 모바일 상품상세에서 스와이프 사용중일때
     * 각 옵션의 연결이미지는 기존스와이프 영역으로
     * 각 품목의 연결이미지는 원래 대표이미지 영역이 나오도록 함
     * @param sSrc 해당 이미지 주소(품목 연결이미지일떄만)
     * @param bIsShowSlide true => 각 옵션별 연결이미지, false => 각 품목별 연결이미지
     */
    setSwipeImage : function(sSrc, bIsShowSlide, iButtonIndex)
    {
        if (bIsShowSlide === true) {
            $('div.xans-product-mobileimage').find('ul.eOptionImageCloneTemplate').remove();
            $('div.xans-product-mobileimage').find('ul').show();

            //품목이미지가 노출된후 다시 슬라이드버튼을 누르때 시간차로인대 css가 먹지 않아서 추가
            if (typeof(iButtonIndex) !== 'undefined') {
                $('div.typeSwipe').find('span > button:eq('+iButtonIndex+')').addClass('selected');
            }
        } else {

            //첫번째 이미지를 기준으로 height가 정해지기때문에
            //두번째 이미지에 할당함 ㅋ
            $('div.typeSwipe').find('span > button:eq(1)').trigger('click');
            var oClone = $('div.xans-product-mobileimage').find('ul').clone();
            oClone.addClass('eOptionImageCloneTemplate');

            //추가이미지가 1개만 있을경우에는 따로 삭제하지 않음
            //추가이미지가 하개이면 버튼이 원래 두개이므로 따로 삭제하지 않아도 됨
            if ($('div.typeSwipe').find('span > button').length > 2) {
                oClone.find('li').not('li:eq(0)').not('li:eq(1)').remove();
            }
            oClone.find('li:eq(1)').find('img').attr('src', sSrc);

            $('div.typeSwipe').find('span > button').removeClass('selected');

            $('div.xans-product-mobileimage').find('ul').hide();

            $('div.xans-product-mobileimage').find('ul:eq(0)').before(oClone);
        }
    }
};

/**
 * 버튼 또는 미리보기 옵션일 경우 지정된 엘리먼트에 선택한 옵션값 보여주기
 */
var EC_SHOP_FRONT_NEW_OPTION_EXTRA_DISPLAYITEM = {
    TARGET_ELEMENT_CLASS : '.ec-shop-front-product-option-desc-trigger',
    /**
     * 각 옵션선택시마다 이미지가 있다면 상세이미지에 반영되도록 함
     * @param oOptionChoose 구분할 옵션박스 object
     * @returns null
     */
    eachCallback : function(oOptionChoose) {
        //버튼 또는 미리보기 옵션이 아니면 리턴
        if (EC_SHOP_FRONT_NEW_OPTION_COMMON.isOptionStyleButton(oOptionChoose) === false) {
            return;
        }

        //셀렉터에 ""를 안붙이면 가끔 특정상횡에서 스크립트오류
        var oTarget = $(oOptionChoose).closest('.xans-element- .xans-product').find("" + this.TARGET_ELEMENT_CLASS + "");

        //디자인이 없다면 패스
        if ($(oTarget).length < 1) {
            return;
        }

        var sText = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectedText(oOptionChoose);

        //선택항목에 text가 있다면
        //추후에 셀렉트박스가 추가된다면... *나 **가 선택되었다면 예외처리해야함
        if (typeof(sText) !== 'undefined' && $.trim(sText) !== '') {
            $(oTarget).removeClass('ec-product-value').addClass('ec-product-value');
            $(oTarget).html(sText);
        } else {
            $(oTarget).removeClass('ec-product-value');
            $(oTarget).html($(oTarget).attr('data-option_msg'));
        }
    }
};
var EC_SHOP_FRONT_NEW_OPTION_EXTRA_ITEMSELECTION =
{
    oCommon : null,
    initObject : function()
    {
        if (this.oCommon !== null) {
            return;
        }
        this.oCommon = EC_SHOP_FRONT_NEW_OPTION_COMMON;
    },
    sOptionKey : null,
    prefetech : function(oOptionChoose)
    {
        this.initObject();

        if (oSingleSelection.isItemSelectionTypeM() === true) {
            return;
        }

        // 동일한 키로 선택된 상품이 없다면 prefetch는 할일이 없음
        var oTarget = this.getDeleteTriggerElement(oOptionChoose);
        if (oTarget.size() === 0) {
            return;
        }

        if (this.oCommon.getOptionType(oOptionChoose) === 'F') {
            return this.prefetchOptionTypeF(oOptionChoose);
        }

        if (this.oCommon.getOptionType(oOptionChoose) === 'E') {
            return this.prefetchOptionTypeE(oOptionChoose);
        }

        oTarget.click();
    },
    prefetchOptionTypeE : function(oOptionChoose)
    {
        var sOptionGroup = this.oCommon.getOptionSelectGroup(oOptionChoose);
        if (sOptionGroup.indexOf('setproduct') < 0) {
            this.getDeleteTriggerElement(oOptionChoose).click();
            return;
        }
        var oTarget = this.getDeleteTriggerElement(oOptionChoose);

        var sOptionId = oTarget.attr('id').substring(0, oTarget.attr('id').lastIndexOf('_'));
        var sOptionKey = $('#'+sOptionId+'_id').val();
        this.sOptionKey = sOptionKey;

        var sContext = this.getDeleteTriggerContext(oOptionChoose);
        $(sContext).remove();

        this.hookIndividualSetProductParameter(sOptionKey);
    },
    prefetchOptionTypeF : function(oOptionChoose)
    {
        var sOptionGroup = this.oCommon.getOptionSelectGroup(oOptionChoose);
        var oTarget = this.getDeleteTriggerElement(oOptionChoose);
        var sOptionId = oTarget.attr('id').substring(0, oTarget.attr('id').lastIndexOf('_'));
        var sOptionKey = $('#'+sOptionId+'_id').val();
        this.sOptionKey = sOptionKey;

        // 추가구성상품
        if (sOptionGroup.indexOf('addproduct') > -1) {
            var aOptionInfo = $('#'+sOptionId+'_id').val().split('||');
            sOptionKey = aOptionInfo[0];
            this.sOptionKey = sOptionKey;
            ProductAdd.delOptionBoxData(sOptionKey);
        }

        // 일반상품, 추가구성상품 동일
        TotalAddSale.removeProductData(sOptionKey);

        // 세트상품
        if (sOptionGroup.indexOf('setproduct') > -1) {
            this.hookIndividualSetProductParameter(sOptionKey);
        }
    },
    eachCallback : function(oOptionChoose)
    {
        if (oSingleSelection.isItemSelectionTypeM() === true) {
            return;
        }
        var sOptionType = this.oCommon.getOptionType(oOptionChoose);

        if (sOptionType === 'F') {
            return this.eachCallbackOptionTypeF(oOptionChoose);
        }
        if (sOptionType === 'E') {
            return this.eachCallbackOptionTypeE(oOptionChoose);
        }
    },
    eachCallbackOptionTypeE : function(oOptionChoose)
    {
        // 뭔가 값이 선택됐을때는 원래 돌던대로 돌린다
        if (this.oCommon.getOptionSelectedValue(oOptionChoose) !== '*') {
            return;
        }
        var sOptionGroup = this.oCommon.getOptionSelectGroup(oOptionChoose);
        // 선택한 값이 취소된 경우에만 이 로직을 실행한다
        // 모두 선택인 경우에는 하나라도 선택되었는지
        if (this.oCommon.validation.checkRequiredOption(sOptionGroup) === false) {
            bIsSelectedRequiredOption = this.oCommon.validation.isOptionSelected(oOptionChoose);
        } else {
            bIsSelectedRequiredOption = this.oCommon.validation.isSelectedRequiredOption(sOptionGroup);
        }
        // 뭔가 하나 선택되어있는 경우
        if (this.oCommon.getItemCode(oOptionChoose) === false && bIsSelectedRequiredOption === true) {
            var oOptionGroup = this.oCommon.getOptionLastSelectedElement(sOptionGroup);
            if (sOptionGroup.indexOf('addproduct') > -1) {
                var iProductNum = this.oCommon.getOptionProductNum(oOptionChoose);
                if (this.oCommon.isOptionStyleButton(oOptionChoose) === true) {
                    ProductAdd.setAddProductOptionPushButton(iProductNum);
                }
            } else {
                if (typeof(ProductSet) === 'object') {
                    if (this.oCommon.isOptionStyleButton(oOptionGroup) === true) {
                        var oOptionGroup = $('select[product_option_area_select="' + $(oOptionGroup).attr('product_option_area') + '"][id="' + $(oOptionGroup).attr('ec-dev-id') + '"]');
                    }
                    oSingleSelection.setProductTargetKey(oOptionGroup, 'setproduct');
                    ProductSet.procOptionBox(oOptionGroup);
                } else {
                    if (typeof(setPrice) === 'function') {
                        var sID = this.oCommon.getOptionChooseID(oOptionGroup);
                        setPrice(false, true, sID);
                    }
                }
            }
        } else {
            if (sOptionGroup.indexOf('setproduct') === -1) {
                return;
            }
            this.hookIndividualSetProductParameter(this.sOptionKey);
            if (Object.keys(ProductSet.getSetIndividualList()).length > 0) {
                TotalAddSale.getCalculatorSalePrice(ProductSet.setTotalPrice);
            }
        }
    },
    hookIndividualSetProductParameter : function(sOptionKey)
    {
        ProductSet.delOptionBoxData(sOptionKey);
        // 분리세트 상품 코드 삭제
        var oSetIndividualList = ProductSet.getSetIndividualList();
        delete oSetIndividualList[sOptionKey];
        TotalAddSale.setParam('unit_set_product_no', oSetIndividualList);

        // 할인 금액 품목 코드 삭제
        TotalAddSale.removeProductData(sOptionKey);

        // 아무 옵션이 없는 경우
        if (Object.keys(oSetIndividualList).length === 0) {
            TotalAddSale.setParam('product', oProductList);
            TotalAddSale.setTotalAddSalePrice(0);
            ProductSet.setTotalPrice();
        } else {
            var aProductNo = [];
            for (var i = 0 ; i < Object.keys(oSetIndividualList).length ; i++) {
                var iProductNum = oSetIndividualList[Object.keys(oSetIndividualList)[i]];
                if (aProductNo.indexOf(iProductNum) === -1) {
                    aProductNo.push(iProductNum);
                }
            };
            if (aProductNo.length === 1) {
                TotalAddSale.setParam('product_no', aProductNo[0]);
                TotalAddSale.setParam('is_set', false);
            } else {
                TotalAddSale.setParam('product_no', iProductNo);
                TotalAddSale.setParam('is_set', true);
            }
        }

    },
    eachCallbackOptionTypeF : function(oOptionChoose)
    {
        if (this.oCommon.getOptionSelectedValue(oOptionChoose) === '*') {
            var oTarget = this.getDeleteTriggerElement(oOptionChoose);
            // 옵션이 실제로 취소되었음
            oTarget.click();
        } else {
            // 다른 옵션으로 변경되었음 - 삭제 액션이 아니라 삭제된거처럼 만들어야함
            var sContext = this.getDeleteTriggerContext(oOptionChoose);
            $(sContext).remove();
        }
        return true;
    },
    getDeleteTriggerElement : function(oOptionChoose)
    {
        var sSelector = this.getDeleteTriggerSelector(oOptionChoose);
        var sContext = this.getDeleteTriggerContext(oOptionChoose);

        return $(sSelector, sContext);
    },
    getTargetKey : function(oOptionChoose)
    {
        // 기본상품(옵션없는 상품, 조합형옵션 상품, 연동형 옵션 상품, 일체형 세트상품) : 상품번호
        // 독립형 옵션 상품 : 상품번호|옵션순서
        // 분리세트 상품 : 구성상품번호|세트상품번호
        // 분리세트상품의 독립형 옵션 상품 : 구성상품번호|세트상품번호|옵션순서
        var sTargetKey = this.oCommon.getOptionProductNum(oOptionChoose);
        var sOptionGroup = this.oCommon.getOptionSelectGroup(oOptionChoose);
        if (sOptionGroup.indexOf('setproduct') > -1) {
            if (sSetProductType === 'S') {
                sTargetKey =  sTargetKey + '|' + iProductNo
            } else {
                sTargetKey = iProductNo;
            }
        }
        if (this.oCommon.getOptionType(oOptionChoose) === 'F') {
            sTargetKey = sTargetKey + '|' + this.oCommon.getOptionSortNum(oOptionChoose);
        }
        return sTargetKey;

    },
    getDeleteTriggerContext : function(oOptionChoose)
    {
        var sOptionGroup = this.oCommon.getOptionSelectGroup(oOptionChoose);
        var sContext = 'tr.add_product';
        if (sOptionGroup.indexOf('addproduct') < 0) {
            sContext = 'tr.option_product';
        }
        var sTargetKey = this.getTargetKey(oOptionChoose);
        return sContext+'[target-key='+sTargetKey+']';
    },
    getDeleteTriggerSelector : function(oOptionChoose)
    {
        var sOptionGroup = this.oCommon.getOptionSelectGroup(oOptionChoose);
        var sSelector = '.option_add_box_del';
        if (sOptionGroup.indexOf('addproduct') < 0) {
            sSelector = '.option_box_del';
        }
        return sSelector;
    }
};

var oSingleSelection = function()
{
    var sProductTargetKey = null;
    var sSingleQuantityInputSelector = 'input.single-quantity-input';
    var sIndexKey = '#PRODUCTNUM#';
    var sSingleObjectName = 'oSingleItemData['+sIndexKey+']';

    var getTotalPriceSelector = function()
    {
        return $('#totalProducts .total:visible').size() > 0 ? '#totalProducts .total' : '.xans-product-detail #totalPrice .total, .xans-product-zoom #totalPrice .total';
    };

    var isItemSelectionTypeS = function()
    {
        return $(sSingleQuantityInputSelector).filter(':visible').size() > 0;
    };

    var isItemSelectionTypeM = function()
    {
        return $(sSingleQuantityInputSelector).filter(':visible').size() === 0;
    };

    var getProductNum = function(oQuantityObject)
    {
        if ($(oQuantityObject).hasClass('single-quantity-input') === true) {
            return parseInt($(oQuantityObject).attr('product-no'), 10);
        }
        if ($(oQuantityObject).attr('product-no')) {
            return $(oQuantityObject).attr('product-no');
        }
        var sProductNumClass = $.grep($(oQuantityObject).attr('class').split(' '), function(sClassName,i) {
            return $.trim(sClassName).indexOf('product-no-') === 0;
        })[0];
        return parseInt(sProductNumClass.replace('product-no-', ''), 10);
    };

    var getOptionSequenceNum = function(oQuantityObject)
    {
        if ($(oQuantityObject).hasClass('single-quantity-input') === true) {
            return parseInt($(oQuantityObject).attr('option-sequence'), 10);
        }
        if ($(oQuantityObject).attr('has-option') === 'F') {
            return 1;
        }
        if ($(oQuantityObject).attr('option_type') === 'F' && $(oQuantityObject).attr('option_sort_no')) {
            return parseInt($(oQuantityObject).attr('option_sort_no'), 10);
        }
        var sSequenceClass = $.grep($(oQuantityObject).attr('class').split(' '), function(sClassName,i) {
            return $.trim(sClassName).indexOf('option-sequence-') === 0;
        })[0];

        return parseInt(sSequenceClass.replace('option-sequence-', ''), 10);
    };

    var setProductTargetKey = function(oElement, sType)
    {
        var iTargetProductNum = iProductNo;
        var sTargetKey = iProductNo;
        var iOptionSequence = 1;
        if (typeof(oElement) !== 'undefined') {
            if (oElement.hasClass('single-quantity-input') === true || oElement.hasClass('quantity-handle') === true) {
                iTargetProductNum = getProductNum(oElement);
                iOptionSequence = getOptionSequenceNum(oElement);
            } else {
                var oOptionChoose = EC_SHOP_FRONT_NEW_OPTION_COMMON.setOptionBoxElement(oElement);
                iTargetProductNum = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionProductNum(oOptionChoose);
                if (isNaN(iTargetProductNum) === true) {
                    iTargetProductNum = $(oElement).attr('product-no');
                }
                iOptionSequence = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSortNum(oOptionChoose);
            }
            sTargetKey = iTargetProductNum;
        }
        if (sType === 'setproduct') {
            if (sSetProductType === 'S') {
                sTargetKey = iTargetProductNum+'|'+iProductNo;
            }
        }
        var bAddProductOptionF = false;
        var bSetProductOptionF = false;
        if (sType === 'addproduct') {
            var oOptionChoose = $('select#addproduct_option_id_'+iTargetProductNum+'_'+iOptionSequence);
            bAddProductOptionF = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionType(oOptionChoose) === 'F';
        }
        if (sType === 'setproduct') {
            var oOptionChoose = $('select#setproduct_option_id_'+iTargetProductNum+'_'+iOptionSequence);
            bSetProductOptionF = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionType(oOptionChoose) === 'F';
        }
        if ((typeof(sType) === 'undefined' && option_type === 'F') || bSetProductOptionF === true || bAddProductOptionF === true) {
            sTargetKey = sTargetKey+'|'+iOptionSequence;
        }
        sProductTargetKey = sTargetKey;
    }

    return {
        getProductTargetKey : function()
        {
            return sProductTargetKey;
        },
        setProductTargetKey : function(oElement, sType)
        {
            return setProductTargetKey(oElement, sType);
        },
        getTotalPriceSelector : function()
        {
            return getTotalPriceSelector();
        },
        getProductNum : function(oQuantityButtnObject)
        {
            return getProductNum(oQuantityButtnObject);
        },
        getOptionSequence : function(oQuantityButtnObject)
        {
            return getOptionSequenceNum(oQuantityButtnObject);
        },
        getQuantityInput : function(oQuantityButtonObject, sContext)
        {
            var iSequenceNum = getOptionSequenceNum(oQuantityButtonObject);
            var iProductNum = getProductNum(oQuantityButtonObject);
            if (typeof(sContext) === 'undefined') {
                sContext = null;
            }

            return $(sSingleQuantityInputSelector+'[option-sequence='+iSequenceNum+'][product-no='+iProductNum+']', sContext);
        },
        isItemSelectionTypeS : function()
        {
            return isItemSelectionTypeS();
        },
        isItemSelectionTypeM : function()
        {
            return isItemSelectionTypeM();
        }
    };
}();
/**
 * 뉴상품 옵션 셀렉트 공통파일
 */
var EC_SHOP_FRONT_NEW_OPTION_COMMON = {
    cons : null,

    data : null,

    bind : null,

    validation : null,

    /**
     * 페이지 로드가 완료되었는지
     */
    isLoad : false,

    initObject : function() {
        this.cons = EC_SHOP_FRONT_NEW_OPTION_CONS;
        this.data = EC_SHOP_FRONT_NEW_OPTION_DATA;
        this.bind = EC_SHOP_FRONT_NEW_OPTION_BIND;
        this.validation = EC_SHOP_FRONT_NEW_OPTION_VALIDATION;
    },

    /**
     * 페이지 로딩시 초기화
     */
    init : function() {
        var oThis = this;
        //조합분리형이지만 옵션이 1개인경우
        var bIsSolidOption = false;
        //첫 로드시에는 첫번째 옵션만 검색
        $('select[option_select_element="ec-option-select-finder"][option_sort_no="1"], ul[option_select_element="ec-option-select-finder"][option_sort_no="1"]').each(function() {
            //연동형이 아닌고 분리형일때만 실행
            bIsSolidOption = false;
            if (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isSeparateOption(this) === true) {
                if (Olnk.isLinkageType($(this).attr('option_type')) === false) {
                    if (parseInt($('[product_option_area="'+oThis.getOptionSelectGroup(this)+'"]').length) < 2) {
                        bIsSolidOption = true;
                    }

                    oThis.data.initializeSoldoutFlag($(this));

                    oThis.setOptionText($(this), bIsSolidOption);


                }
            }
        });
    },

    /**
     * 옵션상품인데 모든옵션이 판매안함+진열안함일때 예외처리
     * @param sProductOptionID 옵션 Selectbox ID
     */
    isValidOptionDisplay : function(sProductOptionID)
    {
        var iOptionCount = 0;
        $('select[option_select_element="ec-option-select-finder"][id^="' + sProductOptionID + '"], ul[option_select_element="ec-option-select-finder"][ec-dev-id^="' + sProductOptionID + '"]').each(function() {

            if (EC_SHOP_FRONT_NEW_OPTION_COMMON.isOptionStyleButton(this) === true) {
                iOptionCount += $(this).find('li').length;
            } else {
                iOptionCount += $(this).find('option').length - 2;
            }
        });

        return iOptionCount > 0;
    },

    /**
     * 각 옵션에대해 전체품절인지 확인후
     */
    setOptionText : function(oOptionChoose, bIsSolidOption) {
        var bIsStyleButton = this.isOptionStyleButton(oOptionChoose);
        if (bIsStyleButton === true) {
            var oTargetOption = $(oOptionChoose).find('li');
        } else {
            var oTargetOption = $(oOptionChoose).find('option').filter('[value!="*"][value!="**"]');
        }

        var bIsDisplaySolout = EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isSoldoutOptionDisplay();
        var iProductNum = this.getOptionProductNum(oOptionChoose);
        var oThis = this;

        $(oTargetOption).each(function() {
            var sValue = oThis.getOptionValue(oOptionChoose, $(this));
            var isSoldout = EC_SHOP_FRONT_NEW_OPTION_DATA.getSoldoutFlag(iProductNum, sValue);
            var bIsDisplay = EC_SHOP_FRONT_NEW_OPTION_DATA.getDisplayFlag(iProductNum, sValue);
            var sOptionText = oThis.getOptionText(oOptionChoose, this);

            if (bIsDisplay === false) {
                $(this).remove();
                return;
            }

            //조합분리형인데 옵션이 1개인경우 옵션추가금액을 세팅)
            if (bIsSolidOption === true) {
                var sItemCode = oThis.data.getItemCode(iProductNum, sValue);

                var sAddText = EC_SHOP_FRONT_NEW_OPTION_BIND.setAddText(iProductNum, sItemCode, oOptionChoose);
                if (sAddText !== '') {
                    sOptionText = sOptionText + sAddText;
                }
            }

            if (isSoldout === true) {
                //품절표시안함일때 안보여주도록함(첫번째옵션이라서.. 어쩔수없이 여기서 ㅋ)
                //두번째옵션부터는 동적생성이니깐 bind에서처리
                if (bIsDisplaySolout === false) {
                    $(this).remove();
                    return;
                }
                //해당 옵션값 객첵가 넘어오면 바로 적용
                if (bIsStyleButton === true) {
                    $(this).addClass(EC_SHOP_FRONT_NEW_OPTION_CONS.BUTTON_OPTION_SOLDOUT_CLASS);
                }

                //분리형이면서 전체상품이 품절이면
                if (bIsSolidOption !== true) {
                    var sSoldoutText = EC_SHOP_FRONT_NEW_OPTION_COMMON.getSoldoutText(oOptionChoose, sValue);
                    sOptionText = sOptionText +  ' ' + sSoldoutText;

                }
            }

            oThis.setText(this, sOptionText);

        });
    },

    /**
     * 품목이 아닌 각 옵션별로 전체품절인지 황니후 품절이면 품절문구 반환
     * @param oOptionChoose
     * @param sValue
     * @returns {String}
     */
    getSoldoutText : function(oOptionChoose, sValue) {
        var sText = '';

        var iProductNum = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionProductNum(oOptionChoose);

        if (EC_SHOP_FRONT_NEW_OPTION_DATA.getSoldoutFlag(iProductNum, sValue) === true) {
            return '[' + EC_SHOP_FRONT_NEW_OPTION_EXTRA_SOLDOUT.getSoldoutDiplayText(iProductNum) + ']';
        }

        return sText;
    },

    /**
     * 셀렉트박스형 옵션인지 버튼형 옵션이지 확인
     * @param oOptionChoose 구분할 옵션박스 object
     * @returns true => 버튼형옵션, false => 기존 select형 옵션
     */
    isOptionStyleButton : function(oOptionChoose) {
        var sOptionStyle = $(oOptionChoose).attr(this.cons.OPTION_STYLE);
        if (sOptionStyle === 'preview' || sOptionStyle === 'button' || sOptionStyle === 'radio') {
            return true;
        }

        return false;
    },

    /**
     * 해당 옵션의 옵션출력타입(분리형 : S, 일체형 : C)
     * @param oOptionChoose 구분할 옵션박스 object
     * @returns 옵션타입
     */
    getOptionListingType : function(oOptionChoose)
    {
        oOptionChoose = this.setOptionBoxElement(oOptionChoose);
        return $(oOptionChoose).attr(this.cons.OPTION_LISTING_TYPE);
    },

    /**
     * 해당 옵션의 옵션타입(조합형 : T, 연동형 : E, 독립형 : F)
     * @param oOptionChoose 구분할 옵션박스 object
     * @returns 옵션타입
     */
    getOptionType : function(oOptionChoose) {
        oOptionChoose = this.setOptionBoxElement(oOptionChoose);
        return $(oOptionChoose).attr(this.cons.OPTION_TYPE);
    },

    /**
     * 해당 옵션의 옵션그룹명을 가져온다
     * @param oOptionChoose 구분할 옵션박스 object
     * @returns 옵션그룹이름
     */
    getOptionSelectGroup : function(oOptionChoose) {
        return $(oOptionChoose).attr(this.cons.GROUP_ATTR_NAME);
    },

    /**
     * sOptionStyleConfirm 에 해당하는 옵션인지 확인
     * @param oOptionChoose 구분할 옵션박스 object
     * @param sOptionStyleConfirm 옵션스타일(EC_SHOP_FRONT_NEW_OPTION_CONS : OPTION_STYLE_PREVIEW 또는 OPTION_STYLE_BUTTON)
     * @returns 확인결과
     */
    isOptionStyle : function(oOptionChoose, sOptionStyleConfirm) {
        var sOptionStype = $(oOptionChoose).attr(this.cons.OPTION_STYLE);
        if (sOptionStype === sOptionStyleConfirm) {
            return true;
        }

        return false;
    },

    /**
     * 해당 옵션의 선택된 Text내용을 가져옴
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @returns 옵션 내용Text
     */
    getOptionSelectedText : function(oOptionChoose) {
        if (this.isOptionStyleButton(oOptionChoose) === true) {
            return $(oOptionChoose).find('li.' + this.cons.BUTTON_OPTION_SELECTED_CLASS).attr('title');
        } else {
            return $(oOptionChoose).find('option:selected').text();
        }
    },

    /**
     * 해당 옵션의 선택된 값을 가져옴
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @returns 옵션값
     */
    getOptionSelectedValue : function(oOptionChoose) {
        oOptionChoose = this.setOptionBoxElement(oOptionChoose);

        if (this.isOptionStyleButton(oOptionChoose) === true) {
            var oTarget = $(oOptionChoose).find('li.' + this.cons.BUTTON_OPTION_SELECTED_CLASS);

            //버튼형옵션은 *, **값이 없기떄문에 선택된게 없다면 강제리턴
            if (oTarget.length < 1) {
                return '*';
            } else {
                return oTarget.attr('option_value');
            }
        } else {
            var sValue = $(oOptionChoose).val();
            return ($.trim(sValue) === '') ? '*' : sValue;
        }
    },

    /**
     * 해당 Element의 값을 가져옴
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @param oOptionChoose 값을 가져오려는 옵션 항목
     * @returns 옵션값
     */
    getOptionValue : function(oOptionChoose, oOptionChooseElement) {
        if (this.isOptionStyleButton(oOptionChoose) === true) {
            return $(oOptionChooseElement).attr('option_value');
        } else {
            return $(oOptionChooseElement).val();
        }
    },

    /**
     * 해당 Element의 Text값을 가져옴
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @param oOptionChoose 값을 가져오려는 옵션 항목
     * @returns
     */
    getOptionText : function(oOptionChoose, oOptionChooseElement) {
        if (this.isOptionStyleButton(oOptionChoose) === true) {
            return $(oOptionChooseElement).attr('title');
        } else {
            return $(oOptionChooseElement).text();
        }
    },

    /**
     * 선택된 옵션의 Element를 가져온다
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @returns 선택옵션의 DOM Element
     */
    getOptionSelectedElement : function(oOptionChoose) {
        if (this.isOptionStyleButton(oOptionChoose) === true) {
            return $(oOptionChoose).find('li.' + this.cons.BUTTON_OPTION_SELECTED_CLASS);
        } else {
            return $(oOptionChoose).find('option:selected');
        }
    },

    getOptionLastSelectedElement : function(sOptionGroup)
    {
        var oOptionGroup = this.getGroupOptionObject(sOptionGroup);
        var aTempResult = [];
        oOptionGroup.each(function(i) {
            if (EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectedValue(oOptionGroup[i]) !== '*') {
                aTempResult.push(oOptionGroup[i]);
            }
        });
        return $(aTempResult[aTempResult.length - 1]);
    },

    /**
     * 해당 옵션의 상품번호를 가져옴
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @returns 상품번호
     */
    getOptionProductNum : function(oOptionChoose) {
        return parseInt($(oOptionChoose).attr(this.cons.OPTION_PRODUCT_NUM));
    },

    /**
     * 해당 옵션의 순번을 가져옴
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @returns 해당 옵션의 순서 번호
     */
    getOptionSortNum : function(oOptionChoose) {
        oOptionChoose = this.setOptionBoxElement(oOptionChoose);
        return parseInt($(oOptionChoose).attr(this.cons.OPTION_SORT_NUM));
    },

    /**
     * 이벤트 옵션까지에대해 현재까지 선택된 옵션값 배열
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @param bIsString 값이 true이면 선택된 옵션들을 구분자로 join해서 받아온다
     * @returns 현재까지 선택된 옵션값 배열
     */
    getAllSelectedValue : function(oOptionChoose, bIsString) {
        var iOptionSortNum = this.getOptionSortNum(oOptionChoose);

        //지금까지 선택된 옵션의 값
        var aSelectedValue = [];
        $('[product_option_area="'+$(oOptionChoose).attr(this.cons.GROUP_ATTR_NAME)+'"]').each(function() {
            if (parseInt($(this).attr('option_sort_no')) <= iOptionSortNum) {
                aSelectedValue.push(EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectedValue($(this)));
            }
        });

        return (bIsString === true) ? aSelectedValue.join(this.cons.OPTION_GLUE) : aSelectedValue;
    },

    /**
     * iSelectedOptionSortNum 의 하위옵션을 초기화(0일때는 모두초기화)ㅅ
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @param iSelectedOptionSortNum 하위옵션을 초기화할 대상 옵션 순번
     */
    setInitializeDefault : function(oOptionChoose, iSelectedOptionSortNum) {
        var sOptionGroup = $(oOptionChoose).attr(this.cons.GROUP_ATTR_NAME);
        var iProductNum = this.getOptionProductNum(oOptionChoose);
        this.bind.setInitializeDefault(sOptionGroup, iSelectedOptionSortNum, iProductNum);
    },

    /**
     * 외부에서 기존스크립트가 호출할때는 버튼형옵션객체가 아니라 숨겨진 셀렉트박스에서 호출하므로 버튼형옵션객체를 찾아서 리턴
     */
    setOptionBoxElement : function(oOptionChoose) {
        if (typeof($(oOptionChoose).attr('product_option_area_select')) !== 'undefined') {
            oOptionChoose = $('ul[product_option_area="'+$(oOptionChoose).attr('product_option_area_select')+'"][ec-dev-id="'+$(oOptionChoose).attr('id')+'"]');
        }

        return oOptionChoose;
    },

    /**
     * 선택한 옵션 하위옵션 모두 초기화(추가구성상품에서 연동형옵션때문에...)
     * @param oOptionChoose
     */
    setAllClear : function(oOptionChoose) {
        oOptionChoose = this.setOptionBoxElement(oOptionChoose);

        var iSortNo = parseInt(this.getOptionSortNum(oOptionChoose));
        $(this.getGroupOptionObject(this.getOptionSelectGroup(oOptionChoose))).each(function() {
            if (iSortNo < parseInt(EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSortNum($(this)))) {
                EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue($(this), '*');
            }
        });
    },

    /**
     * 멀티옵션(구스킨)에서 사용할때 해당 옵션의 id값을 바꾸는기능이 있어서 추가
     * @param oOptionChoose
     */
    setID : function(oOptionChooseOrg, sId) {
        if ($(oOptionChooseOrg).attr('option_style') === 'select') {
            oOptionChoose = oOptionChooseOrg;
        } else {
            oOptionChoose = $(oOptionChooseOrg).parent().find('ul[option_style="preview"], [option_style="button"], [option_style="radio"]');
        }

        if (this.isOptionStyleButton(oOptionChoose) === true) {
            $(oOptionChoose).attr('ec-dev-id', sId);
            $(oOptionChooseOrg).attr('id', sId);
        } else {
            $(oOptionChoose).attr('id', sId);
        }
    },

    /**
     * 멀티옵션(구스킨)에서 사용할때 해당 옵션의 id값을 바꾸는기능이 있어서 추가
     * @param oOptionChoose
     */
    setGroupArea : function(oOptionChooseOrg, sGroupID) {
        if ($(oOptionChooseOrg).attr('option_style') === 'select') {
            oOptionChoose = oOptionChooseOrg;
        } else {
            oOptionChoose = $(oOptionChooseOrg).parent().find('ul[option_style="preview"], [option_style="button"], [option_style="radio"]');
        }

        if (this.isOptionStyleButton(oOptionChoose) === true) {
            $(oOptionChoose).attr('product_option_area', sGroupID)
            $(oOptionChooseOrg).attr('product_option_area_select', sGroupID);
        } else {
            $(oOptionChoose).attr('product_option_area', sGroupID);
        }
    },

    /**
     * 해당 선택한 옵션의 text값을 세팅
     */
    setText : function(oSelectecOptionChoose, sText) {
        oOptionChoose = this.setOptionBoxElement($(oSelectecOptionChoose).parent());

        if (this.isOptionStyleButton(oOptionChoose) === true) {
            var sValue = $(oSelectecOptionChoose).attr('option_value');
            var oTarget = $(oOptionChoose).find('li[option_value="'+sValue+'"]');
            $(oTarget).attr('title', sText);

        }

        if (this.isOptionStyleButton($(oSelectecOptionChoose).parent()) !== true) {
            $(oSelectecOptionChoose).text(sText);
        }
    },

    /**
     * 추가 이미지에서 추출한 품목 코드를 바탕으로 옵션 선택
     * @param sItemCode 품목 코드
     */
    setValueByAddImage : function(sItemCode) {
        if (typeof(sItemCode) === 'undefined') {
            return;
        }

        // 조합 일체형은 아래 구간을 타지 않아도 처리됨
        if (! (option_type === 'T' && item_listing_type === 'C')) {
            // 조합 분리형
            // 품목 데이터
            var oItemData = EC_SHOP_FRONT_NEW_OPTION_DATA.getProductStockData(iProductNo);

            if (option_type === 'T' && item_listing_type === 'S') {
                // 해당 품목의 옵션 값 추출
                var aItemData = oItemData[sItemCode].option_value.split('-');

                // 조합 분리형
                // 옵션 값에 따른 반복 처리
                $.each(aItemData, function(iKey, sOption) {
                    var oTargetOption = $('#product_option_id' + (iKey + 1)).val(sOption);

                    // 최종 데이터를 가지고 값 할당
                    EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(oTargetOption, sOption, null, null, true);
                });
            } else if (option_type === 'F') {
                // 독립 선택형
                // 각 옵션 = 품목 개념이므로, 품목코드로 바로 처리
                // 전체 셀렉트 박스에서 옵션의 값으로 검색/선택
                var oTargetOption = $('select[id^="product_option_id"] option[value="' + sItemCode + '"]').parent();

                // 최종 데이터를 가지고 값 할당
                EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(oTargetOption, sItemCode, null, null, true);
            }
        } else {
            // 조합 일체형/독립 선택형이 아닌 경우에는 원래대로 처리
            EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue($('#product_option_id1'), sItemCode, null, null, true);
        }
    },

    /**
     * 해당 Element의 값을 강제로 지정
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @param sValue set 하려는 value
     * @param bIsInitialize false인 경우에는 클릭이벤트를 발생하지 않도록 한다
     * @param bChange change 이벤트 발생 여부
     */
    setValue : function(oOptionChoose, sValue, bIsInitialize, bChange) {
        // 값 세팅시 각 페이지에서 $(this).val()로 값을 지정할경우
        // 본래 버튼형 옵션이면 타겟을 버튼형 옵션으로 이어준다
        oOptionChoose = this.setOptionBoxElement(oOptionChoose);

        if (this.isOptionStyleButton(oOptionChoose) === true) {
            $(oOptionChoose).find('li').removeClass(this.cons.BUTTON_OPTION_SELECTED_CLASS);

            var oTarget = $(oOptionChoose).find('li[option_value="' + sValue + '"]');

            if ($(oTarget).length > 0) {
                $(oTarget).trigger('click');
            } else {
                if (bIsInitialize !== false) {
                    // 선택값이 없다면 셀렉트박스 초기화
                    var iProductNum = this.getOptionProductNum(oOptionChoose);
                    var iSelectedOptionSortNum = this.getOptionSortNum(oOptionChoose);
                    var sOptionGroup = this.getOptionSelectGroup(oOptionChoose);
                    var bIsRequired = EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isRequireOption(oOptionChoose);

                    if (EC_SHOP_FRONT_NEW_OPTION_BIND.isEnabledOptionInit(oOptionChoose) === true) {
                        EC_SHOP_FRONT_NEW_OPTION_BIND.setInitializeDefault(sOptionGroup, iSelectedOptionSortNum, iProductNum, bIsRequired);
                    }

                    EC_SHOP_FRONT_NEW_OPTION_EXTRA_DISPLAYITEM.eachCallback(oOptionChoose);
                    EC_SHOP_FRONT_NEW_OPTION_BIND.setRadioButtonSelect(oTarget, oOptionChoose, false);
                }

                this.setTriggerSelectbox(oOptionChoose, sValue);
            }
        } else {
            $(oOptionChoose).val(sValue);

            if (typeof(bChange) !== 'undefined') {
                $(oOptionChoose).trigger('change');
            }
        }
    },

    /**
     * 버튼 또는 이미지형 옵션일 경우 동적 selectbox와 동기화 시킴
     * @param oOptionChoose 선택한 옵션 Object
     * @param sValue set 하려는 value
     * @param bIsTrgger 셀렉트박스의 change 이벤트를 발생시키지 않을때(ex:모바일의 옵션선택 레이어..)
     */
    setTriggerSelectbox : function(oOptionChoose, sValue, bIsTrigger)
    {
        if (this.isOptionStyleButton(oOptionChoose) === true) {
            var oTargetSelect = $('select[product_option_area_select="' + $(oOptionChoose).attr('product_option_area') + '"][id="' + $(oOptionChoose).attr('ec-dev-id') + '"]');
            var bChange = true;

            if (this.validation.isItemCode(sValue) === false) {
                var sValue = '*';
                var sText = 'empty';

                bChange = false;
            } else {
                var sValue = this.getOptionSelectedValue(oOptionChoose);
                var sText = this.getOptionSelectedText(oOptionChoose);
            }

            $(oTargetSelect).find('option[value!="*"][value="' + sValue + '"]').remove('option');

            if (sValue !== '*') {
                sOptionsHtml = this.cons.OPTION_STYLE_SELECT_HTML.replace('[value]', sValue).replace('[text]', sText);

                $(oTargetSelect).append($(sOptionsHtml));
            }

            $(oTargetSelect).val(sValue);

            if (bChange === true && bIsTrigger !== false) {
                $(oTargetSelect).trigger('change');
            }
        }
    },

    /**
     * 해당 상품의 옵션 재고 관련 데이터를 리턴
     * @param iProductNum 상품번호
     * @returns option_stock_data 데이터
     */
    getProductStockData : function(iProductNum) {
        return this.data.getProductStockData(iProductNum);
    },

    /**
     * 선택상품의 아이템코드를 반환(선택이 안되어있다면 false)
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @returns 아이템 코드 OR false
     */
    getItemCode : function(oOptionChoose) {
        //분리조합형일경우
        if (this.validation.isSeparateOption(oOptionChoose) === true) {
            var sSelectedValue = this.getAllSelectedValue(oOptionChoose, true);
            var iProductNum = this.getOptionProductNum(oOptionChoose);
            return this.data.getItemCode(iProductNum, sSelectedValue);
        }

        //그외의 경우에는 현재 선택된 옵션의 value가 아이템코드
        var sItemCode = this.getOptionSelectedValue(oOptionChoose);

        return (this.validation.isItemCode(sItemCode) === true) ? sItemCode : false;
    },

    /**
     * 해당 그룹내의 모든옵션에대해 선택된 품목코드를 반환
     * @param sOptionGroup 옵션 그룹 (@see : EC_SHOP_FRONT_NEW_OPTION_GROUP_CONS)
     * @returns 선택된 아이템코드 배열
     */
    getGroupItemCodes : function(sOptionGroup, bIsAbleSoldout) {
        var aItemCode = [];
        var sItemCode = '';
        var oTarget = $('[' + this.cons.GROUP_ATTR_NAME + '^="' + sOptionGroup + '"]');

        //뉴스킨인 경우에는 옵션박스 레이어에 생성된 input에서 가져온다
        if (isNewProductSkin() === true) {
            $('.' + EC_SHOP_FRONT_NEW_OPTION_GROUP_CONS.DETAIL_OPTION_BOX_PREFIX).each(function() {
                //옵션박스에 생성된 input태그이므로 val()로 가져온다
                sItemCode = $(this).val();
                if (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isItemCode(sItemCode) === true) {
                    aItemCode.push(sItemCode);
                }
            });

            //품절품목에 대한 아이템코드도 포함시킨다 - 현재는 관심상품담을경우에 쓰이는것으로 보임
            if (bIsAbleSoldout === true) {
                $('.' + EC_SHOP_FRONT_NEW_OPTION_GROUP_CONS.DETAIL_OPTION_BOX_SOLDOUT_PREFIX).each(function() {
                    aItemCode.push($(this).val());

                    if (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isItemCode(sItemCode) === true) {
                        aItemCode.push(sItemCode);
                    }
                });
            }
        } else {
            //구스킨인 경우에는 해당하는 옵션에 선택된 값만 가져옴
            $(oTarget).each(function() {
                sItemCode = EC_SHOP_FRONT_NEW_OPTION_COMMON.getItemCode(this);

                //이미 저장된 아이템코드이면 제와(분리형인경우 같은 값이 여러개 들어올수있음)
                //조합형을 따로 처리하기보다는 그냥 두는게 더 간단하다는 핑계임
                if ($.inArray(sItemCode, aItemCode) > -1) {
                    return true;//continue
                }

                if (sItemCode !== false) {
                    aItemCode.push(sItemCode);
                }
            });
        }

        return aItemCode;
    },

    /**
     * 해당 품목의 품절 여부
     * @param iProductNum 상품번호
     * @param sItemCode 품목코드
     * @returns 품절여부
     */
    isSoldout : function(iProductNum, sItemCode) {
        var aStockData = this.getProductStockData(iProductNum);

        if (typeof(aStockData[sItemCode]) === 'undefined') {
            return false;
        }

        //재고를 사용하고 재고수량이 1개미만이면 품절
        if (aStockData[sItemCode].use_stock ===  true && parseInt(aStockData[sItemCode].stock_number) < 1) {
            return true;
        }

        //판매안함 상태이면 품절
        if (aStockData[sItemCode].is_selling === 'F') {
            return true;
        }

        return false;
    },

    /**
     * 진열여부 확인
     */
    isDisplay : function(iProductNum, sItemCode) {
        var aStockData = this.getProductStockData(iProductNum);

        if (typeof(aStockData[sItemCode]) === 'undefined') {
            return false;
        }

        if (aStockData[sItemCode].is_display !== 'T') {
            return false;
        }

        return true;
    },

    /**
     * sOptionGroup에 해당하는 옵션셀렉트박스의 Element를 가져온다
     * @param sOptionGroup sOptionGroup 옵션 그룹 (@see : EC_SHOP_FRONT_NEW_OPTION_GROUP_CONS)
     * @returns 해당 옵션셀렉트박스 Element전체
     */
    getGroupOptionObject : function(sOptionGroup) {
        return $('[' + this.cons.GROUP_ATTR_NAME + '^="' + sOptionGroup + '"]');
    },

    /**
     * 해당 옵션그룹에서 필수옵션의 갯수를 가져온다
     * @param sOptionGroup sOptionGroup 옵션 그룹 (@see : EC_SHOP_FRONT_NEW_OPTION_GROUP_CONS)
     * @returns 필수옵션 갯수
     */
    getRequiredOption : function(sOptionGroup) {
        return this.getGroupOptionObject(sOptionGroup).filter('[required="true"],[required="required"]');
    },

    /**
     * 해당 옵션의 전체 Value값을 가져옴(옵션그룹이 아니라 단일 옵션 셀렉츠박스)
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @returns {Array}
     */
    getAllOptionValues : function(oOptionChoose) {
        //일반 셀렉트박스일때
        var aOptionValue = [];
        if (this.isOptionStyleButton(oOptionChoose) === false) {
            $(oOptionChoose).find('option:[value!="*"][value!="**"]').each(function() {
                aOptionValue.push($(this).val());
            });
        } else {
            //버튼형 옵션일경우
            $(oOptionChoose).find('li:[option_value!="*"][option_value!="**"]').each(function() {
                aOptionValue.push($(this).attr('option_value'));
            });
        }

        return aOptionValue;
    },

    /**
     * 해당 옵션의 실제 id값을 리턴
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     * @returns {String}
     */
    getOptionChooseID : function(oOptionChoose) {
        var sID = '';
        if (this.isOptionStyleButton(oOptionChoose) === true) {
            sID = $(oOptionChoose).attr('ec-dev-id');
        } else {
            sID = $(oOptionChoose).attr('id');
        }

        return sID;
    }
};

$(document).ready(function() {
    EC_SHOP_FRONT_NEW_OPTION_COMMON.isLoad = true;

    //표시된 옵션 선택박스에 대해  디폴트 옵션데이터 정리
    EC_SHOP_FRONT_NEW_OPTION_DATA.setDefaultData();

    EC_SHOP_FRONT_NEW_OPTION_COMMON.init();
});

/**
 * 옵션에대한 Attribute 및 구분자 모음
 */
var EC_SHOP_FRONT_NEW_OPTION_CONS = {
    /**
     * 옵션 그룹 Attribute Key(각 상품 및 영역별 구분을 위한 값)
     */
    GROUP_ATTR_NAME : 'product_option_area',

    /**
     * 옵션 스타일 Attribute Key
     */
    OPTION_STYLE : 'option_style',

    /**
     * 상품번호 Attribute Key
     */
    OPTION_PRODUCT_NUM : 'option_product_no',

    /**
     * 각 옵션의 옵션순서 Attribute Key
     */
    OPTION_SORT_NUM : 'option_sort_no',

    /**
     * 옵션 타입 Attribute Key
     */
    OPTION_TYPE : 'option_type',

    /**
     * 옵션 출력 타입 Attribute Key
     */
    OPTION_LISTING_TYPE : 'item_listing_type',

    /**
     * 옵션 값 구분자
     */
    OPTION_GLUE : '#$%',

    /**
     * 미리보기형 옵션
     */
    OPTION_STYLE_PREVIEW : 'preview',

    /**
     * 버튼형 옵션
     */
    OPTION_STYLE_BUTTON : 'button',

    /**
     * 기존 셀렉트박스형 옵션
     */
    OPTION_STYLE_SELECT : 'select',

    /**
     * 라디오박스형 옵션
     */
    OPTION_STYLE_RADIO : 'radio',

    /**
     * 각 옵션마다 연결된 이미지 Attribute
     */
    OPTION_LINK_IMAGE : 'link_image',

    /**
     * 셀렉트박스형 옵션의 Template
     */
    OPTION_STYLE_SELECT_HTML : '<option value="[value]">[text]</option>',

    /**
     * 기본 품절 문구
     */
    OPTION_SOLDOUT_DEFAULT_TEXT : __("품절"),

    /**
     * 버튼형 옵션의 품절표시 class
     */
    BUTTON_OPTION_SOLDOUT_CLASS : 'ec-product-soldout',

    /**
     * 버튼형 옵션의 선택불가 class
     */
    BUTTON_OPTION_DISABLE_CLASS : 'ec-product-disabled',

    /**
     * 버튼형 옵션의 선택된 옵션값을 구분하기위한 상수
     */
    BUTTON_OPTION_SELECTED_CLASS : 'ec-product-selected'
};

/**
 * 각 옵션그룹에 대한 Key 정의
 */
var EC_SHOP_FRONT_NEW_OPTION_GROUP_CONS = {
    /**
     * 상품디테일의 메인 옵션 그룹
     */
    DETAIL_OPTION_GROUP_ID : 'product_option_',

    /**
     * 뉴스킨 상품상세의 옵션선택시 쩔어지는 옵션박스레이어 class명
     */
    DETAIL_OPTION_BOX_PREFIX : 'option_box_id',

    /**
     * 뉴스킨 상품상세의 옵션선택시 쩔어지는 옵션박스레이어 class명(품절일경우의 prefix)
     * Prefix존누 많음
     */
    DETAIL_OPTION_BOX_SOLDOUT_PREFIX : 'soldout_option_box_id'
};

var EC_SHOP_FRONT_NEW_OPTION_BIND = {

    /**
     * 선택한 옵션 그룹(product_option_상품번호 : 상품상세일반상품)
     */
    sOptionGroup : null,

    /**
     * 옵션이 모두 선택되었을때 해당하는 item_code를 Set
     */
    sItemCode : false,

    /**
     * 선택한 옵션의 상품번호
     */
    iProductNum : 0,

    /**
     * 선택한 옵션의 순번
     */
    iOptionIndex : null,

    /**
     * 선택한 옵션의 옵션 스타일(select : 셀렉트박스, preview : 미리보기, button : 버튼형)
     */
    sOptionStyle : null,

    /**
     * 해당 상품 옵션 갯수
     */
    iOptionCount : 0,

    /**
     * 품절옵션 표시여부
     */
    bIsDisplaySolout : true,

    /**
     * 선택한 옵션의 객체(셀렉트박스 또는 버튼형 옵션 박스(ul태그))
     */
    oOptionObject : null,

    /**
     * 선택한 옵션의 다음옵션 Element
     */
    oNextOptionTarget : null,

    /**
     * 선택된 옵션 값
     */
    aOptionValue : [],

    /**
     * 옵션텍스트에 추가될 항목에대한 정의
     */
    aExtraOptionText : [
        EC_SHOP_FRONT_NEW_OPTION_EXTRA_PRICE,
        EC_SHOP_FRONT_NEW_OPTION_EXTRA_SOLDOUT,
        EC_SHOP_FRONT_NEW_OPTION_EXTRA_IMAGE,
        EC_SHOP_FRONT_NEW_OPTION_EXTRA_DISPLAYITEM,
        EC_SHOP_FRONT_NEW_OPTION_EXTRA_ITEMSELECTION
    ],

    /**
     * EC_SHOP_FRONT_NEW_OPTION_CONS 객체 Alias
     */
    cons : null,

    /**
     * EC_SHOP_FRONT_NEW_OPTION_COMMON 객체 Alias
     */
    common : null,

    /**
     * EC_SHOP_FRONT_NEW_OPTION_DATA 객체 Alias
     */
    data : null,

    /**
     * EC_SHOP_FRONT_NEW_OPTION_VALIDATION 객체 Alias
     */
    validation : null,

    isEnabledOptionInit : function(oOptionChoose)
    {
        var iProductNum = $(oOptionChoose).attr('option_product_no');
        //연동형이면서 옵션추가버튼설정이면 순차로딩제외
        if (Olnk.isLinkageType(this.common.getOptionType(oOptionChoose)) === true && (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isUseOlnkButton() === true || EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isBindUseOlnkButton(iProductNum) === true)) {
            return false;
        }

        if (this.common.getOptionType(oOptionChoose) === 'F') {
            return false;
        }

        return true;
    },

    /**
     * 각 옵션값에 대한 이벤트 처리
     * @param oThis 옵션 셀렉트박스 또는 버튼박스
     * @param oSelectedElement 선택한 옵션값
     * @param bIsUnset true 이명 deselected된상태로 초기화(setValue를 통해서 틀어왔을떄만 값이 있음)
     */
    initialize : function(oThis, oSelectedElement, bIsUnset)
    {
        this.sItemCode = false;
        this.oOptionObject = oThis;

        // 실제 옵션 처리전에 처리해야할 내용을 모아 놓는다
        this.prefetch(oThis);

        if (oSelectedElement !== null) {
            if ($(oSelectedElement).hasClass(EC_SHOP_FRONT_NEW_OPTION_CONS.BUTTON_OPTION_DISABLE_CLASS) === true) {
                this.setRadioButtonSelect(oSelectedElement, oThis, false);
                return;
            }

            //선택 옵션에대한 disable처리나 활성화 처리
            this.setSelectButton(oSelectedElement, bIsUnset);

            //필수정보 Set
            this.setSelectedOptionConf();

            //연동형이면서 옵션추가버튼설정이면 순차로딩제외..
            if (this.isEnabledOptionInit(this.oOptionObject) === true) {
                var bIsDelete = true;
                var bIsRequired = EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isRequireOption(this.oOptionObject);
                //해당 옵션이 연동형이면서 선택형 옵션이면 하위 옵션은 값만 초기화
                if (Olnk.isLinkageType(this.common.getOptionType(this.oOptionObject)) === true &&  bIsRequired=== false) {
                    bIsDelete = false;
                }

                //선택한 옵션이 옵션이 아닐경우 하위옵션 초기화
                //선택한 옵션이 옵션이 아니면 아래 로직은 타지 않고 eachCallback은 실행함
                this.setInitializeDefault(this.sOptionGroup, this.iOptionIndex, this.iProductNum, bIsRequired)

                if (bIsDelete === true && $(oSelectedElement).hasClass(this.cons.BUTTON_OPTION_DISABLE_CLASS) === false && this.validation.isOptionSelected(this.oOptionObject) === true) {
                    //선택한 옵션의 다음옵션값을 Parse
                    //연동형일경우에는 제외 / 조합분리형만 처리되도록 함
                    if (Olnk.isLinkageType(this.sOptionType) === false && this.validation.isSeparateOption(this.oOptionObject) === true) {
                        this.data.initializeOptionValue(this.oOptionObject);
                    }

                    //각 옵션을 초기화및 옵션 리스트 HTML생성
                    //조합분리형일때만 처리
                    if (this.validation.isSeparateOption(this.oOptionObject) === true) {
                        this.setOptionHTML();
                    }
                }
            }

            //해당 값이 true나 false이면 setValue를 통해서 들어온것이기때문에 다시 실행할 필요 없음
            //if (typeof(bIsUnset) === 'undefined') {
                //셀렉트박스 동기화
                this.common.setTriggerSelectbox(this.oOptionObject, this.common.getOptionSelectedValue(this.oOptionObject));
            //}

            //옵션이 모두 선택되었다면 아이템코드를 세팅
            this.setItemCode();
        }

        //옵션선택이 끝나면 각 옵션마다 처리할 프로세스(각 추가기능에서)
        this.eachCallback(oThis);

        //모든 옵션이 선택되었다면
        if (this.sItemCode !== false) {

            var sID = this.common.getOptionChooseID(this.oOptionObject);

            //상세 메인 상품에서만 실행되도록 예외처리
            if (typeof(setPrice) === 'function' && /^product_option_id+/.test(sID) === true) {
                setPrice(false, true, sID);
            }

            //모든 옵션선택이 끝나면 처리할 프로세스(각 추가기능에서)
            this.completeCallback(oThis);
        }
    },

    /**
     * 실제 옵션의 선택여부를 해제하기전 실행하는 액션
     */
    prefetch : function(oThis)
    {
        $(this.aExtraOptionText).each(function() {
            if (typeof(this.prefetech) === 'function') {
                this.prefetech(oThis);
            }
        });
    },

    /**
     * 각 옵션 선택시마다 처리할 Callback(Extra에 있는 추가기능)
     */
    eachCallback : function(oThis)
    {
        $(this.aExtraOptionText).each(function() {
            if (typeof(this.eachCallback) === 'function') {
                this.eachCallback(oThis);
            }
        });
    },

    /**
     * 옵션선택을 하고 품목이 정해졌을때 Callback(Extra에 있는 추가기능)
     */
    completeCallback : function(oThis)
    {
        $(this.aExtraOptionText).each(function() {
            if (typeof(this.completeCallback) === 'function') {
                this.completeCallback(oThis);
            }
        });
    },

    /**
     * iSelectedOptionSortNum보다 하위 옵션들을 초기상태로 변경함
     * @param sOptionGroup 옵션선택박스 그룹
     * @param iSelectedOptionSortNum 하위옵션을 초기화할 대상 옵션 순번
     * @param iProductNum 상품번호
     * @param bIsSetValue COMMON.setValue에서 호출시에는 다시 setValue를 하지 않는다
     */
    setInitializeDefault : function(sOptionGroup, iSelectedOptionSortNum, iProductNum, bSelectedOptionRequired) {
        var iSortNum = 0;
        var sHtml = '';
        var sOptionValueTag = '';
        var oThis = this;
        var iCnt = 0;
        var bIsDelete = null;
        var bIsRequired = null;

        $('['+this.cons.GROUP_ATTR_NAME+'="'+sOptionGroup+'"]').each(function() {

            iSortNum = parseInt(EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSortNum(this));

            //선택한 옵션의 하위옵션들을 초기화
            if (iSelectedOptionSortNum < iSortNum) {

                var bIsRequired = EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isRequireOption(this);
                var isOlnk = Olnk.isLinkageType(EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionType(this));

                //선택했던 옵션이 연동형이면서 선택형 옵션이면 값만 초기화
                //bIsDelete = (bIsDelete = null && isOlnk === true && bSelectedOptionRequired === true && bIsRequired === false) ? false : true;
                if (bIsDelete === null) {
                    //선택했던 옵션이 선택형 옵션이면 처리하지 않음
                    if (bSelectedOptionRequired === false) {
                        bIsDelete = false;
                    } else if (bSelectedOptionRequired === true) {//선택했던 옵션이 필수옵션이면 진행
                        //선택했던 옵션이 필수이면서 현재 옵션이 필수이면 초기화
                        if (bIsRequired === true) {
                            bIsDelete = true;
                        } else {
                            //선택했던 옵션이 필수이면서 현재옵션이 선택형옵션이면 다음옵션에서 체크
                            bIsDelete = null;
                        }
                    }
                }

                if (bIsDelete === true) {
                    sHtml = EC_SHOP_FRONT_NEW_OPTION_DATA.getDefaultOptionHTML(iProductNum, iSortNum);
                    $(this).html('');
                    $(this).append(sHtml);
                }

                //셀렉트박스이면서 필수옵션이라면 기본값을 제외하고 option삭제
                if (EC_SHOP_FRONT_NEW_OPTION_COMMON.isOptionStyle(this, EC_SHOP_FRONT_NEW_OPTION_CONS.OPTION_STYLE_SELECT) === true) {

                    if (bIsDelete === true && bIsRequired === true) {
                        $(this).find('option').attr('disabled', 'disable');
                        $(this).find('option[value!="*"][value!="**"]').remove('option');
                    } else {
                        EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(this, '*', false);
                    }
                }

                if (EC_SHOP_FRONT_NEW_OPTION_COMMON.isOptionStyleButton(this) === true) {
                    if (bIsDelete === true && bIsRequired === true) {
                        $(this).find('li').removeClass(EC_SHOP_FRONT_NEW_OPTION_CONS.BUTTON_OPTION_DISABLE_CLASS).addClass(EC_SHOP_FRONT_NEW_OPTION_CONS.BUTTON_OPTION_DISABLE_CLASS);
                    }

                    EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(this, '*', false);
                  //옵션 텍스트 초기화
                    EC_SHOP_FRONT_NEW_OPTION_EXTRA_DISPLAYITEM.eachCallback(this);
                }

                //첫번째 필수 옵션은 그대로 두고 두번째 필수옵션부터 remove
                if (bIsDelete !== null && bIsRequired === true) {
                    bIsDelete = true;
                }
            }
        });
    },

    /**
     * 옵션이 모두 선택되었다면 아이템코드 Set
     */
    setItemCode : function() {
        //연동형 상품 : 예외적인경우가 많아서 어쩔수가 없음...
        if (Olnk.isLinkageType(this.common.getOptionType(this.oOptionObject)) === true) {
            //선택한 값이 옵션이 아니라면 false
            if (this.validation.isItemCode(this.common.getOptionSelectedValue(this.oOptionObject)) === false) {
                return false;
            }

            //연동형 옵션
            var aSelectedValues = this.common.getAllSelectedValue(this.oOptionObject);

            //필수옵션 갯수
            var iRequiredOption = this.common.getRequiredOption(this.sOptionGroup).length;

            //선택한 옵션갯수보다 필수옵션이 많다면 false
            if (iRequiredOption > $(aSelectedValues).length) {
                return false;
            }
            //실제 필수옵션이 체크되어있는지
            var aOptionValues = [];
            var bIsExists = false;
            var iRequireSelectedOption = 0;

            //필수항목만 검사
            this.common.getRequiredOption(this.sOptionGroup).each(function() {
                bIsExists = false;
                aOptionValues = EC_SHOP_FRONT_NEW_OPTION_COMMON.getAllOptionValues(this);

                //필수 항목 옵션의 값을 실제 선택한옵션가눙데 존재하는지 일일히 확인해야한다
                $(aSelectedValues).each(function(i, iNo) {
                    //선택된 옵션중에 존재한다면 필수값이 선택된것으로 확인
                    if ($.inArray(iNo, aOptionValues) > -1) {
                        bIsExists = true;
                        return;
                    }
                });

                if (bIsExists === true) {
                    iRequireSelectedOption++;
                }
            });

            //전체 필수값 갯수가 선택된 필수옵션보다 많다면 false
            if (iRequiredOption > iRequireSelectedOption) {
                return false;
            }

            this.sItemCode = aSelectedValues;
        } else if (this.validation.isSeparateOption(this.oOptionObject) === true) {
            //조합분리형은 옵션값으로 파싱해서 가져와야함
            if (parseInt(this.iOptionCount) > parseInt(this.aOptionValue.length)) {
                return false;
            }

            this.sItemCode = this.data.getItemCode(this.iProductNum, this.aOptionValue.join(this.cons.OPTION_GLUE));
        } else {
            //조합분리형 이외에는 선택한 옵션의 value가 아이템코드
            this.sItemCode = this.common.getOptionSelectedValue(this.oOptionObject);
        }

    },

    /**
     * 각 옵션을 초기화및 옵션 리스트 HTML생성
     */
    setOptionHTML : function() {
        //하위옵션이 없다면(마지막 옵션을 선택한경우) 하위옵션이 없음으로 따로 만들지 않아도 된다
        if (parseInt(this.iOptionCount) === parseInt(this.aOptionValue.length)) {
            return;
        }

        if (this.oNextOptionTarget === null) {
            return;
        }

        var sSelectedOption = this.aOptionValue.join(this.cons.OPTION_GLUE);

        var aOptions = this.data.getOptionValueArray(this.iProductNum, sSelectedOption);

        //셀렉트박스일때 다음옵션 박스 초기화
        if (this.common.isOptionStyleButton(this.oNextOptionTarget) === false) {
            this.setOptionHtmlForSelect(aOptions, sSelectedOption);
        } else {
            this.setOptionHtmlForButton(aOptions, sSelectedOption);
        }
    },

    /**
     * 버튼형 옵션일 경우 해당 버튼 HTML초기화 및 해당 옵션값 Set
     * @param aOptions 옵션값 리스트
     * @param sSelectedOption 현재까지 선택된 옵션조합
     */
    setOptionHtmlForButton : function(aOptions, sSelectedOption) {
        //선택한값이 *sk ** 이면 다음옵션을 disable처리
        if (this.validation.isItemCode(this.common.getOptionSelectedValue(this.oOptionObject)) === false) {
            this.oNextOptionTarget.find('li').removeClass(this.cons.BUTTON_OPTION_DISABLE_CLASS).addClass(this.cons.BUTTON_OPTION_DISABLE_CLASS);
        } else {
            this.oNextOptionTarget.find('li').removeClass(this.cons.BUTTON_OPTION_DISABLE_CLASS);
        }

        //연동형일경우에는 disable /  select만 제거
        if (Olnk.isLinkageType(this.sOptionType) === true) {
            //하위옵션들만 selected클래스 삭제
            if (parseInt($(this.oOptionObject).attr('option_sort_no')) < parseInt($(this.oNextOptionTarget).attr('option_sort_no'))) {
                $(this.oNextOptionTarget).find('li').removeClass(this.cons.BUTTON_OPTION_SELECTED_CLASS);
                EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(this.oNextOptionTarget, '*', false);
            }
            return;
        }

        this.oNextOptionTarget.find('li').remove('li');

        var iNextOptionSortNum = this.common.getOptionSortNum(this.oNextOptionTarget);

        var bIsLastOption = false;
        //생성될 옵션이 마지막 옵션이면 옵션 Text에 추가 항목(옵션가 품절표시등)을 처리
        if (parseInt(iNextOptionSortNum) === this.iOptionCount) {
            bIsLastOption = true;
        }

        var oObject = this;
        var sOptionsHtml = '';

        var sItemCode = false;

        //옵션 셀렉트박스 Text에 추가될 문구 처리
        var sAddText = '';
        var sItemCode = false;
        //품절옵션인데 품절옵션표시안함설정이면 삭제
        var bIsSoldout = false;
        var bIsDisplay = true;

        $(aOptions).each(function(i, oOption) {
            sAddText = '';
            bIsSoldout = false;
            bIsDisplay = true;
            //페이지 로딩시 저장된 해당 옵션의 HTML을 가져온다
            sOptionsHtml = oObject.data.getButonOptionHtml(oObject.iProductNum, iNextOptionSortNum, oOption.value);

            sOptionsHtml = $(sOptionsHtml).clone().removeClass(oObject.BUTTON_OPTION_DISABLE_CLASS);
            //마지막 옵션일 경우에는
            if (bIsLastOption === true) {
                sItemCode = oObject.data.getItemCode(oObject.iProductNum, sSelectedOption + oObject.cons.OPTION_GLUE + oOption.value);

                //진열안함이면 패스
                if (oObject.common.isDisplay(oObject.iProductNum, sItemCode) === false) {
                    bIsDisplay = false;
                }

                sAddText = oObject.setAddText(oObject.iProductNum, sItemCode);

                //품절상품인경우 품절class추가
                if (oObject.common.isSoldout(oObject.iProductNum, sItemCode) === true) {
                    $(sOptionsHtml).removeClass(oObject.cons.BUTTON_OPTION_SOLDOUT_CLASS).addClass(oObject.cons.BUTTON_OPTION_SOLDOUT_CLASS);
                    bIsSoldout = true;
                }
            } else {
                var sOptionText = sSelectedOption + oObject.cons.OPTION_GLUE + oOption.value;
                sAddText = oObject.common.getSoldoutText(oObject.oNextOptionTarget, sOptionText);

                if (sAddText !== '') {
                    $(sOptionsHtml).addClass(oObject.cons.BUTTON_OPTION_SOLDOUT_CLASS);
                    bIsSoldout = true;
                }

                if (oObject.data.getDisplayFlag(oObject.iProductNum, sOptionText) === false) {
                    bIsDisplay = false;
                }
            }

            if ((oObject.bIsDisplaySolout === false && bIsSoldout === true) || bIsDisplay === false) {
                $(this).remove();
                return;
            }

            oObject.oNextOptionTarget.append($(sOptionsHtml).attr('title', oOption.value + sAddText));
        });

        EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(this.oNextOptionTarget, '*', false);
    },

    /**
     * 셀렉트박스형 옵션일 경우 selectbox초기화 및 해당 옵션값 Set
     * @param aOptions 옵션값 리스트
     * @param sSelectedOption 현재까지 선택된 옵션조합 배열
     */
    setOptionHtmlForSelect : function(aOptions, sSelectedOption) {
        this.oNextOptionTarget.find('option').removeAttr('disabled');

        //연동형일경우에는 초기화 시키고  disable제거
        //if (Olnk.isLinkageType(this.sOptionType) === true && EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isRequireOption(this.oNextOptionTarget)) {
        if (Olnk.isLinkageType(this.sOptionType) === true) {
            var sHtml = this.data.getDefaultOptionHTML(this.common.getOptionProductNum(this.oNextOptionTarget), this.common.getOptionSortNum(this.oNextOptionTarget));
            $(this.oNextOptionTarget).find('option').remove();
            $(this.oNextOptionTarget).append(sHtml);
            $(this.oNextOptionTarget).find('option').removeAttr('disabled');
            $(this.oNextOptionTarget).val('*');
            return;
        }

        //옵션이 아닌 Default선택값을 제외하고 모두 삭제
        this.oNextOptionTarget.find('option[value!="*"][value!="**"]').remove();

        //선택한 옵션의 다음순서옵션항목
        var iNextOptionSortNum = this.common.getOptionSortNum(this.oNextOptionTarget);

        var bIsLastOption = false;
        //생성될 옵션이 마지막 옵션이면 옵션 Text에 추가 항목(옵션가 품절표시등)을 처리
        if (parseInt(iNextOptionSortNum) === this.iOptionCount) {
            bIsLastOption = true;
        }

        var oObject = this;
        var sOptionsHtml = '';

        var sItemCode = false;

        //옵션 셀렉트박스 Text에 추가될 문구 처리
        var sAddText = '';
        //품절옵션인데 품절옵션표시안함설정이면 삭제
        var bIsSoldout = false;
        $(aOptions).each(function(i, oOption) {
            sAddText = '';
            bIsSoldout = false;
            bIsDisplay = true;

            sOptionsHtml = oObject.data.getButonOptionHtml(oObject.iProductNum, iNextOptionSortNum, oOption.value);
            sOptionsHtml = $(sOptionsHtml).clone();

            //마지막 옵션일 경우에는 설정에따라 옵션title에 추가금액등의 text를 붙인다
            if (bIsLastOption === true) {
                sItemCode = oObject.data.getItemCode(oObject.iProductNum, sSelectedOption + oObject.cons.OPTION_GLUE + oOption.value);

                //진열안함이면 패스
                if (oObject.common.isDisplay(oObject.iProductNum, sItemCode) === false) {
                    bIsDisplay = false;
                }

                sAddText = oObject.setAddText(oObject.iProductNum, sItemCode);

                bIsSoldout = EC_SHOP_FRONT_NEW_OPTION_COMMON.isSoldout(oObject.iProductNum, sItemCode);
            } else {
                //품절문구(각 옵션마다도 보여줘야함...)
                var sOptionText = sSelectedOption + oObject.cons.OPTION_GLUE + oOption.value;
                sAddText = oObject.common.getSoldoutText(oObject.oNextOptionTarget, sOptionText);
                bIsSoldout = (sAddText === '') ? false : true;

                if (oObject.data.getDisplayFlag(oObject.iProductNum, sOptionText) === false) {
                    bIsDisplay = false;
                }
            }

            if ((oObject.bIsDisplaySolout === false && bIsSoldout === true) || bIsDisplay === false) {
                $(this).remove();
                return;
            }

            $(sOptionsHtml).val(oOption.value);
            $(sOptionsHtml).removeAttr('disabled');
            $(sOptionsHtml).text(oOption.value + sAddText);

            oObject.oNextOptionTarget.append($(sOptionsHtml));
        });
    },

    /**
     * 마지막 옵션에 추가될 추가항목들(추가금액, 품절 등)
     * @param iProductNum 상품번호
     * @param sItemCode 아이템 코드
     * @param oOptionElement 옵션셀렉트박스를 임의로 지정할경우
     */
    setAddText : function(iProductNum, sItemCode, oOptionElement) {
        var aText = [];

        if (typeof(oOptionElement) !== 'object') {
            var oOptionElement = this.oOptionObject;
        }

        $(this.aExtraOptionText).each(function() {
            if (typeof(this.get) === 'function') {
                aText.push(this.get(iProductNum, sItemCode, oOptionElement));
            }
        });

        return aText.join('');
    },

    /**
     * 옵션 선택박스(셀렉트박스나 버튼)에 click 또는 change에 대한 이벤트 할당
     */
    initChooseBox : function() {
        this.cons = EC_SHOP_FRONT_NEW_OPTION_CONS;
        this.common = EC_SHOP_FRONT_NEW_OPTION_COMMON;
        this.data = EC_SHOP_FRONT_NEW_OPTION_DATA;
        this.validation = EC_SHOP_FRONT_NEW_OPTION_VALIDATION;

        var oThis = this;

        //live로 할경우에 기존 이벤트가 없어짐.
        $('select[option_select_element="ec-option-select-finder"]').unbind().change(function() {
            if (oThis.common.isOptionStyleButton(this) === true) {
                return false;
            }

            //페이지 로드가 되었는지 확인.
            if (typeof(oThis.common.isLoad) === false) {
                $(this).val('*');
                return false;
            }

            oThis.initialize(this, this);
        });

        $('ul[option_select_element="ec-option-select-finder"] > li').unbind().live('click', function(e) {
            var oOptionChoose = $(this).parent('ul');

            /*
                ECHOSTING-194895 처리를 위해 삭제 (추가 이미지 클릭 시 해당 품목 선택 기능)
                if (e.target.tagName === 'LI') {
                    return false;
                }
            */

            if (EC_SHOP_FRONT_NEW_OPTION_COMMON.isOptionStyleButton(oOptionChoose) === false) {
                return false;
            }

            //페이지 로드가 되었는지 확인.
            if (typeof(EC_SHOP_FRONT_NEW_OPTION_COMMON.isLoad) === false) {
                return false;
            }

            //라디오버튼일경우 label태그에 상속되기때문에 click이벤트가 label input에 대해 두번 발생함
            //라디오버튼 속성이면서 발생위치가 label이면 이벤트 발생하지않고 그냥 return
            //return false이면 label클릭시 checked가 안되니깐 그냥 return
            //input 태그 자체에 이벤트를 주면 상관없지만 li태그에 이벤트를 할당하기때문에 생기는 현상같음
            if (oThis.common.isOptionStyle(oOptionChoose, oThis.cons.OPTION_STYLE_RADIO) === true && e.target.tagName.toUpperCase() === 'LABEL') {
                return;
            }

            oThis.initialize($(this).parent('ul'), this);
        });
    },

    /**
     * 멀팁옵션에서 옵션추가시 이벤트 재정의(버튼형은 live로 되어있으니 상관없고 select형만)
     * @param oOptionElement
     */
    initChooseBoxMulti : function(oOptionElement)
    {
        var oThis = this;

        //live로 할경우에 기존 이벤트가 없어짐.
        $('.xans-product-multioption select[option_select_element="ec-option-select-finder"]').unbind().change(function() {
            if (oThis.common.isOptionStyleButton(this) === true) {
                return false;
            }

            //페이지 로드가 되었는지 확인.
            if (typeof(oThis.common.isLoad) === false) {
                $(this).val('*');
                return false;
            }

            oThis.initialize(this, this);
        });
    },

    /**
     * 옵션 선택시 필요한 attribute값등을 SET
     */
    setSelectedOptionConf : function() {
        //선택한 옵션 그룹
        this.sOptionGroup = this.common.getOptionSelectGroup(this.oOptionObject);

        //선택한 옵션값 순번
        this.iOptionIndex = parseInt(this.common.getOptionSortNum(this.oOptionObject));

        //선택한 옵션 스타일
        this.sOptionStyle = $(this.oOptionObject).attr(this.cons.OPTION_STYLE);

        //현재까지 선택한 옵션의 value값을 가져온다
        this.aOptionValue = this.common.getAllSelectedValue(this.oOptionObject);

        //상풉번호
        this.iProductNum = this.common.getOptionProductNum(this.oOptionObject);

        //옵션타입
        this.sOptionType = this.common.getOptionType(this.oOptionObject);

        //품절 옵션 표시여부
        this.bIsDisplaySolout = this.validation.isSoldoutOptionDisplay();

        //선택한 옵션의 다음 옵션 Element
        //선택옵션을 제거한 다음옵션
        //1 : 필수, 2 : 선택, 3 : 필수일때 1번옵션 선택후 다음옵션을 3번(연동형)
        //[option_sort_no"'+this.iOptionIndex+'"]
        oThis = this;
        this.oNextOptionTarget = null;
        $('[product_option_area="'+this.sOptionGroup+'"][option_product_no="'+this.iProductNum+'"]').each(function() {
            //현재선택한 옵션의 하위옵션이 아니라 상위옵션이면 패스
            if (oThis.iOptionIndex >= parseInt(oThis.common.getOptionSortNum(this))) {
                return true;//continue
            }
            //선택옵션이면 패스
            if (oThis.validation.isRequireOption(this) === false) {
                return true;
            }

            oThis.oNextOptionTarget = $(this);
            return false;//break
        });

        //옵션 갯수
        this.iOptionCount = $('[product_option_area="'+this.sOptionGroup+'"]').length;
    },

    /**
     * 버튼식 옵션일 경우 선택한 옵션을 선택처리
     */
    setSelectButton : function(oSelectedOption, bIsUnset) {
        if (this.common.isOptionStyleButton(this.oOptionObject) === true) {
            //모두 선택이 안된상태로 이벤트 실행할수있도록 selected css를 지우고 리턴
            if (bIsUnset === true) {
                $(oSelectedOption).removeClass(this.cons.BUTTON_OPTION_SELECTED_CLASS);
                return;
            }

            //이미 선택한 옵션값을 다시 클릭시에는 선택해제
            if ($(oSelectedOption).hasClass(this.cons.BUTTON_OPTION_SELECTED_CLASS) === true) {
                $(oSelectedOption).removeClass(this.cons.BUTTON_OPTION_SELECTED_CLASS);
                this.common.setValue(this.oOptionObject, '*', false);
                this.setRadioButtonSelect(oSelectedOption, this.oOptionObject, false);
            } else {
                //버튼형식의  옵션일 경우 선택한 옵션을 선택처리(class 명을 추가)
                //선택불가일때는 선택된상태로 보이지 않도록 하고 클리만 가능하도록 한다
                //disable상태이면 선택CSS는 적용되지 않게 처리
                var oTargetOptionElement = $(oSelectedOption).parent('ul');
                var sDevID = $(oTargetOptionElement).attr('ec-dev-id');
                var self = this;

                //조합일체형에서 구분선이 있을경우 ul태그가 따로있지만 동일옵션이므로
                //동일 ul을 구해서 모두 unselect시킨다
                $(oTargetOptionElement).parent().find('ul[ec-dev-id="'+sDevID+'"]').each(function() {
                    $(this).find('li').removeClass(self.cons.BUTTON_OPTION_SELECTED_CLASS);
                });

                $(oSelectedOption).addClass(this.cons.BUTTON_OPTION_SELECTED_CLASS);
                this.setRadioButtonSelect(oSelectedOption, this.oOptionObject, true);
            }
        } else {
            //셀렉트박스형 옵션일 경우 **를 선택했다면 옵션초기화
            if (this.validation.isItemCode($(this.oOptionObject).val()) === false) {
                $(this.oOptionObject).val('*');
            }
        }
    },

    /**
     * Disable인 옵션일 경우 체크박스를 다시 해제함
     * @param oSelectedOption
     * @param oOptionObject
     * @param bIsCheck
     */
    setRadioButtonSelect : function(oSelectedOption, oOptionObject, bIsCheck)
    {
        if (EC_SHOP_FRONT_NEW_OPTION_COMMON.isOptionStyle(oOptionObject, EC_SHOP_FRONT_NEW_OPTION_CONS.OPTION_STYLE_RADIO) === false) {
            return;
        }

        $(oOptionObject).find('input:radio').attr('checked', '');

        //재선택시 체크해제하려면 e107c06faf31 참고
        if (bIsCheck === true) {
            $(oSelectedOption).find('input:radio').attr('checked', 'checked');
        }
    }
};

var EC_SHOP_FRONT_NEW_OPTION_DATA = {

    /**
     * EC_SHOP_FRONT_NEW_OPTION_CONS 객체 Alias
     */
    cons : EC_SHOP_FRONT_NEW_OPTION_CONS,

    /**
     * EC_SHOP_FRONT_NEW_OPTION_COMMON 객체 Alias
     */
    common : EC_SHOP_FRONT_NEW_OPTION_COMMON,

    /**
     * 옵션값관 아이템코드 매칭 데이터(option_value_mapper)
     */
    aOptioValueMapper : [],

    /**
     * 각 선택된 옵션값에대한 다음옵션값 리스트를 저장
     * aOptionValueData[상품번호][빨강#$%대형] = array(key : 1, value : 옵션값, text : 옵션 Text)
     */
    aOptionValueData : {},

    /**
     * 각 상품의 품목데이터(재고 및 추가금액 정보)
     */
    aItemStockData : {},

    /**
     * 옵션의 디폴트 HTML을 저장해둠
     */
    aOptionDefaultData : {},

    /**
     * 디폴트 옵션을 저장할떄 중복을 제거하기위해서 추가
     */
    aCacheDefaultProduct : [],

    /**
     * 버튼형 옵션 Element저장시 중복제거
     */
    aCacheButtonOption : [],

    /**
     * 버튼형 옵션의 경우 각 옵션값별 컬러칩/버튼이미지/버튼이름등을 저장해둔다
     */
    aButtonOptionDefaultData : [],

    /**
     * 추가금액 노출 설정
     */
    aOptionPriceDisplayConf : [],

    /**
     * 연동형 옵션의 옵션내용을 저장
     */
    aOlnkOptionData : [],

    /**
     * 각 옵션(품목이 아닌)마다 모두 품절이면 품절표시를 위해서 추가...
     */
    aOptionSoldoutFlag : [],

    /**
     * 각 옵션(품목이 아닌)마다 모두 진열안함이면 false로 나오지 않게 하기 위해서 추가
     */
    aOptionDisplayFlag : [],

    /**
     * 페이지 로딩시 각 옵션선택박스의 옵션정보를 Parse
     */
    initData : function() {
        var oThis = this;
        $('select[option_select_element="ec-option-select-finder"], ul[option_select_element="ec-option-select-finder"]').each(function() {
            //해당 옵션의 상품번호
            var iProductNum = oThis.common.getOptionProductNum(this);
            //해당 옵션의 옵션순서번호
            var iOptionSortNum = oThis.common.getOptionSortNum(this);

            var sCacheKey = iProductNum + oThis.cons.OPTION_GLUE + iOptionSortNum;

            EC_SHOP_FRONT_NEW_OPTION_DATA.initializeOption(this, sCacheKey);

            //버튼형 옵션일 경우 각 Element를 캐싱
            if (EC_SHOP_FRONT_NEW_OPTION_COMMON.isOptionStyleButton(this) === true) {
                EC_SHOP_FRONT_NEW_OPTION_DATA.initializeOptionForButtonOption(this, sCacheKey);
            } else {
                EC_SHOP_FRONT_NEW_OPTION_DATA.initializeOptionForSelectOption(this, sCacheKey);
                //일반 셀렉트의 경우 기본값 (*, **)을 제외하고 삭제
                //첫번째 필수값은 option들이 disable이 아니므로 disable된 옵션들만 삭제
                var bIsProcLoading = true;

                //필수옵션만 삭제
                if (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isRequireOption(this) === false) {
                    bIsProcLoading = false;
                }

                //disable만 풀어준다
                //연동형이지만 옵션추가버튼 사용시에는 지우지 않음...
                //기본으로 선택된값이 있다면 지우지 않음(구스킨 관심상품, 뉴스킨 장바구니등에서는 일단 선택한 옵션을 보여주고 선택후부터 순차로딩)
                var sValue = $(this).find('option[selected="selected"]').attr('value');
                if (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isItemCode(sValue) === true || (Olnk.isLinkageType(oThis.common.getOptionType(this)) === true && (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isUseOlnkButton() === true || EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isBindUseOlnkButton(iProductNum) === true))) {
                    bIsProcLoading = false
                    $(this).find('option').removeAttr('disabled');
                }

                if (bIsProcLoading === true) {
                    $(this).find('option[value!="*"][value!="**"]:disabled').remove('option');
                }
            }
        });
    },

    /**
     * 각 상품의 옵션 디폴트 옵션 HTML을 저장해둔다
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     */
    initializeOption : function(oOptionChoose, sCacheKey) {
        //이미 데이터가 있다면 패스
        if ($.inArray(sCacheKey, this.aCacheDefaultProduct) > -1) {
            return;
        }

        this.aCacheDefaultProduct.push(sCacheKey);
        this.aOptionDefaultData[sCacheKey] = $(oOptionChoose).html();
    },

    initializeOptionForSelectOption : function(oOptionChoose, sCacheKey) {
        var iProductNum = $(oOptionChoose).attr('option_product_no');
        var oThis = this;
        //같은 상품이 여러개있을수있으므로 이미 캐싱이 안된 상품만
        if ($.inArray(sCacheKey, this.aCacheButtonOption) < 0) {
            var bDisabled = false;
            if (Olnk.isLinkageType(this.common.getOptionType(oOptionChoose)) === true && (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isUseOlnkButton() === true || EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isBindUseOlnkButton(iProductNum) === true)) {
                bDisabled = true;
            }

            this.aCacheButtonOption.push(sCacheKey);
            this.aButtonOptionDefaultData[sCacheKey] = [];

            $(oOptionChoose).find('option').each(function() {
                if (bDisabled === true) {
                    $(this).removeAttr('disabled');
                }
                oThis.aButtonOptionDefaultData[sCacheKey][$(this).val()] = $('<div>').append($(this).clone()).html();
            });
        }
    },

    /**
     * 셀렉트박스 형식이 아닌 버튼이나 이미지형 옵션일 경우 HTML자체를 옵션값 별로 저장해둔다.
     * writejs쓰기싫음여
     */
    initializeOptionForButtonOption : function(oOptionChoose, sCacheKey) {
        var oThis = this;
        var iProductNum = $(oOptionChoose).attr('option_product_no');
        //같은 상품이 여러개있을수있으므로 이미 캐싱이 안된 상품만
        if ($.inArray(sCacheKey, this.aCacheButtonOption) < 0) {
            var bDisabled = false;
            if (Olnk.isLinkageType(this.common.getOptionType(oOptionChoose)) === true && (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isUseOlnkButton() === true || EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isBindUseOlnkButton(iProductNum) === true)) {
                bDisabled = true;
            }

            this.aCacheButtonOption.push(sCacheKey);
            this.aButtonOptionDefaultData[sCacheKey] = [];

            $(oOptionChoose).find('li').each(function() {
                if (bDisabled === true) {
                    $(this).removeClass(EC_SHOP_FRONT_NEW_OPTION_CONS.BUTTON_OPTION_DISABLE_CLASS);
                }
                oThis.aButtonOptionDefaultData[sCacheKey][$(this).attr('option_value')] = $('<div>').append($(this).clone()).html();
            });
        }

        var sSelect = '<select product_option_area_select="'+$(oOptionChoose).attr('product_option_area')+'"';
        sSelect += ' id="'+$(oOptionChoose).attr('ec-dev-id')+'"';
        sSelect += ' name="'+$(oOptionChoose).attr('ec-dev-name')+'"';
        sSelect += ' option_title="'+$(oOptionChoose).attr('option_title')+'"';
        sSelect += ' option_type="'+$(oOptionChoose).attr('option_type')+'"';
        sSelect += ' item_listing_type="'+$(oOptionChoose).attr('item_listing_type')+'"';

        if (typeof($(oOptionChoose).attr('ec-dev-class')) !== 'undefined') {
            sSelect += ' class="'+$(oOptionChoose).attr('ec-dev-class')+'"';
        }

        if (typeof($(oOptionChoose).attr('option_code')) !== 'undefined') {
            sSelect += ' option_code="'+$(oOptionChoose).attr('option_code')+'"';
        }
        sSelect += ' style="display:none;"';
        if (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isRequireOption(oOptionChoose) === true) {
            sSelect += ' required="true">';
        } else {
            sSelect += '>';
        }

        var oTriggerSelect = $(sSelect);

        oTriggerSelect.append($('<option>').attr('value', '*').text('empty'));

        var sTitle = '';
        var sValue = '';
        for (x in this.aButtonOptionDefaultData[sCacheKey]) {
            //IE8..
            if (x !== 'indexOf') {
                sTitle = $(oThis.aButtonOptionDefaultData[sCacheKey][x]).attr('title');
                sValue = $(oThis.aButtonOptionDefaultData[sCacheKey][x]).attr('option_value');

                oTriggerSelect.append($('<option>').attr('value', sValue).text(sTitle));
            }
        }

        oTriggerSelect.val('*');
        $(oOptionChoose).parent().append(oTriggerSelect);
    },

    /**
     * 버튼형 옵션의 상품 옵션값에 대한 옵션 HTML을 반환
     * @param iProductNum 상품번호
     * @param iOptionSortNum 옵션순서
     * @param sOptionValue 옵션값
     * @returns 해당 옵션값에 대한 버튼 HTML
     */
    getButonOptionHtml : function(iProductNum, iOptionSortNum, sOptionValue) {
        var sCacheKey = iProductNum + this.cons.OPTION_GLUE + iOptionSortNum;

        //없을경우에는 다시 초기화
        if (typeof(this.aButtonOptionDefaultData[sCacheKey]) === 'undefinde') {
            this.initData();
        }

        if (typeof(this.aButtonOptionDefaultData[sCacheKey][sOptionValue]) === 'undefinde') {
            return false;
        }

        return this.aButtonOptionDefaultData[sCacheKey][sOptionValue];
    },

    /**
     * 옵션을 선택하지 않았을때 하위옵션을 초기화하기위해서 디폴트 HTML을 가져옴
     * @param iProductNum 상품번호
     * @param iOptionSortNum 옵션 순서
     */
    getDefaultOptionHTML : function(iProductNum, iOptionSortNum)
    {
        var sCacheKey = iProductNum + this.cons.OPTION_GLUE + iOptionSortNum;

        if (typeof(this.aOptionDefaultData[sCacheKey]) === 'undefined') {
            return;
        }

        return this.aOptionDefaultData[sCacheKey];
    },

    /**
     * 해당 상품의 옵션 재고 관련 데이터를 리턴
     * @param iProductNum 상품번호
     */
    getProductStockData : function(iProductNum) {
        if (typeof(this.aItemStockData[iProductNum]) === 'undefined') {
            try {
                this.aItemStockData[iProductNum] = $.parseJSON(eval('option_stock_data' + iProductNum));
            } catch (e) {}
        }

        if (this.aItemStockData.hasOwnProperty(iProductNum) === false) {
            return null;
        }

        return this.aItemStockData[iProductNum];
    },

    /**
     * 옵션이 모두 선택되었다면 옵션값 리턴
     * @param iProductNum 상품번호
     * @param sSelectedOptionValue 선택된 전체 옵션값
     * @returns 아이템코드
     */
    getItemCode : function(iProductNum, sSelectedOptionValue) {
        if (typeof(this.aOptioValueMapper[iProductNum]) === 'undefined') {
            return false;
        }

        if (typeof(this.aOptioValueMapper[iProductNum][sSelectedOptionValue]) === 'undefined') {
            return false;
        }

        return this.aOptioValueMapper[iProductNum][sSelectedOptionValue];
    },

    /**
     * 해당 상품의 선택된 옵션의 하위 옵션을 리턴
     * @param iProductNum 상품번호
     * @param sSelectedValue 현재까지 선택된 옵션값 String(옵션1값 + EC_SHOP_FRONT_NEW_OPTION_CONS.OPTION_GLUE + 옵션2값 형식)
     * @returns 옵션리스트
     */
    getOptionValueArray : function(iProductNum, sSelectedValue) {
        if (typeof(this.aOptionValueData[iProductNum]) === 'undefined') {
            return false;
        }

        if (typeof(this.aOptionValueData[iProductNum][sSelectedValue]) === 'undefined') {
            return false;
        }

        return this.aOptionValueData[iProductNum][sSelectedValue];
    },

    /**
     * 옵션 생성에 필요한 기본데이터 정의
     */
    setDefaultData : function() {
        if (typeof(option_stock_data) !== 'undefined') {
            this.aItemStockData[iProductNo] = $.parseJSON(option_stock_data);
        }
        if (typeof(option_value_mapper) !== 'undefined') {
            this.aOptioValueMapper[iProductNo] = $.parseJSON(option_value_mapper);
        }
        if (typeof(product_option_price_display) !== 'undefined') {
            this.aOptionPriceDisplayConf[iProductNo] = product_option_price_display;
        }

        if (typeof(add_option_data) !== 'undefined') {
            var aAddOptionJson = $.parseJSON(add_option_data);
            var oThis = this;
            for (iProductNum in aAddOptionJson) {
                this.aItemStockData[iProductNum] = $.parseJSON(aAddOptionJson[iProductNum].option_stock_data);
                if (typeof(aAddOptionJson[iProductNum].option_value_mapper) !== 'undefined') {
                    this.aOptioValueMapper[iProductNum] = $.parseJSON(aAddOptionJson[iProductNum].option_value_mapper);
                }

                this.aOptionPriceDisplayConf[iProductNum] = aAddOptionJson[iProductNum].product_option_price_display;
            }
        }

        if (typeof(set_option_data) !== 'undefined') {
            var aSetProductData = $.parseJSON(set_option_data);
            var oThis = this;
            for (iProductNum in aSetProductData) {
                this.aItemStockData[iProductNum] = $.parseJSON(aSetProductData[iProductNum].option_stock_data);

                if (typeof(aSetProductData[iProductNum].option_value_mapper) !== 'undefined') {
                    this.aOptioValueMapper[iProductNum] = $.parseJSON(aSetProductData[iProductNum].option_value_mapper);
                }

                this.aOptionPriceDisplayConf[iProductNum] = aSetProductData[iProductNum].product_option_price_display;
            }
        }
    },

    /**
     * 이벤트 옵션의 다음옵션값을 세팅
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     */
    initializeOptionValue : function(oOptionChoose) {
        //상품번호
        var iProductNum = this.common.getOptionProductNum(oOptionChoose);

        //현재까지 선택된 옵션값 배열
        var aSelectedValue = this.common.getAllSelectedValue(oOptionChoose);

        var sSelectedValue = aSelectedValue.join(this.cons.OPTION_GLUE);

        //기존 선언되지 않은 옵션에대한 처리면 뱌열로 미리 선언
        //이미 옵션값이 set되어있으면 바로 리턴
        if (typeof(this.aOptionValueData[iProductNum]) === 'undefined') {
            this.aOptionValueData[iProductNum] = {};
        }
        if (typeof(this.aOptionValueData[iProductNum][sSelectedValue]) === 'undefined') {
            this.aOptionValueData[iProductNum][sSelectedValue] = new Array();
        } else {
            return;
        }

        //선택한 옵션의 순번
        var iOptionSortNum = this.common.getOptionSortNum(oOptionChoose);

        //옵션값 순서
        var iCnt = 1;
        //중복옵션값 제거하기 위해서 저장할 옵션값
        var aCheckDuplicate = [];
        var sOptionValue = '';
        var sText = '';

        //장바구니 관심상품쪽은 데이터가 이렇게되어있어서 페이지로드시에 어떻게 할수가 없네요..
        if (typeof(this.aOptioValueMapper[iProductNum]) === 'undefined') {
            this.aOptioValueMapper[iProductNum] = $.parseJSON(eval("option_value_mapper" + iProductNum));
        }

        for (var x in this.aOptioValueMapper[iProductNum]) {

            //옵션값을 구분자에 따라 배열로 분리(옵션값 => 아이템코드 형태
            var aOptions = x.split(EC_SHOP_FRONT_NEW_OPTION_CONS.OPTION_GLUE);

            //옵션값에서 기선택된 값과 비교하기위한 옵션값
            sOptionValue = aOptions.splice(0, iOptionSortNum).join(this.cons.OPTION_GLUE);

            //첫번째옵션부터 마지막선택한 옵션까지의 옵션값이 똑같으면서 기존처리된 옵션값이 아니라면 배열에 저장
            if (String(sOptionValue) === String(sSelectedValue) && $.inArray(aOptions[0], aCheckDuplicate) < 0) {
                this.aOptionValueData[iProductNum][sSelectedValue].push({key : iCnt, value : aOptions[0]});
                iCnt++;
                aCheckDuplicate.push(aOptions[0]);
            }
        }
    },

    /**
     * 각 옵션값의 전체품절 여부
     * @param iProductNum 상품번호
     * @param sValue 옵션값
     * @returns
     */
    getSoldoutFlag : function(iProductNum, sValue) {
        if (typeof(this.aOptionSoldoutFlag[iProductNum][sValue]) === 'undefined') {
            return false;
        }

        return this.aOptionSoldoutFlag[iProductNum][sValue];
    },

    /**
     * 각 옵션값의 진열 여부
     * @param iProductNum 상품번호
     * @param sValue 옵션값
     * @returns
     */
    getDisplayFlag : function(iProductNum, sValue) {

        if (typeof(this.aOptionDisplayFlag[iProductNum][sValue]) === 'undefined') {
            return false;
        }

        return this.aOptionDisplayFlag[iProductNum][sValue];
    },

    /**
     * 각각의 옵션값(품목말고)마다 해당 옵션전체가 품절인지 체크...
     * @param oOptionChoose
     */
    initializeSoldoutFlag : function(oOptionChoose) {
        //해당 옵션의 상품번호
        var iProductNum = this.common.getOptionProductNum(oOptionChoose);
        //해당 옵션의 옵션순서번호
        var iOptionSortNum = this.common.getOptionSortNum(oOptionChoose);

        if (typeof(this.aOptionSoldoutFlag[iProductNum]) === 'undefined') {
            this.aOptionSoldoutFlag[iProductNum] = [];
        }

        if (typeof(this.aOptionDisplayFlag[iProductNum]) === 'undefined') {
            this.aOptionDisplayFlag[iProductNum] = [];
        }

        //장바구니 관심상품쪽은 데이터가 이렇게되어있어서 페이지로드시에 어떻게 할수가 없네요..
        if (typeof(this.aOptioValueMapper[iProductNum]) === 'undefined') {
            this.aOptioValueMapper[iProductNum] = $.parseJSON(eval("option_value_mapper" + iProductNum));
        }

        var aStockData = this.getProductStockData(iProductNum);

        for (var x in this.aOptioValueMapper[iProductNum]) {
            //옵션값을 구분자에 따라 배열로 분리(옵션값 => 아이템코드 형태
            var aOptions = x.split(EC_SHOP_FRONT_NEW_OPTION_CONS.OPTION_GLUE);

            var bIsSoldout = EC_SHOP_FRONT_NEW_OPTION_COMMON.isSoldout(iProductNum, this.aOptioValueMapper[iProductNum][x]);

            var bIsDisplay = EC_SHOP_FRONT_NEW_OPTION_COMMON.isDisplay(iProductNum, this.aOptioValueMapper[iProductNum][x]);

            for (var i = 1; i <= $(aOptions).length; i++) {
                var sOption = aOptions.slice(0, i).join(EC_SHOP_FRONT_NEW_OPTION_CONS.OPTION_GLUE);

                //일단 품절로 세팅하고 품절이 아닌게 하나라도있다면 false로 바꿔준다
                if (typeof(this.aOptionSoldoutFlag[iProductNum][sOption]) === 'undefined') {
                    this.aOptionSoldoutFlag[iProductNum][sOption] = true;
                }

                if (bIsSoldout === false) {
                    this.aOptionSoldoutFlag[iProductNum][sOption] = false;
                }

                //일단 진열안함으로 세팅후에 한개라도 진열함이있다면 true바꿔줌다
                if (typeof(this.aOptionSoldoutFlag[iProductNum][sOption]) === 'undefined') {
                    this.aOptionDisplayFlag[iProductNum][sOption] = false;
                }

                if (bIsDisplay === true) {
                    this.aOptionDisplayFlag[iProductNum][sOption] = true;
                }
            }
        }
    }
};

var EC_SHOP_FRONT_NEW_OPTION_VALIDATION = {
    /**
     * EC_SHOP_FRONT_NEW_OPTION_COMMON Obejct Alias
     */
    common : EC_SHOP_FRONT_NEW_OPTION_COMMON,

    cons : EC_SHOP_FRONT_NEW_OPTION_CONS,

    /**
     * 해당 옵션 그룹에 필수옵션이 속해있는지 여부 확인
     * @param sOptionGroup 옵션 그룹 (@see : EC_SHOP_FRONT_NEW_OPTION_GROUP_CONS)
     * @returns 필수옵션 존재 여부
     */
    checkRequiredOption : function(sOptionGroup) {
        //해당 옵션 그룹의 필수옵션 갯수
        var iRequiredOption = $(this.common.getRequiredOption(sOptionGroup)).length;

        return (parseInt(iRequiredOption) > 0) ? true : false;
    },

    /**
     * 해당 옵션이 필수옵션인지 확인
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     */
    isRequireOption : function(oOptionChoose) {
        return (Boolean($(oOptionChoose).attr('required')) === true) ? true : false;
    },

    /**
     * 해당 값이 아이템코드인지 확인
     * @param sItemCode 선택한 아이템코드
     * @returns true이면 아이템코드
     * @todo 아이템코드 정규식을 추가..해야하나?? 그래야한다면 선택값여부를(*, **) 따로두고 실제 아이템코드인지 여부를 더 확인해야함
     */
    isItemCode : function(sItemCode) {
        return ($.inArray(sItemCode, ['*', '**']) > -1 || typeof(sItemCode) === 'undefined') ? false : true;
    },

    /**
     * 옵션값이 선택되어있는지 확인
     * @param oOptionChoose 값을 가져오려는 옵션박스 object
     */
    isOptionSelected : function(oOptionChoose) {
        return ($.inArray(this.common.getOptionSelectedValue(oOptionChoose), ['*', '**']) > -1) ? false : true;
    },
    
    /**
     * 옵션그룹에서 하나라도 선택이 되었는지 확인
     */
    isOptionGroupSelected : function(sOptionGroup)
    {
        var oThis = this;
        var bIsChoosen = false;
        $('[' + this.cons.GROUP_ATTR_NAME + '^="' + sOptionGroup + '"]').each(function() {
            if (oThis.isOptionSelected(this) === true) {
                bIsChoosen = true;
                return false;
            }
        });
        return bIsChoosen;
    },
    
    /**
     * 필수 옵션이 모두 선택된 상태인지 여부 확인
     * @param sItemCode 선택한 아이템코드
     * @returns true이면 아이템코드
     */
    isSelectedRequiredOption : function(sOptionGroup) {
        //필수옵션이 하나도 없다면 바로 true
        if (this.checkRequiredOption(sOptionGroup) === false) {
            return true;
        }

        var oThis = this;
        var bIsComplete = true;
        $('[' + this.cons.GROUP_ATTR_NAME + '^="' + sOptionGroup + '"]').each(function() {

            //핑수옵션이지만 값이 선택되지 않았을경우 false
            if (oThis.isRequireOption(this) === true && oThis.isOptionSelected(this) === false) {
                bIsComplete = false;
                return false;
            }
        });

        return bIsComplete;
    },

    /**
     * 조합분리형만 아이템코드를 가져오는방식이 틀려서 확인용을 추가(연동형도 일단 조합분리형으로 인식하도록 함)
     * @param oOptionChoose 구분할 옵션박스 object
     * @returns true => 조합분리형, false => 기타옵션타입
     */
    isSeparateOption : function(oOptionChoose) {
        var sOptionTypeStr = $(oOptionChoose).attr('option_type');
        var sOptionListStr = $(oOptionChoose).attr('item_listing_type');
        return (Olnk.isLinkageType(sOptionTypeStr) === true || (sOptionTypeStr === 'T' && sOptionListStr === 'S')) ? true : false;
    },

    /**
     * 연동형 옵션 추가 버튼 사용설정을 사용하면 또 순차로딩 하지 않음
     * @returns
     */
    isUseOlnkButton : function() {
        return Olnk.getOptionPushbutton($('#option_push_button'));
    },
    /**
     * 세트상품에서 연동형 옵션 추가 버튼 사용설정을 사용하면 또 순차로딩 하지 않음
     * @returns
     */
    isBindUseOlnkButton : function(iProductNum) {
        return $('#add_option_push_button_'+iProductNum).size() > 0;
    },
    isSoldoutOptionDisplay : function() {
        return (typeof(bIsDisplaySoldoutOption) !== 'undefined') ? bIsDisplaySoldoutOption : true;
    }
};
//수량 input id
var quantity_id = '#quantity:not(.ec-debug)';
var bRestockChange = false;

$(document).ready(function()
{
    if ($('.ec-product-couponAjax').length > 0) {
        getPrdDetailNewAjax();
    }

    // ECHOSTING-90301 모바일 zoom.html 페이지에서 에러 - 예외처리
    try { TotalAddSale.setParam('product_no', iProductNo); } catch (e) {}

    $("select[id*='product_option_id']").each ( function () {
        $(this).val('*');

    });

    // 디자인 마이그레이션 - 이걸 여기서 해야할까..
    if ($('#NewProductQuantityDummy').length > 0 && $('#totalProducts').length > 0) {
        $('#NewProductQuantityDummy').parents('tr').remove();
    }
    // 수량 초기화
    $(quantity_id).val(EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getProductMinQuantity());
    $('input.single-quantity-input[product-no='+iProductNo+']').val(EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getProductMinQuantity());

    // 판매가 초기화
    setPrice(true, false, '');

    // 배송타입 초기화
    if (delvtype == 'A') {
        $('#delv_type_A').attr('checked','checked');
    }

    // 배송타입 선택
    $('[id^="delv_type_"]').change(function()
    {
        delvtype = $(this).val();

        // 해외배송이면 선결제 고정
        if (delvtype == 'B') {
            $('#delivery_cost_prepaid').val('P');
            if ($('.delv_price_C').length > 0) {
                $('.delv_price_B').hide();
                $('.delv_price_C').show();
            }
            try {
                if (document.getElementById('NaverChk_Button') != null) {
                    document.getElementById('NaverChk_Button').style.display = 'none';
                }
            } catch (e) {}
        } else {
            $('.delv_price_B').show();
            $('.delv_price_C').hide();
            try {
                if (document.getElementById('NaverChk_Button') != null) {
                    document.getElementById('NaverChk_Button').style.display = '';
                }
            } catch (e) {}
        }

    });

    // 해외 배송 전용 상품은 hidden값 처리
    if ($('[name="delv_type"]:hidden:not(:radio)').length > 0) {
        if ($('input:radio[id^="delv_type_"]').is(':visible') === true) {
            delvtype = $('input:radio[id^="delv_type_"]:checked').val();
        } else {
            delvtype = 'B';
        }
    }

    if (oSingleSelection.isItemSelectionTypeS() === true) {
        // 본체 상품만
        oSingleSelection.setProductTargetKey();

        $('input.single-quantity-input, img.quantity-handle.product-no-'+iProductNo).live('click change', function() {
            oSingleSelection.setProductTargetKey($(this));
            var iBuyUnit  = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getBuyUnitQuantity();
            var iQuantity = parseInt(oSingleSelection.getQuantityInput($(this)).val(),10);
            if ($(this).hasClass('up') === true) {
                iQuantity = iQuantity + iBuyUnit;
            } else if ($(this).hasClass('down') === true) {
                iQuantity = iQuantity - iBuyUnit;
            }
            var sQuantityInputSelector = ':text';
            var sContext = 'tr[target-key='+oSingleSelection.getProductTargetKey()+']';
            if (mobileWeb === true) {
                sQuantityInputSelector = '[type=number]';
                if (has_option === 'F') {
                    sContext = '';
                    sQuantityInputSelector = quantity_id+'[type=tel]';
                }
            } else {
                if (has_option === 'F') {
                    sContext = '#totalProducts tbody:not(.add_products)';
                }
            }

            $('input'+sQuantityInputSelector, sContext).not('.ec-debug').val(iQuantity).trigger('change');
        });
    }


    // 수량 증감 버튼(옵션 없는 상품)
    $('.QuantityUp' + ',' + '.QuantityDown' + ',' + quantity_id+':not(.ec-debug)', ((mobileWeb === true || isNewProductSkin() === false) ? '' :'#totalProducts')).live({
        click: function() {
            setQuantity('click', this);
        },
        change: function() {
            setQuantity('change', this);
        }
    });

    // 옵션박스 수량 증감 버튼
    $('.eProductQuantityClass' + ',' + '.option_box_up' + ',' + '.option_box_down').live({
        click: function() {
            if ($(this).hasClass('eProductQuantityClass') === true) {
                return;
            }
            setOptionBoxQuantity('click', this);
        },
        change: function(e) {
            e.preventDefault();
            if ($(this).hasClass('single-quantity-input') === false && $(this).hasClass('eProductQuantityClass') === false) {
                return;
            }
            setOptionBoxQuantity('change', this);
        }
    });

    // 옵션박스 선택상품 삭제
    $('.option_box_del').live('click', function() {
        // onlyone 옵션 셀렉트 박스 원복
        var eSelectedItem = $('#'+$(this).attr('id').replace('_del','_id'));
        $('option[value="'+eSelectedItem.val()+'"]').parent().removeAttr('is_selected');
        $(this).parents('tr,li').eq(0).remove();

        var sDelId = $(this).attr('id');
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer(true) === true) {
            parent.$('option[value="'+eSelectedItem.val()+'"]').parent().removeAttr('is_selected');
            parent.$('#'+sDelId+'').parents('tr,li').eq(0).remove();
        }
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isExistLayer() === true) {
            if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer() === false) {
                $("#productOptionIframe").contents().find('option[value="'+eSelectedItem.val()+'"]').parent().removeAttr('is_selected');
                $("#productOptionIframe").contents().find('#'+sDelId+'').parents('tr,li').eq(0).remove();
            }
        }

        if (TotalAddSale.needRecalculatorSalePrice() === true) {
            oProductList = TotalAddSale.getProductList();
            // 옵션삭제후 재계산
            delete oProductList[eSelectedItem.val()];
            // 선택옵션없을시 ajax호출안함
            if (jQuery.isEmptyObject(oProductList)) {
                TotalAddSale.setParam('product', oProductList);
                TotalAddSale.setTotalAddSalePrice(0);
                setTotalData();
            } else if ($('input.quantity_opt').length > 0) {
                TotalAddSale.setSoldOutFlag(false);
                TotalAddSale.setParam('product', oProductList);
                TotalAddSale.getCalculatorSalePrice(function(){
                    setTotalData();
                });
            }
        } else {
            setTotalData();
        }

        try {
            if ($('#NaverChk_Button').length > 0) {
                if ($('#NaverChk_Button').children().length < 1) {
                    return;
                }
                var iSoldOut = 0;
                $('.option_box_id, .soldout_option_box_id').each(function() {
                    if (checkSoldOut($(this).val()) === true ) {
                        iSoldOut++;
                    }
                });
                if (iSoldOut > 0) {
                    $('#NaverChk_Button').css('display', 'none');
                } else {
                    $('#NaverChk_Button').css('display', 'block');
                }
            }
        } catch (e) {}
    });

    // qr코드 상품 url 복사
    $('a.' + qrcode_class).unbind().click(function()
    {
        if (window.clipboardData.setData('Text',qrcode_url)) {
            alert(__('코드URL 주소가 복사되었습니다\r\n붙여넣기(ctrl+v)하세요.'));
        }
    });

    if (mobileWeb == true) {
        $('.differentialShipping > a').live('click',function() {
           $('.differentialShipping > .layerShipping').show();
           return false;
        });

        $('.layerShipping .btnClose').live('click', function() {
            $(this).parent().hide();
             return false;
         });
    }

    // 차등 배송비 사용시 ToolTip 열기
    $('.btnTooltip > a').live('click',function() {
       $('.btnTooltip > .differentialShipping').show();
    });
    // 차등 배송비 사용시 ToolTip 닫기
    $('.btnTooltip > .differentialShipping a').unbind().click(function() {
        $('.btnTooltip > .differentialShipping').hide();
    });

    // 차등 배송비 사용시 ToolTip 열기 (모바일)
    $('.differentialShipping > .btnHelp').unbind().click(function() {
       $('.differentialShipping > .layerShipping').show();
    });
    // 차등 배송비 사용시 ToolTip 닫기 (모바일)
    $('.differentialShipping > .layerShipping > a').unbind().click(function() {
        $('.differentialShipping > .layerShipping').hide();
    });

    // 추가입력옵션 글자 길이 체크
    $('.input_addoption').live('keyup', function() {
        var iLimit = $(this).attr('maxlength');
        addOptionWord($(this).attr('id'), $(this).val(), iLimit);
    });

    $('ul.discountMember img.ec-front-product-show-benefit-icon').click(function() {

        $('ul.discountMember li > div.discount_layer').hide();

        if ($(this).parent().parent().has('div.discount_layer').length == 0) {
            var sBenefitType = $(this).attr('benefit');
            var oObj = $(this);
            var oHtml = $('<div>');
            var iBenefitProductNo = $(this).attr('product-no');
            oHtml.addClass('ec-base-tooltip discount_layer');

            //회원등급관리의 등급할인인 경우 class추가
            if (sBenefitType == 'MG') {
                oHtml.addClass('member_rating');
            }

            $(this).parent().parent().append(oHtml);
            $.post('/exec/front/Product/Benefitinfo', 'benefit_type='+sBenefitType+'&product_no=' + iBenefitProductNo, function(sHtml) {
                oHtml.html(sHtml);
            });

        } else {
            $(this).parent().parent().find('div.discount_layer').show();
        }
        return false;
    });

    $('div.discount_layer .close').live('click', function() {
        $(this).parent().hide();
        return false;
    });

    $('div.shippingFee a').click(function() {
        $('ul.discountMember li > div.discount_layer').hide();
        $('ul.discountMember li > span.arrow').hide();

        if ($(this).parent().parent().has('div.ec-base-tooltip').length == 0) {
            var sBenefitType = $(this).attr('benefit');
            var oObj = $(this);
            var oHtml = $('<div>');
            oHtml.addClass('ec-base-tooltip');
            oHtml.addClass('wrap');

            //회원등급관리의 등급할인인 경우 class추가
            if (sBenefitType == 'MG') {
                oHtml.addClass('member_rating');
            }

            $(this).parent().append(oHtml);
            $.post('/exec/front/Product/Benefitinfo', 'benefit_type=' + sBenefitType + '&product_no=' + iProductNo, function(sHtml) {
                oHtml.html(sHtml);
            });
        }

        $(this).parent().parent().find('div.ec-base-tooltip').show();
        $(this).parent().parent().find('span.arrow').show();
        return false;
    });

    $('.ec-base-tooltip .close').live('click', function() {
        $(this).parent().hide();
        $(this).parent().parent().find('span.arrow').hide();
        $('.differentialShipping').hide();
         return false;
     });


    // 구매옵션레이어 사용가능 여부 세팅
    // Controller에서 확인하도록 바꿀까...
    EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.init();
    // sms 재입고 알림 레이어 팝업 노출여부 확인
    EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER.setCheckSmsRestockLayerPopup();
});

/**
 * 모바일 상품옵션Layer 닫기
 * @param bIsOptionInit 옵션선택 레이어 닫을때 선택된 옵션을 부모창과 동기화할것인지 여부
 */
function closeBuyLayer(bIsOptionInit)
{
    if (bIsOptionInit !== false) {
        var iTotalOptCnt = $('select[id^="' + product_option_id + '"]').length;
        $('select[id^="' + product_option_id + '"]').each(function (i) {
            var sSelectOptionId = $(this).attr('id');
            var sParentVal = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectedValue(this);
            var oTarget = parent.$('#'+sSelectOptionId+'');
            parent.EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(oTarget, sParentVal);
            if (i < iTotalOptCnt - 1) {
                parent.$('#'+sSelectOptionId+'').trigger('change');
            }
        });
    }
    parent.$('html, body').css({'overflowY':'auto', height:'auto', width:'100%'});
    parent.$('#opt_layer_window').hide();
}


/**
 * 선택한 옵션 품절여부 체크
 * @param sOptionId 옵션 id
 * @returns 품절여부
 */
function checkSoldOut(sOptionId)
{
    var aStockData = $.parseJSON(option_stock_data);
    var bSoldOut = false;

    // get_stock_info
    if (aStockData[sOptionId] == undefined) {
        iStockNumber = -1;
        iOptionPrice = 0;
        bStock = false;
        sIsDisplay = 'T';
        sIsSelling = 'T';
    } else {
        iStockNumber = aStockData[sOptionId].stock_number;
        iOptionPrice = aStockData[sOptionId].option_price;
        bStock = aStockData[sOptionId].use_stock;
        sIsDisplay = aStockData[sOptionId].is_display;
        sIsSelling = aStockData[sOptionId].is_selling;
    }
    if (sIsSelling == 'F' || ((iStockNumber < buy_unit || iStockNumber <= 0) && (bStock === true || sIsDisplay == 'F'))) {
        bSoldOut = true;
    }
    return bSoldOut;
}


/**
 * 옵션없는 구매수량 체크
 * @param sEventType 이벤트 타입
 * @param oObj Object정보
 */
function setQuantity(sEventType, oObj)
{
    var $oQuantityElement = $(quantity_id);
    var iQuantity = parseInt($oQuantityElement.val(),10);
    var iBuyUnit  = parseInt(buy_unit);
    var iProductMin = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getProductMinQuantity();

    if (sEventType == 'click') {
        var iProductCustom = $('#product_custom').val();
        var sQuantityClass = '.' + oObj.className;
        if (sQuantityClass.indexOf('.QuantityUp') >= 0 || $(oObj).hasClass('QuantityUp') || $(oObj).hasClass('up')) {
            iQuantity = iQuantity + iBuyUnit;
        } else if (sQuantityClass.indexOf('.QuantityDown') >= 0 || $(oObj).hasClass('QuantityDown') || $(oObj).hasClass('down')) {
            iQuantity = iQuantity - iBuyUnit;
        }
    }

    if (iQuantity > product_max && product_max > 0) {
        alert(sprintf(__('최대 주문수량은 %s개 입니다.'), product_max));
        if (iBuyUnit == 1) {
            $oQuantityElement.val(product_max);
        } else {
            $oQuantityElement.val($oQuantityElement.val());
        }
        return;
    }
    if (iQuantity < iProductMin) {
        alert(sprintf(__('최소 주문수량은 %s개 입니다.'), iProductMin));
        $oQuantityElement.val(iProductMin);
        return;
    }

    $oQuantityElement.val(iQuantity);
    if (oSingleSelection.isItemSelectionTypeS() === true) {
        $('input.single-quantity-input[product-no='+iProductNo+']').val(iQuantity);
    }


    setPrice(false, false, '');

    // 총 주문금액/수량 처리
    setTotalData();

    // 구스킨인경우 판매금액 계산
    if (isNewProductSkin() === false) {
        setOldTotalPrice();
    }
}

/**
 * 옵션박스 구매수량 체크
 * @param sEventType 이벤트별 수량 체크
 * @param oObj Object정보
 */
function setOptionBoxQuantity(sEventType, oObj)
{
    var sOptionId = '', sOptionBoxId = '', sProductPrice = '';
    var iQuantity = 0;
    var iBuyUnit  = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getBuyUnitQuantity();

    if (sEventType == 'click') {
        // 구매수량 화살표로 선택
        var sType = $(oObj).attr('id').indexOf('_up') > 0 ? '_up' : '_down';
        sOptionBoxId = '#' + $(oObj).attr('id').substr(0, $(oObj).attr('id').indexOf(sType));
        iQuantity = parseInt($(sOptionBoxId + '_quantity').val(), 10);
        sOptionId = $(sOptionBoxId + '_id').val();
        if (sType == '_up') {
            iQuantity = iQuantity + iBuyUnit;
        } else if (sType == '_down') {
            iQuantity = iQuantity - iBuyUnit;
        }
    } else if (sEventType == 'change') {
        // 구매수량 직접 입력
        sOptionBoxId = '#' + $(oObj).attr('id').substr(0, $(oObj).attr('id').indexOf('_quantity'));
        iQuantity = parseInt($(oObj).val(), 10);
        sOptionId = $(sOptionBoxId + '_id').val();
    }
    // 최소 구매 수량 체크
    var iProductMin = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getProductMinQuantity();

    if (iQuantity < iProductMin) {
        alert(sprintf(__('최소 주문수량은 %s개 입니다.'), iProductMin));
        iQuantity = iProductMin;
        $(oObj).val(iQuantity).blur();
        return;
    }

    if (iQuantity > product_max && product_max > 0) {
        alert(sprintf(__('최대 주문수량은 %s개 입니다.'), product_max));
        iQuantity = product_max;
        $(oObj).val(iQuantity).blur();
        return;
    }
    var aStockData     = $.parseJSON(option_stock_data);
    var iOptionPrice   = 0;
    var iTotalQuantity = iQuantity;
    var iStockNumber   = 0;
    var bUseStock      = '';
    var bUseSoldOut    = '';
    var iAddOptionPrice = 0; // 연동형 옵션인 경우 판매가를 제외한 옵션 자체에 붙은 금액을 따로 보관하자

    if (Olnk.isLinkageType(sOptionType) === true) {
        var aOptionTmp = sOptionId.split('||');
        var aOptionIdTmp = new Array;
        var sOptionIdTemp = '';
        for ( i = 0 ; i < aOptionTmp.length ; i++ ) {
            if (aOptionTmp[i] !== '' ) {
                aOptionIdTmp = aOptionTmp[i].split('_');
                if (/^\*+$/.test(aOptionIdTmp[0]) === false )  {
                    iOptionPrice = iOptionPrice + parseFloat(aStockData[aOptionIdTmp[0]].option_price);
                    iAddOptionPrice = parseFloat(aStockData[aOptionIdTmp[0]].option_price);
                    sOptionIdTemp = aOptionIdTmp[0];
                }

            }
        }
        if ( (Olnk.bAllSelectedOption === true ||  Olnk.getOptionPushbutton($('#option_push_button')) === true ) && sOptionIdTemp === '') {
            sOptionIdTemp = sProductCode;
        }

        iOptionPrice = parseFloat(product_price) + iOptionPrice;

        iStockNumber   = parseInt(aStockData[sOptionIdTemp].stock_number);
        bUseStock      = aStockData[sOptionIdTemp].use_stock;
        bUseSoldOut    = aStockData[sOptionIdTemp].use_soldout;


        // iTotalQuantity 연동형 옵션의 경우 현재 옵션박스에 되어 있는 모든 품목의 재고를 더해야 한다.
        // 이 거지 같은 코드는 깔끔하게 누가 좀 고쳐 주시면 감사합니다.
        // 참고로 추가 구성상품의 경우 따로 체크 하게 되어 있으니 안심!!
        var sAddOptionBoxNum = '';
        $('[name="quantity_opt[]"]').each(function() {
            sAddOptionBoxNum = $(this).attr('id').replace('quantity','');
            if ($(this).attr('id').indexOf('add_') < 0 && $(oObj).attr('id').indexOf(sAddOptionBoxNum) < 0 ) {
                iTotalQuantity += parseInt($(this).val());
            }

        });

        // 최대 재고 수량 체크
        if (bUseSoldOut === 'T' && bUseStock === true && iTotalQuantity > iStockNumber) {
            alert(sprintf(__('재고 수량이 %s개 존재합니다. 재고수량 이하로 입력해주세요.'), iStockNumber));
            $(oObj).val(iStockNumber);
            return;
        }
    } else {
        iStockNumber   = parseInt(aStockData[sOptionId].stock_number);
        iOptionPrice  = parseFloat(aStockData[sOptionId].option_price);
    }

    if (oSingleSelection.isItemSelectionTypeS() === true) {
        var iProductNum = iProductNo;
        var iOptionSequence = 1;
        if (option_type === 'F') {
            iOptionSequence = $(oObj).parents('tr.option_product').attr('target-key').split('|')[1];
        }
        $('input.single-quantity-input[product-no='+iProductNum+'][option-sequence='+iOptionSequence+']').val(iQuantity);

    }


    iProductPrice = getProductPrice(iQuantity, iOptionPrice, sOptionId, null, function(iProductPrice)
    {
        var bIsValidBundleObject = typeof(EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE) === 'object';
        var iProductNum = (has_option === 'T') ? $(sOptionBoxId + '_quantity').attr('product-no') : iProductNo;
        //1+N 상품일 경우 품목별 가격은 변경되지 않음
        var iTotalPrice = (bIsValidBundleObject === true && EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.oBundleConfig.hasOwnProperty(iProductNum) === true) ? iOptionPrice : iOptionPrice * iQuantity;
        sProductPrice = SHOP_PRICE_FORMAT.toShopPrice(iTotalPrice)

        // ECHOSTING-58174
        if (sIsDisplayNonmemberPrice == 'T') {
            sProductPrice = sNonmemberPrice;
            iProductPrice = 0;
        }

        $(sOptionBoxId + '_quantity').val(iQuantity);
        $(sOptionBoxId + '_price').find('span').html(sProductPrice);
        $(sOptionBoxId + '_price').find('input').val(iProductPrice);

        // 적립금 계산
        if (typeof (mileage_val) != 'undefined') {

            var iStockPrice = 0;
            if (Olnk.isLinkageType(sOptionType) === true) {
                iStockPrice = iAddOptionPrice;
            } else if (typeof (aStockData[sOptionId].stock_price) != 'undefined' ) {
                iStockPrice = aStockData[sOptionId].stock_price;
            }
            var mileage_price = TotalAddSale.getMileageGenerateCalc(sOptionId, iQuantity);

            if (mobileWeb === true) {
                $(sOptionBoxId + '_mileage').html(SHOP_PRICE_FORMAT.toShopMileagePrice(mileage_price));
            } else {
                if (mileage_price > 0) {
                    $(sOptionBoxId + '_mileage').html(SHOP_PRICE_FORMAT.toShopMileagePrice(mileage_price));
                }
            }
            if (sIsDisplayNonmemberPrice == 'T') {
                $(sOptionBoxId + '_mileage').html(sNonmemberPrice);
            }
        }

        // 구매레이어
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer(true) === true) {
            parent.$(sOptionBoxId + '_quantity').val(iQuantity);
            parent.$(sOptionBoxId + '_price').find('span').html(sProductPrice);
            parent.$(sOptionBoxId + '_price').find('input').val(iProductPrice);
            if (typeof (mileage_val) != 'undefined') {
                parent.$(sOptionBoxId + '_mileage').html(SHOP_PRICE_FORMAT.toShopMileagePrice(mileage_price));
                if (sIsDisplayNonmemberPrice == 'T') {
                    parent.$(sOptionBoxId + '_mileage').html(sNonmemberPrice);
                }
            }
        }
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isExistLayer() === true) {
            if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer() === false) {
                $("#productOptionIframe").contents().find(sOptionBoxId + '_quantity').val(iQuantity);
                $("#productOptionIframe").contents().find(sOptionBoxId + '_price').find('span').html(sProductPrice);
                $("#productOptionIframe").contents().find(sOptionBoxId + '_price').find('input').val(iProductPrice);
            }
            if (typeof (mileage_val) != 'undefined') {
                $("#productOptionIframe").contents().find(sOptionBoxId + '_mileage').html(SHOP_PRICE_FORMAT.toShopMileagePrice(mileage_price));
                if (sIsDisplayNonmemberPrice == 'T') {
                    $("#productOptionIframe").contents().find(sOptionBoxId + '_mileage').html(sNonmemberPrice);
                }
            }
        }
        // 총 주문금액/수량 처리
        setTotalData();
    });
}

// 자바스크립트 number_format jsyoon
function number_format(str)
{
    str += '';

    var objRegExp = new RegExp('(-?[0-9]+)([0-9]{3})');

    while (objRegExp.test(str)) {
        str = str.replace(objRegExp,'$1,$2');
    }

    return str;
}

/**
 * 가격계산 후 판매가에 반영
 * @param bInit 초기값여부
 * @param bOption 옵션선택여부
 * @param sOptionId 단독구성형일때는 SelectBox가 여러개이므로 선택한 OptionId 필요
 */
function setPrice(bInit, bOption, sOptionId)
{
    var sQuantityString = '(' + sprintf(__('%s개'),0) + ')';

    // 판매가 대체 문구시 가격 계산 안함
    if (product_price_content == true) {
        if (sIsDisplayNonmemberPrice == 'T') {
            $('#totalProducts .total').html('<strong><em>'+sNonmemberPrice+'</em></strong> ' + sQuantityString + '</span>');
        }
        return false;
    }

    // 옵션이 없는 경우 수량 초기화
    if (has_option == 'F' && (isNaN($(quantity_id).val()) === true || $(quantity_id).val() == '' || $(quantity_id).val().indexOf('.') > 0)) {
        $(quantity_id).val(product_min);
    }

    if (bInit === true) {
        setProductPriceText();
    }
    // 옵션이 없을 경우
    if (has_option == 'F') {
        setPriceHasOptionF();
    } else if (has_option == 'T'){
        if (typeof sOptionType != 'undefined' && Olnk.isLinkageType(sOptionType) === false) {
            setPriceHasOptionT(bOption, sOptionId);
        } else {
            if (Olnk.getOptionPushbutton($('#option_push_button')) === false) {
                iQuantity = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getProductMinQuantity();
                if (oSingleSelection.isItemSelectionTypeS() === true) {
                    iQuantity = PRODUCTSUBMIT.getQuantity();
                }
                Olnk.handleTotalPrice(option_stock_data, product_price, sIsDisplayNonmemberPrice,false, iQuantity);

            }
        }
    }

    // 적립금 처리
    setMileage(bInit);
}

/**
 *  모바일 할인가 계산 후 리턴
*/
function getMobileDcPrice( iPrice ){

    var iReturnMobileDcPrice = 0;
    var iTmpBasePrice = 0;
    var iPer = 0;

    // 정율 할인일 경우
    if (sc_mobile_dc_value_flag == 'P') {
        iPer = sc_mobile_dc_value * 0.01;
        iTmpBasePrice = iPrice * iPer;
        iTmpBasePrice = getMobileDcLimitPrice( iTmpBasePrice );
        iReturnMobileDcPrice = Math.ceil( iPrice - iTmpBasePrice );
    }
    // 금액 할인일 경우
    else{
        iReturnMobileDcPrice = iPrice - sc_mobile_dc_value;
    }

    return iReturnMobileDcPrice;
}

/**
 *  모바일 할인가 금액 절사 후 리턴
 *
*/
function getMobileDcLimitPrice( MobileDcPrice ){

    var iFloat = 0;
    var iOpp = 0;

    switch ( sc_mobile_dc_limit_value ) {

        // 절사 안함
        case "F" : return MobileDcPrice; break;

        // 원단위 절사
        case "O" :
            iFloat = 0.1;
            iOpp = 10;
        break;

        // 십원단위 절사
        case "T" :
            iFloat = 0.01;
            iOpp = 100;
        break;

        // 백원단위 절사
        case "M" :
            iFloat = 0.001;
            iOpp = 1000;
        break;
    }

    MobileDcPrice = MobileDcPrice * iFloat;

    // 반올림인지 내림인지
    if (sc_mobile_dc_limit_flag == 'L') { MobileDcPrice = Math.floor( MobileDcPrice ) * iOpp; }
    else if (sc_mobile_dc_limit_flag == 'U') { MobileDcPrice = Math.round(MobileDcPrice) * iOpp; }

    return MobileDcPrice;
}

/**
 * 적립금 계산 후 반영
 */
function setMileage(bInit)
{
    var iMileageVal = 0;
    var iProductMin = (parseInt(buy_unit,10) >= parseInt(product_min,10) ? buy_unit : product_min);

    if (typeof (mileage_val) != 'undefined') {
        iMileageVal = mileage_val;
    }

    if (bInit === true && mobileWeb === true) {
        $('#span_mileage_text').html(SHOP_PRICE_FORMAT.toShopMileagePrice(iMileageVal));
        if (sIsDisplayNonmemberPrice == 'T') {
            $('#span_mileage_text').html(sNonmemberPrice);
        }
    }

}

/**
 * 싸이월드 스크랩 하기
 * @param sMallId 몰아이디
 * @param iPrdNo 상품번호
 * @param iCateNo 카테번호
 * @param iSid 승인번호
 * @author 김성주 <sjkim@simplexi.com>
 */
function cyConnect(sMallId, iPrdNo, iCateNo, iSid)
{
    var strUrl = "http://api.cyworld.com/openscrap/shopping/v1/?";
    //strUrl += "xu=" + escape("http://www2.1300k.com/shop/makeGoodsXml/makeGoodsXml.php?f_goodsno="+prdNo+"&cate_no="+cate_no);
    //strUrl += "&sid=s0200002";

    strUrl += "xu=" + escape("//"+sMallId+".cafe24.com/front/php/ghost_mall/makeCyworldPrdXml.php?product_no="+iPrdNo+"&cate_no="+iCateNo+"&sid="+iSid);
    strUrl += "&sid="+iSid;

    var strOption = "width=450,height=410";

    var objWin = window.open(strUrl, 'cyopenscrap',  strOption);
    objWin.focus();
}

/**
 * 싸이월드 스크랩 설명 보여주기
 * @author 김성주 <sjkim@simplexi.com>
 */
function openNateInfo(num)
{
    if (num == "1"){
        document.getElementById('divNate').style.display="none";
    }else{
        document.getElementById('divNate').style.display="";
    }
}

/**
 * 판매가 표시설정
 */
function setProductPriceText()
{
    var sString = SHOP_PRICE_FORMAT.toShopPrice(product_price);
    if (typeof product_price_ref != 'undefined' && product_price_ref > 0) {
        // 화폐 노출 순서 설정 ECHOSTING-56540
        if (currency_disp_type == 'P') {
            sString += ' ' + txt_product_price_ref;
        } else {
            sString = txt_product_price_ref + ' ' + sString;
        }
    }
    // ECHOSTING-58174
    if (sIsDisplayNonmemberPrice == 'T') {
        sString = sNonmemberPrice;
    }

    // ECHOSTING-67418 구상품일때도 판매가 영역이 바뀌게 처리 (초기화시 최소 구매수량 개수에 맞게 노출)
    if (isNewProductSkin() === false && sIsDisplayNonmemberPrice !== 'T') {
        iPrice = getProductPrice(product_min, product_price, null, null, function(iPrice) {
            sString = SHOP_PRICE_FORMAT.toShopPrice(iPrice);
            $('#span_product_price_text').html(sString);
        });
    } else {
        $('#span_product_price_text').html(sString);
    }
    var sMobileClass = '';
    if (mobileWeb === true) {
        sMobileClass = ' class = "price"';
    }
    var sTotalPriceSelector = oSingleSelection.getTotalPriceSelector();
    var sQuantityString = '('+sprintf(__('%s개'),0)+')';
    if (oSingleSelection.isItemSelectionTypeS() === true) {
        var sStrPrice = SHOP_PRICE_FORMAT.toShopPrice(0);

        $(sTotalPriceSelector).html('<strong'+sMobileClass+'><em>'+sStrPrice+'</em></strong> '+sQuantityString+'</span>');
        setTotalPriceRef(0, sQuantityString);
    }
    // ECHOSTING-58174
    if (sIsDisplayNonmemberPrice == 'T') {
        if (sNonmemberPrice === "") {
            sNonmemberPrice = "-";
        }
        $(sTotalPriceSelector).html('<strong'+sMobileClass+'><em>'+sNonmemberPrice+'</em></strong> ' + sQuantityString + '</span>');
    }

}

/**
 * 전체 금액 리턴
 * @returns {Number}
 */
function getTotalPrice()
{
    var iTotalPrice = 0;
    $('.option_box_price').each(function() {
        iTotalPrice += parseInt($(this).val());
    });

    return iTotalPrice;
}

/**
 * 금액설정(옵션이 없는 경우)
 */
function setPriceHasOptionF()
{
    if ($('#totalProducts').size() === 0) {
        return;
    }
    try {
        iQuantity = parseInt($(quantity_id).val().replace(/^[\s]+|[\s]+$/g,'').match(/[\d\-]+/),10);
    } catch(e) {}
    var iMaxCnt = 999999;
    if (iQuantity > iMaxCnt) {
        $(quantity_id).val(iMaxCnt);
        iQuantity = iMaxCnt;
    }
    // 모바일 할인가 추가.
    if (typeof ($('#span_product_price_mobile_text') ) != 'undefined' ) {
        try{
            var iPriceMobile = parseFloat(product_price_mobile,10);
        }
        catch(e){ var iPriceMobile = product_price; }
    }

    var iTotalPrice = getProductPrice(iQuantity, product_price, item_code, null, function(iTotalPrice){
        var sTotalOriginPrice = SHOP_PRICE_FORMAT.toShopPrice( iTotalPrice );
        var iTotalOriginPrice = iTotalPrice;

        var sItemCode = $('.option_box_price').attr('item_code');
        sItemCode = (typeof(sItemCode) === 'undefined') ? item_code : sItemCode;
        iVatSubTotalPrice = TotalAddSale.getVatSubTotalPrice(sItemCode);

        if (iVatSubTotalPrice != iTotalPrice && iVatSubTotalPrice != 0 && iTotalPrice != 0) {
            iTotalPrice = iVatSubTotalPrice;
        }

        var sTotalPrice = SHOP_PRICE_FORMAT.toShopPrice( iTotalPrice );
        var sTotalSalePrice = sTotalPrice;
        iTotalAddSalePrice = TotalAddSale.getTotalAddSalePrice();
        if (typeof(iTotalAddSalePrice) != 'undefined' && iTotalAddSalePrice != 0) {
            iTotalSalePrice = iTotalPrice - parseFloat(iTotalAddSalePrice, 10);
            sTotalSalePrice = SHOP_PRICE_FORMAT.toShopPrice( iTotalSalePrice );
        } else {
            iTotalSalePrice = iTotalPrice;
        }

        //옵션이 없는 상품이고 추가구성상품 추가시 수량처리 및 상품금액 처리
        var iAddQuantity = 0;
        if ($('.add_product_option_box_price').length > 0) {
            $('.quantity_opt').each(function() {
                iAddQuantity += parseFloat($(this).val());
            });

            sTotalSalePrice = getAddProductExistTotalSalePrice(iTotalSalePrice);
        }
        var iTotalQuantity = iQuantity + iAddQuantity;

        var sQuantityString = '('+sprintf(__('%s개'), iTotalQuantity) + ')';
        // ECHOSTING-58174
        if (sIsDisplayNonmemberPrice == 'T') {
            sTotalPrice = sNonmemberPrice;
            sTotalSalePrice = sNonmemberPrice;
        }

        if (mobileWeb === true) {
            $(oSingleSelection.getTotalPriceSelector()).html('<strong class="price">'+sTotalSalePrice+' '+sQuantityString+'</strong>');
            $('#quantity').html('<input type="hidden" name="option_box_price" class="option_box_price" value="'+iTotalOriginPrice+'" item_code="'+item_code+'">');
        } else {
            $('#totalProducts .total').html('<strong><em>' + sTotalSalePrice + '</em></strong> ' + sQuantityString + '</span>');
            $('#totalProducts').find('.quantity_price').html(sTotalOriginPrice + '<input type="hidden" name="option_box_price" class="option_box_price" value="'+iTotalOriginPrice+'" item_code="'+item_code+'">');
            if (typeof(mileage_val) !== 'undefined' && TotalAddSale.checkVaildMileageValue(mileage_val) === true) {
                var mileage_price = TotalAddSale.getMileageGenerateCalc(item_code, iQuantity);

                if (sIsDisplayNonmemberPrice == 'T') {
                    $('#totalProducts').find('.mileage_price').html(sNonmemberPrice);
                } else {
                    $('#totalProducts').find('.mileage_price').html(SHOP_PRICE_FORMAT.toShopMileagePrice( mileage_price ));
                }
            } else {
                $('#totalProducts').find('.mileage').hide();
            }
        }

        if (typeof(iTotalAddSalePrice) != 'undefined' && iTotalAddSalePrice != 0) {
            setTotalPriceRef(iTotalSalePrice, sQuantityString);
        } else {
            setTotalPriceRef(iTotalPrice, sQuantityString);
        }

        try {
            $('#spnViewPriceOrg').html(SHOP_PRICE_FORMAT.toShopPrice(_iPrdtPriceOrg*iQuantity));
        } catch(e) {}

        try {
            $('#spnViewPriceTax').html(SHOP_PRICE_FORMAT.toShopPrice(_iPrdtPriceTax*iQuantity));
        } catch(e) {}

        // 총 주문금액/수량 처리
        setTotalData();
    });
}

/**
 * 금액설정(옵션이 있는 경우)
 * 복합/조합 - 단독/일체 구분없이 item_code만으로 처리하도록 변경
 */
function setPriceHasOptionT(bOption, sOptionId)
{
    if (typeof(option_stock_data) == 'undefined') {
        return;
    }

    if (sIsDisplayNonmemberPrice === 'T') {
        return;
    }

    if (bOption !== true) {
        return;
    }

    var sSelectElementId = sOptionId;
    var temp_product_option_id = product_option_id;

    //뉴상품+구스킨 : 옵션추가버튼을 이용해 추가된 옵션 select box id 예외처리
    if (sOptionId.split('_')[0] == 'add') {
        temp_product_option_id = sOptionId.split('_')[0]+'_'+sOptionId.split('_')[1]+'_'+temp_product_option_id;
    }

    var sSoldoutDisplayText = EC_SHOP_FRONT_NEW_OPTION_EXTRA_SOLDOUT.getSoldoutDiplayText(iProductNo);
    var aStockData = $.parseJSON(option_stock_data);
    // bItemSelected : 모든 셀렉트 박스가 선택됐는지 여부
    var bItemSelected, bSoldOut = false;
    var sOptionId, sOptionText = '';
    var iPrice = 0;

    var iBuyUnit  = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getBuyUnitQuantity('base');
    var iProductMin = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getProductMinQuantity();

    var iQuantity = (iBuyUnit >= iProductMin ? iBuyUnit : iProductMin);
    // 조합구성 & 분리선택형
    if (option_type == 'T' && item_listing_type == 'S') {
        var aOption = new Array();
        $('select[id^="' + temp_product_option_id + '"]').each(function() {
            var cVal = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectedValue(this);
            if (cVal.indexOf('|') > -1) {
                cVal = cVal.split('|')[0];
            }
            aOption.push(cVal);
        });

        // 아직 totalProduct에 Element추가가 안되서 getItemCode를 사용할 수 없다.
        sOptionId = ITEM.getOldProductItemCode('[id^="'+temp_product_option_id+'"]');
        sOptionValue = aOption.join('/');
        sOptionText = aOption.join('#$%');
        if (ITEM.isOptionSelected(aOption) === true) {
            bItemSelected = true;
        }

        if (typeof(aStockData[sOptionId]) != 'undefined' && aStockData[sOptionId].stock_price != 0) {
            if (typeof(product_option_price_display) == 'undefined' || product_option_price_display === 'T') {
                sOptionText += '(' + getOptionPrice(aStockData[sOptionId].stock_price) + ')';
            }
        }

        if (bItemSelected === true && sOptionId === false) {
            alert(sprintf(__("선택하신 '%s' 옵션은 판매하지 않은 옵션입니다.\n다른 옵션을 선택해 주세요."),sOptionValue));
            throw e;
            return false;
        }
    } else {
        var sElementId = sOptionId;
        var oSelect = $('#'+sElementId);

        if (oSelect.attr('is_selected') !== 'T') {
            sOptionText = $('#' + sOptionId + ' option:selected').text();
            sOptionId = $('#' + sOptionId + ' option:selected').val();
            bItemSelected = true;
        } else {
            if (isNewProductSkin() === true && NEWPRD_OPTION.isOptionSelectTitleOrDivider(EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectedValue(oSelect)) !== true) {
                alert(__('이미 선택되어 있는 옵션입니다.'));
                NEWPRD_OPTION.resetSelectElement(oSelect);
                return false;
            }
            sOptionId = '*';
        }

        // 독립선택형 옵션별로 한개씩 선택시
        if (oSingleSelection.isItemSelectionTypeM() === true && typeof(is_onlyone) === 'string' && is_onlyone === 'T' && isNewProductSkin() === true) {

            if (NEWPRD_OPTION.isOptionSelectTitleOrDivider(oSelect.val()) !== true) {
                $('#'+sElementId).attr('is_selected','T');
            }
        }

        if (ITEM.isOptionSelected(sOptionId) === false) {
            bItemSelected = false;
        }
    }

    // get_stock_info
    if (aStockData[sOptionId] == undefined) {
        iStockNumber = -1;
        iOptionPrice = 0;
        bStock = false;
        sIsDisplay = 'T';
        sIsSelling = 'T';
        sIsReserveStat = 'N';
    } else {
        iStockNumber = aStockData[sOptionId].stock_number;
        iOptionPrice = aStockData[sOptionId].option_price;
        bStock = aStockData[sOptionId].use_stock;
        sIsDisplay = aStockData[sOptionId].is_display;
        sIsSelling = aStockData[sOptionId].is_selling;
        sIsReserveStat = aStockData[sOptionId].is_reserve_stat; //이건 어디서
    }

    if (typeof(EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.oBundleConfig[iProductNo]) === 'object') {
        iOptionPrice = aStockData[sOptionId].option_price - aStockData[sOptionId].stock_price;
    }
    if (sIsSelling == 'F' || ((iStockNumber < iBuyUnit || iStockNumber <= 0) && (bStock === true || sIsDisplay == 'F'))) {
        //뉴상품+구스디 스킨 (옵션추가 버튼나오는 디자인 - 옵션선택시 재고체크)
        if ($('#totalProducts').length <= 0) {
            var aOptionName = new Array();
            var aOptionText = new Array();

            aOptionName = option_name_mapper.split('#$%');
            aOptionText = sOptionText.split('#$%');
            for ( var i = 0 ; i < aOptionName.length ; i++) {
                aOptionText[i] = aOptionName[i]+':'+aOptionText[i];
            }
            option_text = aOptionText.join('\n');
            alert(__('이 상품은 현재 재고가 부족하여 판매가 잠시 중단되고 있습니다.') + '\n\n' + __('제품명') + ' : ' + product_name + '\n\n' + __('재고없는 제품옵션') + ' : \n' + option_text);
            EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue($('#' + sSelectElementId), '*');
        }
        bSoldOut = true;
        sOptionText = sOptionText.split('#$%').join('/').replace('['+sSoldoutDisplayText+']', '') + ' <span class="soldOut">['+sSoldoutDisplayText+']</span>';
    } else {
        sOptionText = sOptionText.split('#$%').join('/');
    }


    //예약주문|당일발송
    if (aStockData[sOptionId] !== undefined) {
        if (aReserveStockMessage['show_stock_message'] === 'T' && sIsReserveStat !== 'N') {
            var sReserveStockMessage = '';
            bSoldOut = false; //품절 사용 안함

            sReserveStockMessage = aReserveStockMessage[sIsReserveStat];
            sReserveStockMessage = sReserveStockMessage.replace(aReserveStockMessage['stock_message_replace_name'], iStockNumber);
            sOptionText = sOptionText.replace(sReserveStockMessage, '') + ' <span class="soldOut">'+sReserveStockMessage+'</span>';
        }
    }

    if (oSingleSelection.isItemSelectionTypeS() === true) {
        iQuantity = PRODUCTSUBMIT.getQuantity();
        if (option_type === 'F') {
            var iOptionSequence = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSortNum(oSelect);
            iQuantity = PRODUCTSUBMIT.getQuantity($('[product-no='+iProductNo+'][option-sequence='+iOptionSequence+']'));
        }
    }

    iPrice = getProductPrice(iQuantity, iOptionPrice, sOptionId, bSoldOut, function(iPrice){
        // 옵션박스 호출
        if (bItemSelected === true) {
            // 구상품스킨일때는 옵션박스 호출안함
            if (isNewProductSkin() === false) {
                if (sIsDisplayNonmemberPrice == 'T') {
                    $('#span_product_price_text').html(sNonmemberPrice);
                } else {
                    $('#span_product_price_text').html(SHOP_PRICE_FORMAT.toShopPrice(iPrice));
                }
            } else {
                setOptionBox(sOptionId, sOptionText, iPrice, bSoldOut, sSelectElementId, sIsReserveStat, iQuantity);
            }
        }
    });
}

/**
 * 옵션 사용가능 체크
 */
function checkOptionBox(sOptionId)
{
    if (oSingleSelection.isItemSelectionTypeS() === true) {
        return false;
    }
    var bSelected = false;

    // 이미 선택된 옵션은 아무 처리도 하지 않도록 처리한다.
    $('.option_box_id').each(function(i) {
        if ($(this).val() == sOptionId) {
            bSelected = true;
        }
    });

    $('.soldout_option_box_id').each(function(i) {
        if ($(this).val() == sOptionId) {
            bSelected = true;
        }
    });

    return bSelected;
}

/*
 * 옵션선택 박스 설정
 * @todo totalproduct id를 컨트롤러로 밀어야함
 */
function setOptionBox(sOptionId, sOptionText, iPrice, bSoldOut, sSelectElementId, sIsReserveStat, iManualQuantity)
{
    var sReadonly = '';
    var oSelect = $("#"+sSelectElementId);

    // 필수 추가옵션 작성여부 검증
    if (checkAddOption() !== true) {
        delete oProductList[sOptionId];
        NEWPRD_ADD_OPTION.resetSelectElement(oSelect);

        // 독립선택형 옵션별로 한개씩 선택시
        if (typeof(is_onlyone) === 'string' && is_onlyone === 'T' && isNewProductSkin() === true) {
            oSelect.removeAttr('is_selected');
        }

        return false;
    }

    if (checkOptionBox(sOptionId) === true) {
        alert(__('이미 선택되어 있는 옵션입니다.'));
        NEWPRD_OPTION.resetSelectElement(oSelect);
        return false;
    }

    var iBuyUnit  = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getBuyUnitQuantity('base');
    var iProductMin = EC_FRONT_NEW_PRODUCT_QUANTITY_VALID.getProductMinQuantity();

    if (parseInt(buy_unit,10) > 1) {
        sReadonly = 'readonly';
    }

    var sStrPrice = SHOP_PRICE_FORMAT.toShopPrice(iPrice);

    var iQuantity = (iBuyUnit >= iProductMin ? iBuyUnit : iProductMin);
    if (typeof(iManualQuantity) !== 'undefined') {
        iQuantity = iManualQuantity;
    }


    // 적립금 추가 필요
    var iMileageVal = 0;
    var sMileageIcon = (typeof(mileage_icon) != 'undefined') ? mileage_icon : '//img.echosting.cafe24.com/design/common/icon_sett04.gif';
    var sMileageAlt  = (typeof(mileage_icon_alt) != 'undefined') ? mileage_icon_alt : '';
    if (typeof (mileage_val) != 'undefined') {
        var aStockData = $.parseJSON(option_stock_data);

        var iStockPrice = 0;
        if (Olnk.isLinkageType(option_type) === true) {
            var aOptionTmp = sOptionId.split('||');
            var aOptionIdTmp = new Array;
            var sOptionIdTemp = '';
            for ( i = 0 ; i < aOptionTmp.length ; i++ ) {
                if (aOptionTmp[i] !== '' ) {
                    aOptionIdTmp = aOptionTmp[i].split('_');
                    if (/^\*+$/.test(aOptionIdTmp[0]) === false )  {
                        iStockPrice = parseFloat(aStockData[aOptionIdTmp[0]].option_price);
                    }
                }
            }
        } else if (typeof (aStockData[sOptionId].stock_price) != 'undefined' ) {
            iStockPrice = aStockData[sOptionId].stock_price;
        }
        iMileageVal = TotalAddSale.getMileageGenerateCalc(sOptionId, iQuantity);
    }
    var sMileageVal = SHOP_PRICE_FORMAT.toShopMileagePrice(iMileageVal);
    // ECHOSTING-58174
    if (sIsDisplayNonmemberPrice == 'T') {
        sStrPrice = sNonmemberPrice;
        sMileageVal = sNonmemberPrice;
    }


    var sProductName = product_name;
    if (sProductName != null) {
        sProductName = product_name.replace(/\\"/g, '"');
    }

    var aAddOption = NEWPRD_ADD_OPTION.getCurrentAddOption();

    var sAddOptionTitle = NEWPRD_ADD_OPTION.getCurrentAddOptionTitle(aAddOption);

    var iIndex = 1;
    if (parseInt($('#totalProducts > table > tbody').find('tr.option_product').length) > 0) {
        // max
        iIndex = parseInt($('#totalProducts > table > tbody').find('tr.option_product:last').data('option-index')) + 1;
    }
    var iTargetKey = iProductNo;
    if (option_type === 'F') {
        iTargetKey = iProductNo+'|'+ EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSortNum(oSelect);
    }

    var sOptionBoxId = 'option_box' + iIndex;
    var sTableRow = '<tr class="option_product" data-option-index="'+iIndex+'" target-key="'+iTargetKey+'">';

    if (mobileWeb === true) {
        sTableRow += '<td>';
        sOptionText = '<p class="product"><strong>' + sProductName + '</strong><br /> - <span>' + sAddOptionTitle + sOptionText + '</span></p>';

        if (bSoldOut === true) {
            try {
                if ($('#NaverChk_Button').length > 0 && $('#NaverChk_Button').children().length > 0) {
                    $('#NaverChk_Button').css('display', 'none');
                }
            } catch(e) {}

            sTableRow += '<input type="hidden" class="soldout_option_box_id" id="'+sOptionBoxId+'_id" value="'+sOptionId+'">'+sOptionText;
            sTableRow += '<p><input type="number" readonly value="0"/> ';
            sTableRow += '<a href="#none"><img width="30" height="27" src="//img.echosting.cafe24.com/mobileWeb/common/btn_quantity_up.png" class="up"/></a> &nbsp;';
            sTableRow += '<a href="#none"><img width="30" height="27" src="//img.echosting.cafe24.com/mobileWeb/common/btn_quantity_down.png" class="down"/></a></span></p></td>';
            sTableRow += '<td class="right"><strong class="price">'+sStrPrice+'</strong></td>';
            sTableRow += '<td class="center"><a href="#none"><img src="//img.echosting.cafe24.com/design/skin/default/product/btn_price_delete.gif" alt="삭제" id="'+sOptionBoxId+'_del" class="option_box_del" /></a></td>';
        } else {

            //ECHOSTING 162635 예약주문 속성추가
            var sInputHiddenReserved = 'data-item-reserved="' + sIsReserveStat + '" ';

            sTableRow += '<input type="hidden" class="option_box_id" id="'+sOptionBoxId+'_id" value="'+sOptionId+'" name="item_code[]" data-item-add-option="'+escape(aAddOption.join(NEWPRD_OPTION.DELIMITER_SEMICOLON))+'"' + sInputHiddenReserved + '>'+sOptionText;
            sTableRow += '<p><input type="number" id="'+sOptionBoxId+'_quantity" name="quantity_opt[]" autocomplete="off" class="quantity_opt eProductQuantityClass" '+sReadonly+' value="'+iQuantity+'" product-no="'+iProductNo+'"/> ';
            sTableRow += '<a href="#none"><img width="30" height="27" src="//img.echosting.cafe24.com/mobileWeb/common/btn_quantity_up.png" id="'+sOptionBoxId+'_up" class="up option_box_up" alt="up" /></a> &nbsp;';
            sTableRow += '<a href="#none"><img width="30" height="27" src="//img.echosting.cafe24.com/mobileWeb/common/btn_quantity_down.png" id="'+sOptionBoxId+'_down" class="down option_box_down" alt="down" /></a></p></td>';
            sTableRow += '<td class="right"><strong id="'+sOptionBoxId+'_price" class="price"><input type="hidden" class="option_box_price" value="'+iPrice+'" product-no="'+iProductNo+'" item_code="'+sOptionId+'"><span>'+sStrPrice+'</span></strong>';
            if (TotalAddSale.checkVaildMileageValue(iMileageVal) === true) {
                sTableRow += '<span class="mileage">(<img src="'+sMileageIcon+'" alt="'+sMileageAlt+'" /> <span id="'+sOptionBoxId+'_mileage">'+sMileageVal+'</span>)</span>';
            }
            sTableRow += '</td>';
            sTableRow += '<td class="center"><a href="#none" class="delete"><img src="//img.echosting.cafe24.com/design/skin/default/product/btn_price_delete.gif" alt="삭제" id="'+sOptionBoxId+'_del" class="option_box_del" /></a></td>';
        }
        sTableRow += '</tr>';

        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer(true) === true) {
            parent.$('#totalProducts > table > tbody:last').append(sTableRow);
        }
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isExistLayer() === true) {
            if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer() === false) {
                $("#productOptionIframe").contents().find('#totalProducts > table > tbody:last').append(sTableRow);
            }
        }
    } else {
        sOptionText = '<p class="product">' + sProductName + '<br /> - <span>' + sAddOptionTitle + sOptionText + '</span></p>';

        if (bSoldOut === true) {
            try {
                if ($('#NaverChk_Button').length > 0 && $('#NaverChk_Button').children().length > 0) {
                    $('#NaverChk_Button').css('display', 'none');
                }
            } catch(e) {}
            sTableRow += '<td><input type="hidden" class="soldout_option_box_id" id="'+sOptionBoxId+'_id" value="'+sOptionId+'">'+sOptionText+'</td>';
            sTableRow += '<td><span class="quantity" style="width:65px;"><input type="text" '+sReadonly+' value="0"/><a href="#none"><img src="//img.echosting.cafe24.com/design/skin/default/product/btn_count_up.gif" class="up" alt="수량증가" /></a><a href="#none"><img src="//img.echosting.cafe24.com/design/skin/default/product/btn_count_down.gif" class="down" alt="수량감소" /></a></span>';
            sTableRow += '<a href="#none" class="delete"><img src="//img.echosting.cafe24.com/design/skin/default/product/btn_price_delete.gif" alt="삭제" id="'+sOptionBoxId+'_del" class="option_box_del" /></a></td>';
            sTableRow += '<td class="right"><span id="'+sOptionBoxId+'_price"><span>'+sStrPrice+'</span></span>';
        } else {

            //ECHOSTING 162635 예약주문 속성추가
            var sInputHiddenReserved = 'data-item-reserved="' + sIsReserveStat + '" ';
            sTableRow += '<td><input type="hidden" class="option_box_id" id="'+sOptionBoxId+'_id" value="'+sOptionId+'" name="item_code[]" data-item-add-option="'+escape(aAddOption.join(NEWPRD_OPTION.DELIMITER_SEMICOLON))+'"' + sInputHiddenReserved + '>'+sOptionText+'</td>';
            sTableRow += '<td><span class="quantity" style="width:65px;">';
            sTableRow += '<input type="text" id="'+sOptionBoxId+'_quantity" name="quantity_opt[]" class="quantity_opt eProductQuantityClass" '+sReadonly+' value="'+iQuantity+'" product-no="'+iProductNo+'"/>';
            sTableRow += '<a href="#none"><img src="//img.echosting.cafe24.com/design/skin/default/product/btn_count_up.gif" id="'+sOptionBoxId+'_up" class="up option_box_up" alt="수량증가" /></a>';
            sTableRow += '<a href="#none"><img src="//img.echosting.cafe24.com/design/skin/default/product/btn_count_down.gif" id="'+sOptionBoxId+'_down" class="down option_box_down" alt="수량감소" /></a>';
            sTableRow += '</span>';
            sTableRow += '<a href="#none" class="delete"><img src="//img.echosting.cafe24.com/design/skin/default/product/btn_price_delete.gif" alt="삭제" id="'+sOptionBoxId+'_del" class="option_box_del" /></a></td>';
            sTableRow += '<td class="right"><span id="'+sOptionBoxId+'_price">';
            sTableRow += '<input type="hidden" class="option_box_price" value="'+iPrice+'" product-no="'+iProductNo+'" item_code="'+sOptionId+'">';
            sTableRow += '<span>'+sStrPrice+'</span></span>';
        }

        if (TotalAddSale.checkVaildMileageValue(iMileageVal) === true && sIsMileageDisplay === 'T') {
            sTableRow += '<span class="mileage">(<img src="'+sMileageIcon+'" alt="'+sMileageAlt+'" /> <span id="'+sOptionBoxId+'_mileage" class="mileage_price">'+sMileageVal+'</span>)</span>';
        }

        sTableRow += '</td></tr>';
    }
    if (0 == $('#totalProducts > table > tbody.option_products').length) {
        $('#totalProducts > table > tbody:last').addClass("option_products").after($('<tbody class="add_products"/>'));
    }
    $('#totalProducts > table > tbody.option_products').append(sTableRow);
    // 총 주문금액/수량 처리
    setTotalData();
}

/**
 * 총 상품금액/수량 적용
 */
function setTotalData()
{
    // 실제 계산
    var iTotalCount = 0;
    var iTotalPrice = 0;
    var iVatSubTotalPrice = 0;
    var aEventQuantity = new Array();
    var aEventQuantityCheck = {};
    //add_product_option_box_price추가구성상품
    var bIsValidBundleObject = typeof(EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE) === 'object';
    var fEventProductPrice = 0;

    $('.option_box_price, .option_add_box_price, .add_product_option_box_price').each(function(i) {
        var iProductNum = (has_option === 'T') ? $(this).attr('product-no') : iProductNo;
        var sItemCode = $(this).attr('item_code');
        if (parseInt(iProductNum) === parseInt(iProductNo) && bIsValidBundleObject === true && EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.oBundleConfig.hasOwnProperty(iProductNum) === true) {
            if (has_option === 'T') {
                var iSingleQuantity = parseInt($('.quantity_opt[product-no="'+iProductNum+'"]').eq(i).val(),10);
            } else {
                var iSingleQuantity = parseInt($('input[name="quantity_opt[]"]').eq(i).val(),10);
            }

            if (typeof(aEventQuantityCheck[iProductNum]) === 'undefined') {
                aEventQuantityCheck[iProductNum] = 0;
                aEventQuantity.push({'product_no' : iProductNum});
            }

            aEventQuantityCheck[iProductNum] += iSingleQuantity;
        } else {
            iTotalPrice += parseFloat($(this).val());
            iVatSubTotalPrice += TotalAddSale.getVatSubTotalPrice(sItemCode);
        }
    });
    $(aEventQuantity).each(function() {
        fEventProductPrice = fEventProductPrice + (product_price * EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.getQuantity(aEventQuantityCheck[this.product_no], this.product_no));
    });
    iTotalPrice = iTotalPrice + fEventProductPrice;

    if (iVatSubTotalPrice != iTotalPrice && iVatSubTotalPrice != 0 && iTotalPrice != 0) {
        iTotalPrice = iVatSubTotalPrice;
    }
    iTotalAddSalePrice = TotalAddSale.getTotalAddSalePrice();
    if (typeof(iTotalAddSalePrice) != 'undefined' && iTotalAddSalePrice != 0) {
        iTotalPrice -= parseFloat(iTotalAddSalePrice, 10);
    }

    $('input[name="quantity_opt[]"]',(has_option === 'F' ? '' : '#totalProducts')).each(function(i) {
        iTotalCount += parseInt($(this).val());
    });
    iTotalPrice = (iTotalPrice <= 0) ? 0 : iTotalPrice;

    var sQuantityString = '('+sprintf(__('%s개'),iTotalCount)+')';
    var sStrPrice = SHOP_PRICE_FORMAT.toShopPrice(iTotalPrice);

    // ECHOSTING-58174
    if (sIsDisplayNonmemberPrice == 'T') {
        sStrPrice = sNonmemberPrice;
    }
    var sTotalPriceSelector = oSingleSelection.getTotalPriceSelector();
    // 실제 노출
    if (mobileWeb === true) {
        $(sTotalPriceSelector).html('<strong class="price">'+sStrPrice+'</strong> '+sQuantityString);

        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer(true) === true) {
            parent.$(sTotalPriceSelector).html('<strong class="price">'+sStrPrice+'</strong> '+sQuantityString);
        }
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isExistLayer() === true) {
            if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer() === false) {
                $("#productOptionIframe").contents().find(sTotalPriceSelector).html('<strong class="price">'+sStrPrice+'</strong> '+sQuantityString);
            }
        }
    } else {
        $(sTotalPriceSelector).html('<strong><em>'+sStrPrice+'</em></strong> '+sQuantityString+'</span>');
    }

    setTotalPriceRef(iTotalPrice, sQuantityString);
    setProductPriceTaxTypeText(iTotalPrice);
    setActionButtonVisible();
}

/**
 * 예약주문, 바로구매 버튼
 */
var setActionButtonVisible = function ()
{
    var sActionButtonSelector = '#btnBuy, #actionBuy, #actionBuyClone, #actionBuyCloneFixed';
    var sReserveSelector = '#btnReserve, #actionReserve, #actionReserveClone, #actionReserveCloneFixed';

    var oOptionBox = $('.option_box_id');
    var oSoldoutOptionBox = $('.soldout_option_box_id');
    var bIsReserveStatus = oOptionBox.length === oOptionBox.filter('[data-item-reserved="R"]').length;

    if (oOptionBox.length > 0) {
        $(sActionButtonSelector).show();
        $(sReserveSelector).hide();
    }

    if (oSoldoutOptionBox.length > 0 || oOptionBox.length < 1) {
        $(sActionButtonSelector).show();
        $(sReserveSelector).hide();

        return;
    }

    if (bIsReserveStatus) {
        $(sActionButtonSelector).hide();
        $(sReserveSelector).removeClass("displaynone").show();
        return;
    }

};


/**
 * 총 상품금액에 참조화폐 추가
 * @param iTotalPrice
 * @param sQuantityString
 */
function setTotalPriceRef(iTotalPrice, sQuantityString)
{
    var sPrePrice = '';
    var sPostPrice = '';
    var sTotalPrice = SHOP_PRICE_FORMAT.toShopPrice( iTotalPrice );
    var sTotalPriceRef = SHOP_PRICE_FORMAT.shopPriceToSubPrice(iTotalPrice);

    if (sTotalPriceRef == '') {
        return;
    }

    // ECHOSTING-58174
    if (sIsDisplayNonmemberPrice == 'T') {
        sTotalPrice = sNonmemberPrice;
        sTotalPriceRef = sNonmemberPrice;
    }

    var sTotalPriceSelector = oSingleSelection.getTotalPriceSelector();
    if (mobileWeb === true) {
        if (currency_disp_type == 'P') {
            $(sTotalPriceSelector).find('strong').append(' / ' + sTotalPriceRef);
        } else {
            $(sTotalPriceSelector).html('<strong class="price">'+ sTotalPriceRef +' '+sQuantityString + '</strong> / ' + sTotalPrice);
        }

        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer(true) === true) {
            parent.$(sTotalPriceSelector).find('strong').append(' / ' + sTotalPriceRef);
        }
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isExistLayer() === true) {
            if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer() === false) {
                $("#productOptionIframe").contents().find(sTotalPriceSelector).find('strong').append(' / ' + sTotalPriceRef);
            }
        }
    } else {
        if (currency_disp_type == 'P') {
            $(sTotalPriceSelector).append(' / ' + sTotalPriceRef );
        } else {
            $(sTotalPriceSelector).html('<strong><em>' + sTotalPriceRef + '</em></strong> ' + sQuantityString + '</span> / ' + sTotalPrice);
        }
    }
}

/**
 * 부가세 표시 문구 설정 반영
 * @param int iTotalPrice 총 상품 금액
 */
function setProductPriceTaxTypeText(iTotalPrice)
{
    var oProductTaxTypeText = TotalAddSale.getProductTaxTypeText();
    if (typeof(oProductTaxTypeText) === 'undefined') {
        return;
    }

    var iTotalOrderPrice = TotalAddSale.getTotalOrderPrice();
    iTotalPrice = SHOP_PRICE.toShopPrice(iTotalPrice);
    var iTaxPrice = (oProductTaxTypeText.product_tax_type_per > 0) ? SHOP_PRICE.toShopPrice(iTotalOrderPrice - iTotalPrice) : 0;
    if (iTotalPrice == 0) {
        return;
    }

    var iProductPrice = (oProductTaxTypeText.display_prd_vat_separately === 'T') ? iTotalOrderPrice : iTotalPrice;
    var iProductVatPrice = iTotalPrice;
    // 부가세율 공식
    if (oProductTaxTypeText.display_prd_vat_separately === 'F' || oProductTaxTypeText.product_tax_type !== 'A') {
        iTaxPrice = (iProductPrice * oProductTaxTypeText.product_tax_type_per) / (100 + oProductTaxTypeText.product_tax_type_per);
        var iShopDecimal = (oProductTaxTypeText.shop_decimal_place > 0) ? oProductTaxTypeText.shop_decimal_place : 1;
        iTaxPrice = Math.round(iTaxPrice * iShopDecimal) / iShopDecimal;
        iProductVatPrice = iProductVatPrice - iTaxPrice;
    }

    // 부가세가 0원 미만 및 판매가가 0원 이하 이면 부가세 발생 불가
    if (iTaxPrice < 0 || iProductPrice <= 0 || iProductVatPrice <= 0) {
        return;
    }

    var sTaxPrice = SHOP_PRICE_FORMAT.toShopPrice(iTaxPrice);
    var sProductPrice = SHOP_PRICE_FORMAT.toShopPrice(iProductPrice);
    var sProductVatPrice = SHOP_PRICE_FORMAT.toShopPrice(iProductVatPrice);

    var sProductTypeText = oProductTaxTypeText.product_tax_type_text.replace(/\[:제외금액:\]/g, sProductVatPrice);
    sProductTypeText = sProductTypeText.replace(/\[:포함금액:\]/g, sProductPrice);
    sProductTypeText = sProductTypeText.replace(/\[:부가세:\]/g, sTaxPrice);

    //Tags
    var sTags = 'font-size:' + parseInt(oProductTaxTypeText.product_tax_type_text_font_size, 10) + 'px;';
    sTags += 'color:' + oProductTaxTypeText.product_tax_type_text_color + ';';
    sTags += oProductTaxTypeText.product_tax_type_text_font_type;

    sProductTypeText = ' <span style="' + sTags + '">' + sProductTypeText + '</span>';

    if (mobileWeb === true) {
        $('#totalProducts .total').find('strong').append(sProductTypeText);

        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer(true) === true) {
            parent.$('#totalProducts .total').find('strong').append(sProductTypeText);
        }
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isExistLayer() === true) {
            if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isDisplayLayer() === false) {
                $("#productOptionIframe").contents().find('#totalProducts .total').find('strong').append(sProductTypeText);
            }
        }
    } else {
        $('#totalProducts .total').append(sProductTypeText);
    }
}


/**
 * 상품금액 계산 (모바일 및 할인판매가 체크)
 * @param iQuantity 수량
 * @param iQuantity 가격
 * @param sItemCode 옵션코드
 * @param bSoldout 품절여부
 * @param fCallback 콜백함수
 */
function getProductPrice(iQuantity, iOptionPrice, sItemCode, bSoldOut, fCallback)
{
    var fProductPrice = SHOP_PRICE.toShopPrice(product_price);
    if (typeof(iQuantity) == 'undefined' || iQuantity == 0) {
        iQuantity = 1;
    }
    // 1+N이벤트의 경우
    iEventQuantity = EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.getQuantity(iQuantity, iProductNo);
    fProductPrice = iOptionPrice * parseInt(iEventQuantity, 10);
    oProductList = TotalAddSale.getProductList();

    // 할인판매가
    if (sItemCode != 'undefined' && sItemCode != '' && sItemCode != '*' && sItemCode != '**' && sItemCode !== null) {
        // 옵션이 있는 경우에는 iOptionPrice가 판매가로 들어가 있어서
        // 할인된 금액이 처리되지 않지만 옵션이 없는 경우 이쪽으로 판매가가 할인 판매가로 설정되어버림
        // 상품 상세페이지내에서는 할인 판매가로 컨트롤 없음
        //fProductPrice = SHOP_PRICE.toShopPrice(product_sale_price);
        // 품절시 ajax호출안함
        TotalAddSale.setSoldOutFlag(bSoldOut);
        TotalAddSale.setQuantity(sItemCode, iQuantity);
        TotalAddSale.setParam('product', oProductList);
        if (has_option === 'F') {
            iQuantity = iEventQuantity;
        }
        TotalAddSale.getCalculatorSalePrice(fCallback, iOptionPrice * parseInt(iQuantity, 10));
    } else {
        if (bSoldOut) {
            TotalAddSale.setQuantity(sItemCode, 0);
            TotalAddSale.setParam('product', oProductList);
        }
        fCallback(fProductPrice);
    }

    return fProductPrice;
}

/**
 * 추가입력옵션 길이 체크
 * @param oObj
 * @param limit
 */
function addOptionWord(sId, sVal, iLimit)
{
    // 영문,한글 상관없이 iLimit 글자만큼 제한하도록 수정 (ECHOSTING-78226)
    //var iStrLen = stringByteSize(sVal);
    var iStrLen = sVal.length;
    if (iStrLen > iLimit) {
        alert(sprintf(__('메시지는 %s자 이하로 입력해주세요.'), iLimit));
        $('#'+sId).val(sVal.substr(0, sVal.length-1));
        return;
    }
    $('#'+sId).parent().parent().find('.length').html(iStrLen);
}

/**
 * 문자열을 UTF-8로 변환했을 경우 차지하게 되는 byte 수를 리턴한다.
 */
function stringByteSize(str)
{
    if (str == null || str.length == 0) return 0;
    var size = 0;
    for (var i = 0; i < str.length; i++) {
      size += charByteSize(str.charAt(i));
    }
    return size;
}

/**
 * 글자수 체크
 * @param ch
 * @returns {Number}
 */
function charByteSize(ch)
{
    if (ch == null || ch.length == 0 ) return 0;
    var charCode = ch.charCodeAt(0);
    if (escape(charCode).length > 4 ) {
        return 2;
    } else {
        return 1;
    }
}

/**
 * 기존의 SHOP_PRICE_FORMAT.toShopPrice() 의 래핑 함수
 * @param fPrice 옵션 추가 금액
 * @returns String 옵션 추가 금액(금액이 0보다 클경우 '+' 태그 추가)
 */
function getOptionPrice(fPrice)
{
        var sPricePlusTag = '';

        if (fPrice > 0) {
            sPricePlusTag = '+';
        } else {
            sPricePlusTag = '-';
            fPrice = Math.abs(fPrice);
        }

        var aFormat = SHOP_CURRENCY_FORMAT.getShopCurrencyFormat();
        var sPrice = SHOP_PRICE.toShopPrice(fPrice, true);
        return sPricePlusTag + aFormat.head + sPrice + aFormat.tail;
}

/**
 * 추가구성상품 여부 판단후 최종금액 산출
 * @param string sTotalSalePrice 총 상품 금액
 * @param int iTotalSalePrice 판매가
 * @returns string 추가구성 총 상품금액
 */
function getAddProductExistTotalSalePrice(iTotalSalePrice)
{
     $('.add_product_option_box_price').each(function(){
         iTotalSalePrice += parseFloat($(this).val());
     });

     return SHOP_PRICE_FORMAT.toShopPrice( iTotalSalePrice );
}

/**
 * 상품상세페이지 기존 모듈 제거하고 신규 모듈로 (ajax)
 * coupon_productdetail_new.html 에 쿠폰다운로드 신규모둘을 추가하여 ajax처리
 */
function getPrdDetailNewAjax()
{
    var sPath = document.location.pathname;

    if (jQuery.trim(parent.$('.ec-product-couponAjax').html()) != "") {
        return;
    }

    $.get('/product/coupon_productdetail_new.html',{'product_no' : iProductNo,'cate_no' : iCategoryNo, 'sPath' : sPath} ,function(sHtml){
        parent.$('.ec-product-couponAjax').html(sHtml);
        parent.$('.ec-product-couponAjax').show();

        $('div.eToggle .title').click(function(){
            var toggle = $(this).parent('.eToggle');
            if (toggle.hasClass('disable') == false){
                $(this).parent('.eToggle').toggleClass('selected')
            }
        });
    });
}

var SELECTEDITEM = {
    iSequence : 0,
    sElementIdPrefix : 'option_box',
    getElementId : function()
    {
        return this.sElementIdPrefix+this.getSequence();
    },
    getSequence : function()
    {
        return this.iSequence++;
    }
};

var CAPP_SIZE_GUIDE = function() {
    // 사이즈 가이드 데이터
    var aSizeGuide = {};

    var initialize = function() {
        $('.size_guide_info').live('click', function() {
            var sProductNo = $(this).attr('product_no');
            getSizeGuide(sProductNo);
        });
    };

    /**
     * 사이즈 가이드 팝업
     * @param sProductNo 상품번호
     */
    var getSizeGuide = function(sProductNo) {
        $('.xans-product-sizeguide').remove();
        if (typeof(aSizeGuide[sProductNo]) !== 'undefined') {
            layerSizeGuide(sProductNo);
            return;
        }

        $.get('/product/sizeguide.html?product_no='+sProductNo, function(sHtml)
        {
            setSizeGuide(sProductNo, sHtml);
            layerSizeGuide(sProductNo);
        });
    };

    var setSizeGuide = function(sProductNo, sHtml)  {
        aSizeGuide[sProductNo] = sHtml;
    };

    var layerSizeGuide = function(sProductNo) {
        if (mobileWeb === true) {
            window.open("/product/sizeguide.html?product_no=" + sProductNo, "popSizeGuide", "toolbar=no,scrollbars=no,resizable=yes,width=800,height=640,left=0,top=0");
        } else {
            $('body').append($('<div id="sSizeGuideLayer" style="z-index:10003; position:relative;"></div>'));
            $('#sSizeGuideLayer').html(aSizeGuide[sProductNo]);
            $('#sSizeGuideLayer').show();
        }
    };

    return {
        init : function() {
            initialize();
        }
    };

}();

$(document).ready(function(){
    CAPP_SIZE_GUIDE.init();
});
$(document).ready(function() {
    // 모바일 할인 적용 상품일 경우
    if (mobileWeb === true && typeof(isMobileDcStatus) !== 'undefined' && isMobileDcStatus == 'F' ) {
        // 모바일 할인이 적용 되지 않는 상품일 경우 가려준다.
        try{ $('#span_product_price_mobile_p_line').hide(); $('#span_product_price_mobile_d_line').hide(); }catch(e){}
    }
});
/**
 * SNS 링크 정보
 * @param sMedia
 * @param iProductNo
 */
function SnsLinkAction(sMedia, iProductNo)
{
    window.open(sSocialUrl + '?product_no=' + iProductNo + '&type=' + sMedia,sMedia);
}

/**
 * 상품 상세 페이지 이동
 * @param iProductNo 상품번호
 * @param iCategoryNo 카테고리 번호
 * @param iDisplayGroup 진열그룹
 * @param sLink URL정보
 */
function product_detail(iProductNo, iCategoryNo, iDisplayGroup, sLink)
{
    var sLink = sLink ? sLink : '/product/detail.html';
    sLink += '?product_no=' + iProductNo + '&cate_no=' + iCategoryNo + '&display_group=' + iDisplayGroup;

    try {
        opener.location.href = sLink;
    } catch (e) {
        location.href = sLink;
    }

    self.close();
}

/**
 * 추천메일보내기
 * @param product_no 상품번호
 * @param category_no 카테고리번호
 * @param display_group 진열그룹
 */
function recommend_mail_pop(product_no, category_no, display_group)
{
    option = "'toolbar=no," + "location=no," + "directories=no," + "status=no," + "menubar=no," + "scrollbars=yes," + "resizable=yes," + "width=576," + "height=568," + "top=300," + "left=200"

    filename = "/product/recommend_mail.html?product_no=" + product_no + "&category_no=" + category_no;
    filename += "&display_group=" + display_group

    window.open(filename,"recommend_mail_pop",option);
}

/**
 * 상품조르기 팝업 호출
 * @param product_no 상품번호
 */
function request_pop(product_no)
{
    option = "'toolbar=no," + "location=no," + "directories=no," + "status=no," + "menubar=no," + "scrollbars=yes," + "resizable=yes," + "width=576," + "height=568," + "top=300," + "left=200"
    filename = "/product/request.html?product_no[]=" + product_no;

    window.open(filename,"request_pop",option);
}

//모바일 옵션선택레이어(옵션미선택후 구매하기/장바구니/관심상품버튼 클릭시) 후처리 모음...
var EC_SHOP_FRONT_PRODUCT_OPTIONLAYER = {
    bIsUseOptionLayer : false,

    /**
     * 설정값 Set
     * @param bIsExec 강제실행여부
     * @param oCallBack 콜백함수(관심상품에서는 따로 fixedActionButton아이디값을 확인하지않고 실행되기떄문에 디자인확인하지 않고 바로 실행)
     */
    init : function(oCallBack)
    {
        //레이어가 사용가능한 상태인지 확인..

        //모바일이 아니라면 사용하지 않음
        if (mobileWeb !== true) {
            return;
        }

        //아이프레임 내에서는 레이어를 다시띄우지 않음
        if (CAPP_SHOP_FRONT_COMMON_UTIL.findTargetFrame() === parent) {
            return;
        }

        $.ajax({
            url : '/exec/front/Product/Moduleexist?section=product&file=layer_option&module=product_detail',
            dataType : 'json',
            success : function (data) {
                if (data.result === true) {
                    EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.bIsUseOptionLayer = true;
                    if (jQuery.isFunction(oCallBack)) {
                        oCallBack();
                    }
                }
            }
        });
    },

    /**
     * 레이어띄우기(기존 로직때문에 영향이 있어 레이어를 띄우지 못하는 상황이면 false로 리턴하는 로직도 같이..)
     * @param iProductNo 상품번호
     * @param iCategoryNo 카테고리 번호
     * @param sType 각 액션별 정의(일반상품-normal / 세트상품-set / 관심상품에서 호출-wishlist)
     */
    setLayer : function(iProductNo, iCategoryNo, sType)
    {
        var iCategoryNo = iCategoryNo || '';
        var iProductNo = iProductNo || '';

        //상품번호는 필수
        if (iProductNo === '') return false;

        //레이어 사용가능상태가 아니면 false로 바로 리턴
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.bIsUseOptionLayer === false) {
            return false;
        }

        try {
            EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.createLayer(iProductNo, iCategoryNo, sType)
        } catch (e) {
            return false;
        }

        return true;
    },

    /**
     * 모듈이 존재하는지 확인후에 레이어 아이프레임 생성
     * @param iProductNo 상품번호
     * @param iCategoryNo 카테고리 번호
     * @param sType 각 액션별 정의(일반상품-normal / 세트상품-set / 관심상품에서 호출-wishlist)
     */
    createLayer : function(iProductNo, iCategoryNo, sType)
    {
        try {
            $('#opt_layer_window').remove();
        } catch ( e ) {}

        EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.setHTML(iProductNo, iCategoryNo, sType);

        //아이프레임이 로드된후에 parent 상세페이지의 옵션정보와 동기화
        $("#productOptionIframe").load(function() {
            $("#productOptionIframe").css("height", $("#productOptionIframe").contents().find("#product_detail_option_layer").height());
            if (sType === 'normal') {//일반상품 상세페이지와 레이어 동기화
                EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.setNormalInit();
            } else if (sType === 'set') {//세트상품 상세페이지와 레이어 동기화
                EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.setSetInit();
            }// 관심상품페이지에서 실행시에는 액션없음

            EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.showLayer();
        });
    },

    /**
     * 레이어노출시키기
     */
    showLayer : function()
    {
        var iTop = parseInt(( $(window).height() - $("#productOptionIframe").height() ) / 2);
        $("#opt_layer_iframe_parent").css({"top": iTop, "left": 0});
        $('html, body').css({'overflow-y': 'hidden', width: '100%', height: '100%'});
        $('#opt_layer_window').show();
    },

    /**
     * 레이어 HTML생성
     * @param iProductNo 상품번호
     * @param iCategoryNo 카테고리 번호
     * @param sType 각 액션별 정의(일반상품-normal / 세트상품-set / 관심상품에서 호출-wishlist)
     */
    setHTML : function(iProductNo, iCategoryNo, sType)
    {
        var sPrdOptUrl = "/product/layer_option.html?product_no="+iProductNo+'&cate_no='+iCategoryNo+"&bPrdOptLayer=T";
        if (sType === 'wishlist') {
            sPrdOptUrl += '&sActionType=' + sType;
        }
        var aPrdOptLayerHtml = [];

        aPrdOptLayerHtml.push('<div id="opt_layer_window" style="display:none">');
        aPrdOptLayerHtml.push('<div id="opt_layer_background" style="position:absolute; top:0; left:0; width:100%; height:100%; background:#000; opacity:0.3; filter:alpha(opacity=30); z-index:9994;"></div>');
        aPrdOptLayerHtml.push('<div id="opt_layer_iframe_parent" style="position:absolute; top:0; left:0; width:100%; z-index:9995;">');
        aPrdOptLayerHtml.push('<iframe src="'+sPrdOptUrl+'" id="productOptionIframe" style="width:100%; height:100%; border:0;"></iframe>');
        aPrdOptLayerHtml.push('</script>');
        aPrdOptLayerHtml.push('</div>');
        aPrdOptLayerHtml.push('</div>');

        $('body').append(aPrdOptLayerHtml.join(''));
    },

    /**
     * 일반상품 담기시 레이어 동기화
     * 옵션선택레이어가 뜬후에 상세페이지에있던 옵션선택정보와 동기화하는듯
     */
    setNormalInit : function()
    {
        var sValue = '*';
        var oTarget = null;
        var oOptionIframe = '';

        if (Olnk.isLinkageType(option_type) === true) {
            $('select[id^="' + product_option_id + '"]').each(function() {
                sValue = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectedValue(this);
                if (Olnk.getCheckValue(sValue,'') === true ) {
                    oTarget = $("#productOptionIframe")[0].contentWindow.$('#product_detail_option_layer #'+ $(this).attr('id')+'').val($(this).val()).trigger('change');
                    $("#productOptionIframe")[0].contentWindow.EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(oTarget, sValue);
                }
            });
        } else {
            $('select[id^="' + product_option_id + '"]').each(function() {
                var sSelectOptionId = $(this).attr('id');
                sValue = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectedValue(this);
                oTarget = $("#productOptionIframe")[0].contentWindow.$('#product_detail_option_layer #'+sSelectOptionId+'');
                oOptionIframe = $("#productOptionIframe")[0].contentWindow.EC_SHOP_FRONT_NEW_OPTION_COMMON;

                if (EC_SHOP_FRONT_NEW_OPTION_VALIDATION.isSeparateOption(oTarget) === true) {
                    oOptionIframe.setValue(oTarget, sValue, true, true);
                } else {
                    oOptionIframe.setValue(oTarget, sValue);
                }
            });
        }
    },

    /**
     * 세트상품 담기시 레이어 동기화
     * 옵션선택레이어가 뜬후에 상세페이지에있던 옵션선택정보와 동기화하는듯
     */
    setSetInit : function()
    {
        var iTotalOptCnt = $('[class*='+set_option.setproduct_require+']').length
        var iOptionSeq = 0;
        $('[class*='+set_option.setproduct_require+']').each(function(i){
            if ($(this)[0].tagName == 'INPUT') {
                return;
            }
            var sSelectOptionId = $(this).attr('id');
            var sParentVal = EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionSelectedValue(this);

            if (sParentVal != '*' && sParentVal != '**' && sParentVal != '') {
                iOptionSeq = i + 2;
            }
            if (iTotalOptCnt >= iOptionSeq) {
                $("#productOptionIframe").contents().find('.'+set_option.setproduct_require+'_'+iOptionSeq).attr('disabled', false);
            }

            var oTarget = $("#productOptionIframe")[0].contentWindow.$('#product_detail_option_layer #'+sSelectOptionId+'');//.val(sParentVal).trigger('change');
            $("#productOptionIframe")[0].contentWindow.EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(oTarget, sParentVal);
        });
    },

    /**
     * 옵션선택레이어가 존재하는지 여부(기존 비교 그대로)
     * @param bIsParent 부모Element에서 옵션레이어를 찾을 경우
     */
    isExistLayer : function(bIsParent)
    {
        if (mobileWeb === false) {
            return false;
        }

        if (bIsParent === true) {
            return typeof(window.parent) == 'object' && parseInt(parent.$('#opt_layer_window').length) > 0;
        } else {
            return typeof($('#opt_layer_window')) == 'object' && parseInt($('#opt_layer_window').length) > 0;
        }
    },

    /**
     * 옵션선택 레이어가 display상태인지 여부
     * @param bIsParent 부모Element에서 옵션레이어를 찾을 경우
     */
    isDisplayLayer : function(bIsParent)
    {
        if (mobileWeb === false) {
            return false;
        }

        if (bIsParent === true) {
            return typeof(bPrdOptLayer) !== 'undefined' && bPrdOptLayer === 'T' && parent.$('#opt_layer_window').css('display') === 'block';
        } else {
            return ($('#opt_layer_window').css('display') === 'none') ? false : true;
        }
    }
};

/**
 * 프론트 옵션 정보 관리
 */
var EC_SHOP_FRONT_PRODUCT_OPTION_INFO = {
    /**
     * 옵션 타입 리턴
     * @param int iProductNo 상품 번호
     * @return string 옵션 타입
     */
    getOptionType: function (oOptionChoose) {
        return EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionType(oOptionChoose);
    },

    /**
     * 옵션 리스팅 타입 리턴
     * @param int iProductNo 상품 번호
     * @return string 옵션 리스팅 타입
     */
    getItemListingType: function (oOptionChoose) {
        return EC_SHOP_FRONT_NEW_OPTION_COMMON.getOptionListingType(oOptionChoose);
    },

    /**
     * 전체 품목 재고 정보
     * @param int iProductNo 상품 번호
     * @return object 품목별 재고 정보 리스트
     */
    getAllItemStorkInfo: function (iProductNo) {
        return EC_SHOP_FRONT_NEW_OPTION_COMMON.getProductStockData(iProductNo);
    },

    /**
     * 옵션값으로 품목코드 구하여 리턴
     * @param int iProductNo 상품 번호
     * @param array aOptionValue 옵션값
     * @return string 품목코드
     */
    getItemCodeByOptionValue: function (iProductNo, aOptionValue) {
        var sOptionValue = aOptionValue.join("#$%");

        return EC_SHOP_FRONT_NEW_OPTION_DATA.getItemCode(iProductNo, sOptionValue);
    }
};

var EC_FRONT_NEW_PRODUCT_QUANTITY_VALID = {
    setBuyUnitQuantity : function(iBuyUnit, iProductMin, sBuyUnitType, sOrderLimitType, iItemCount, sType)
    {
        // 구매주문단위가 상품별의 경우 1씩 증가
        if (sBuyUnitType === 'P') {
            iBuyUnit = (iItemCount > 1) ? 1 : iBuyUnit;
            // 최초 셋팅되는 수량은 "상품"기준 구매단위 에서 "품목"기준 최소/최대 수량 =? 최소수량이 기본수량
            if (sType === 'base' && sOrderLimitType === 'O') {
                iBuyUnit = iProductMin;
            }
        }
        return iBuyUnit;
    },
    getBuyUnitQuantity : function(sType)
    {
        return this.setBuyUnitQuantity(parseInt(buy_unit,10), parseInt(product_min,10), buy_unit_type, order_limit_type, item_count, sType);
    },
    getSetBuyUnitQuantity : function(aProductInfo, sType) {

        return this.setBuyUnitQuantity(parseInt(aProductInfo.buy_unit,10), parseInt(aProductInfo.product_min,10), aProductInfo.buy_unit_type, aProductInfo.order_limit_type, aProductInfo.item_count, sType);
    },
    setProductMinQuantity : function(iBuyUnit, iProductMin, sBuyUnitType, sOrderLimitType, iItemCount)
    {
        if (isNewProductSkin() === true) {
            var iItemCount = typeof(iItemCount) === "undefined" ? 1: parseInt(iItemCount, 10);
            // 단품 or 품목이 1개인경우 품목-품목 기준으로 동작
            if (iItemCount > 1) {
                // 상품기준 단위 증차감 단위는 1
                if (sBuyUnitType === 'P' && sOrderLimitType === 'P') {
                    iProductMin = 1;
                    // "품목"기준 단위 이면서 최소/최대 "상품"기준의 경우 "품목"구매단위가 최소수량
                } else if (sOrderLimitType === 'P') {
                    iProductMin = iBuyUnit;
                }
            }
        } else {
            var iBuyUnit = parseInt(buy_unit, 10);
            iBuyUnit = iBuyUnit < 1 ? 1 : iBuyUnit;
            var iFactor = Math.ceil(iProductMin / iBuyUnit);
            iProductMin = iBuyUnit * iFactor;
        }
        return iProductMin;
    },
    getProductMinQuantity : function()
    {
        return this.setProductMinQuantity(parseInt(buy_unit,10), parseInt(product_min,10), buy_unit_type, order_limit_type, item_count);
    },
    getSetProductMinQuantity : function(aProductInfo)
    {
        return this.setProductMinQuantity(parseInt(aProductInfo.buy_unit,10), parseInt(aProductInfo.product_min,10), aProductInfo.buy_unit_type, aProductInfo.order_limit_type, aProductInfo.item_count);
    },
    getNumberValidate : function(e)
    {
        var keyCode = e.which;
        // Tab, Enter, Delete키 포함
        var isNumberPress = ((keyCode >= 48 && keyCode <= 57 && !e.shiftKey) // 숫자키
        || (keyCode >= 96 && keyCode <= 105) // 키패드
        || keyCode == 8 // BackSpace
        || keyCode == 9 // Tab
        || keyCode == 46); // Delete

        if (!isNumberPress) {
            e.preventDefault();
        }
    }
};

if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function(elt /*, from*/) {
        var len  = this.length >>> 0;
        var from = Number(arguments[1]) || 0;

        from = (from < 0) ? Math.ceil(from) : Math.floor(from);
        if (from < 0) {
            from += len;
        }

        for (from; from < len; from++) {
            if (from in this && this[from] === elt) {
                return from;
            }
        }
        return -1;
    };
}

if (!Object.size) {
    Object.size = function(obj) {
        var size = 0, key;
        for (key in obj) {
            if (obj.hasOwnProperty(key)) size++;
        }
        return size;
    };
}

if (!Object.keys) Object.keys = function(o) {
    if (o !== Object(o))
    throw new TypeError('Object.keys called on a non-object');
    var k=[],p;
    for (p in o) if (Object.prototype.hasOwnProperty.call(o,p)) k.push(p);
    return k;
}

/**
 * 기존에 product_submit함수에 있던 내용들을 메소드 단위로 리펙토링한 객체
 */
var PRODUCTSUBMIT = {
    oConfig : {
        'sFormSelector' : '#frm_image_zoom'
    },
    /**
     * 1 : 바로 구매, 2 : 장바구니 넣기
     */
    sType : null,
    sAction : null,
    oObject : null,
    oValidate : null,
    oForm : null,
    oDebug : null,
    bIsDebugConsoleOut : false,

    /**
     * 초기화
     */
    initialize : function(sType, sAction, oObject)
    {
        this.oDebug = this.DEBUG.initialize(this);
        this.oDebug.setInfo('PRODUCTSUBMIT.initialize 시작');
        this.oDebug.setInfo('sType : ', sType);
        this.oDebug.setInfo('sAction : ', sAction);
        this.oDebug.setInfo('oObject : ', oObject);

        if (typeof(sType) === 'undefined' || ((sType !== 'sms_restock' && sType !== 'email_restock') && typeof(sAction) === 'undefined')) {
            this.oDebug.setMessage('PRODUCTSUBMIT.initialize fail');
            return false;
        }

        this.sType = sType;
        this.sAction = sAction;
        this.oObject = oObject;
        this.oValidate = this.VALIDATION.initialize(this);
        this.UTIL.initialize(this);
        this.oForm = $(this.oConfig.sFormSelector);
        this.oForm.find(':hidden').remove();
    },
    /**
     * 데이터 검증
     */
    isValidRequest : function()
    {
        try {
            this.oDebug.setInfo('PRODUCTSUBMIT.isValidRequest 시작');

            this.oDebug.setInfo('PRODUCTSUBMIT.oValidate.isRequireLogin');
            if (this.oValidate.isRequireLogin() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.oValidate.isRequireLogin fail');
            }

            this.oDebug.setInfo('PRODUCTSUBMIT.oValidate.isPriceContent');
            if (this.oValidate.isPriceContent() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.oValidate.isPriceContent fail');
            }

            this.oDebug.setInfo('PRODUCTSUBMIT.oValidate.isOptionDisplay');
            if (this.oValidate.isOptionDisplay() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.oValidate.isOptionDisplay fail');
            }

            this.oDebug.setInfo('PRODUCTSUBMIT.oValidate.isItemInStock');
            if (this.oValidate.isItemInStock() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.oValidate.isItemInStock fail');
            }

            this.oDebug.setInfo('PRODUCTSUBMIT.oValidate.isValidOption');
            if (this.oValidate.isValidOption() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.oValidate.isValidOption fail');
            }

            this.oDebug.setInfo('PRODUCTSUBMIT.oValidate.isValidAddproduct');
            if (this.oValidate.isValidAddproduct() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.oValidate.isValidAddproduct fail');
            }

        } catch(mError) {
            return this.DEBUG.messageOut(mError);
        }
        return true;
    },
    /**
     * 전송폼 생성
     */
    setBasketForm : function()
    {
        try {
            this.oDebug.setInfo('PRODUCTSUBMIT.setBasketForm 시작');
            // 예약 주문 체크
            STOCKTAKINGCHECKRESERVE.checkReserve();

            this.oForm.attr('method', 'POST');
            this.oForm.attr('action', '/' + this.sAction);

            this.oDebug.setInfo('PRODUCTSUBMIT.setCommonInput');
            if (this.setCommonInput() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.setCommonInput fail');
            }

            this.oDebug.setInfo('PRODUCTSUBMIT.setOptionId');
            if (this.setOptionId() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.setOptionId fail');
            }

            this.oDebug.setInfo('PRODUCTSUBMIT.setAddOption');
            if (this.setAddOption() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.setAddOption fail');
            }

            this.oDebug.setInfo('PRODUCTSUBMIT.setQuantityOveride');
            if (this.setQuantityOveride() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.setQuantityOveride fail');
            }

            this.oDebug.setInfo('PRODUCTSUBMIT.setSelectedItem');
            if (this.setSelectedItemHasOptionT() === false || this.setSelectedItemHasOptionF() === false) {
//                if (this.setSelectedItemHasOptionT() === false || this.setSelectedItemHasOptionF() === false || this.setSingleSelectedItem() === false) {
                this.oDebug.setMessage('PRODUCTSUBMIT.setSelectedItem fail');
            }

        } catch(mError) {
            return this.DEBUG.messageOut(mError);
        }

        return true;
    },
    setBasketAjax : function()
    {
        this.oDebug.setInfo('PRODUCTSUBMIT.setBasketAjax 시작');
        if (typeof(ACEWrap) !== 'undefined') {
            // 에이스카운터
            ACEWrap.addBasket();
        }

        // 파일첨부 옵션의 파일업로드가 없을 경우 바로 장바구니에 넣기
        if (FileOptionManager.existsFileUpload() === false) {
            action_basket(this.sType, 'detail', this.sAction, this.oForm.serialize(), this.UTIL.getData('sBasketType'));
        } else {
            // 파일첨부 옵션의 파일업로드가 있으면
            FileOptionManager.upload(function(mResult){
                // 파일업로드 실패
                if (mResult === false) {
                    PRODUCTSUBMIT.DEBUG.setMessage('PRODUCTSUBMIT.setBasketAjax fail - 파일업로드 실패');
                    return false;
                }

                // 파일업로드 성공
                for (var sId in mResult) {
                    PRODUCTSUBMIT.UTIL.appendHidden(sId, FileOptionManager.encode(mResult[sId]));
                }

                action_basket(PRODUCTSUBMIT.sType, 'detail', PRODUCTSUBMIT.sAction, PRODUCTSUBMIT.oForm.serialize(), PRODUCTSUBMIT.UTIL.getData('sBasketType'));
            });
        }
    },
    setSelectedItem : function(sItemCode, iQuantity, sParameterName, sAdditionalData)
    {
        iQuantity = parseInt(iQuantity, 10);
        if (isNaN(iQuantity) === true || iQuantity < 1) {
            this.oDebug.setMessage('PRODUCTSUBMIT.setSelectedItem fail - iQuantity Fault');
            return false;
        }

        if (typeof(sItemCode) !== 'string') {
            this.oDebug.setMessage('PRODUCTSUBMIT.setSelectedItem fail - sItemCode Fault');
            return false;
        }

        if (typeof(sParameterName) === 'undefined') {
            sParameterName = 'selected_item[]';
        }

        if (typeof(sAdditionalData) === 'undefined') {
            sAdditionalData = '';
        } else {
            sAdditionalData = '||' + sAdditionalData
        }

        this.UTIL.prependHidden(sParameterName, iQuantity+'||'+sItemCode+sAdditionalData);
        return true;
    },
    getQuantity : function(oQuantityElement)
    {
        if (typeof(quantity_id) === 'undefined') {
            var quantity_id = '#quantity';
        }
        var $oQuantityElement = $(quantity_id);
        if (typeof(oQuantityElement) === 'object') {
            $oQuantityElement = oQuantityElement;
        }
        return parseInt($oQuantityElement.val(),10);
    },
    setSelectedItemHasOptionF : function()
    {
        if (has_option !== 'F') {
            return true;
        }

        if (item_code === undefined) {
            var sItemCode = product_code+'000A';
        } else {
            var sItemCode = item_code;
        }
        if (NEWPRD_ADD_OPTION.checkSoldOutProductValid(this.oObject) === false && EC_SHOP_FRONT_PRODUCT_RESTOCK.isRestock(this.sType) === false) {
            this.setSelectedItem(sItemCode, this.getQuantity());
        }

        return true;
    },
    setEtypeSelectedItem : function(bFormAppend)
    {
        var _sItemCode = sProductCode + '000A';
        var iQuantity = 0;
        var sSelectedItemByEtype = '';
        var _aItemValueNo = '';
        if (isNewProductSkin() === false) {
            iQuantity = this.getQuantity();

            // 수량이 없는 경우에는 최소 구매 수량으로 던진다!!
            if (iQuantity === undefined) {
                iQuantity = product_min;
            }
            var _aItemValueNo = Olnk.getSelectedItemForBasketOldSkin(sProductCode, $('[id^="product_option_id"]'), iQuantity);

            if (_aItemValueNo.bCheckNum === false ) {
                _aItemValueNo = Olnk.getProductAllSelected(sProductCode , $('[id^="product_option_id"]') , iQuantity);
                if (_aItemValueNo === false) {
                    this.oDebug.setMessage('etype error');
                }
            }
            sSelectedItemByEtype = 'selected_item_by_etype[]='+$.toJSON(_aItemValueNo) + '&';
            if (bFormAppend === true) {
                this.setSelectedItem(_sItemCode, iQuantity);
                this.UTIL.appendHidden('selected_item_by_etype[]', $.toJSON(_aItemValueNo));
            }
        } else {
            var bIsProductEmptyOption = this.UTIL.getData('bIsProductEmptyOption');
            // 메인상품 선택여부 확인 false : 선택함 || true : 선택안함
            if (bIsProductEmptyOption === false && NEWPRD_ADD_OPTION.checkSoldOutProductValid(this.oObject) === false) {
                $('.option_box_id').each(function (i) {
                    iQuantity = PRODUCTSUBMIT.getQuantity($('#' + $(this).attr('id').replace('id', 'quantity')));
                    _aItemValueNo = Olnk.getSelectedItemForBasket(sProductCode, $(this), iQuantity);

                    if (_aItemValueNo.bCheckNum === false) { // 옵션박스는 있지만 값이 선택이 안된경우
                        _aItemValueNo = Olnk.getProductAllSelected(sProductCode, $(this), iQuantity);
                    }
                    if (bFormAppend === true) {
                        PRODUCTSUBMIT.setSelectedItem(_sItemCode, iQuantity);
                        PRODUCTSUBMIT.UTIL.prependHidden('selected_item_by_etype[]', $.toJSON(_aItemValueNo));
                    }
                    sSelectedItemByEtype += 'selected_item_by_etype[]='+$.toJSON(_aItemValueNo) + '&';
                    var oItem = $('[name="item_code[]"]:eq(' + i + ')');
                    var sItemCode = oItem.val();

                    //품목별 추가옵션 셋팅
                    var sItemAddOption = unescape(oItem.attr('data-item-add-option'));
                    NEWPRD_ADD_OPTION.setItemAddOption(_sItemCode + '_' + i, sItemAddOption, PRODUCTSUBMIT.oForm);
                });

                // 전부 선택인 경우 필요값 생성한다.
                if (_aItemValueNo === '') {
                    iQuantity = this.getQuantity();
                    _aItemValueNo = Olnk.getProductAllSelected(sProductCode, $('[id^="product_option_id"]'), iQuantity);
                    if (_aItemValueNo !== false) {
                        if (bFormAppend === true) {
                            this.setSelectedItem(_sItemCode, iQuantity);
                            this.UTIL.prependHidden('selected_item_by_etype[]', $.toJSON(_aItemValueNo));
                        }
                        sSelectedItemByEtype += 'selected_item_by_etype[]='+$.toJSON(_aItemValueNo) + '&';
                    }
                }
            }
        }
        this.UTIL.setData('sSelectedItemByEtype', sSelectedItemByEtype);
    },
    setSelectedItemHasOptionT : function()
    {
        if (has_option !== 'T') {
            return true;
        }

        if (Olnk.isLinkageType(sOptionType) === true) {
            this.setEtypeSelectedItem(true);
        } else {
            if (isNewProductSkin() === true && NEWPRD_ADD_OPTION.checkSoldOutProductValid(this.oObject) === false) {
                if ($('[name="quantity_opt[]"][id^="option_box"]').length > 0 && $('[name="quantity_opt[]"][id^="option_box"]').length == $('[name="item_code[]"]').length) {

                    $('[name="quantity_opt[]"][id^="option_box"]').each(function(i) {

                        var oItem = $('[name="item_code[]"]:eq('+i+')');
                        var sItemCode = oItem.val();
                        PRODUCTSUBMIT.setSelectedItem(sItemCode, PRODUCTSUBMIT.getQuantity($(this)))

                        //품목별 추가옵션 셋팅
                        var sItemAddOption = unescape(oItem.attr('data-item-add-option'));
                        NEWPRD_ADD_OPTION.setItemAddOption(sItemCode, sItemAddOption, PRODUCTSUBMIT.oForm);
                    });
                }
            } else {
                // 뉴 상품 + 구스디 스킨
                var aItemCode = ITEM.getItemCode();
                for (var i = 0; i < aItemCode.length ; i++) {
                    var sItemCode = aItemCode[i];
                    this.setSelectedItem(sItemCode, this.getQuantity(i));
                }
            }
        }
        return true;
    },
    setQuantityOveride : function()
    {
        if (this.sType !== 1 && this.sType !== 'naver_checkout') {
            return true;
        }

        // 전역변수임
        sIsPrdOverride = 'F';
        if (this.sType === 1) {
            var aItemParams = [];
            var aItemCode = ITEM.getItemCode();
            for (var i = 0, length = aItemCode.length; i < length; i++) {
                aItemParams.push("item_code[]=" + aItemCode[i]);
            }
            var sOptionParam = this.UTIL.getData('sOptionParam');
            sOptionParam = sOptionParam + '&delvtype=' + delvtype + '&' + aItemParams.join("&");
            if (Olnk.isLinkageType(sOptionType) === true) {
                this.setEtypeSelectedItem();
                var sSelectedItemByEtype = this.UTIL.getData('sSelectedItemByEtype', sSelectedItemByEtype);
            }
            selectbuy_action(sOptionParam, iProductNo, sSelectedItemByEtype);
        }

        if (this.sType === 'naver_checkout') {
            sIsPrdOverride = 'T';
        }
        this.UTIL.appendHidden('quantity_override_flag', sIsPrdOverride);
    },
    /**
     * 실제 옵션에 대한 검증이 아니라 구상품과의 호환을 위해 존재하는 파라미터들을 세팅해주는 메소드
     */
    setOptionId : function()
    {
        var count = 1;
        var sOptionParam = '';
        $('select[id^="' + product_option_id + '"]').each(function()
        {
            PRODUCTSUBMIT.UTIL.appendHidden('optionids[]', $(this).attr('name'));
            if ($(this).attr('required') == true || $(this).attr('required') == 'required') {
                PRODUCTSUBMIT.UTIL.appendHidden('needed[]', $(this).attr('name'));
            }
            var iSelectedIndex = $(this).get(0).selectedIndex;
            if ($(this).attr('required') && iSelectedIndex > 0) iSelectedIndex -= 1;

            if (iSelectedIndex > 0) {
                sOptionParam += '&option' + count + '=' + iSelectedIndex;
                var sValue = $(this).val();
                var aValue = sValue.split("|");
                PRODUCTSUBMIT.UTIL.appendHidden($(this).attr('name'), aValue[0]);
                ++count;
            }
        });
        this.UTIL.setData('sOptionParam', sOptionParam);
    },
    setAddOption : function()
    {
        if (add_option_name.length === 0) {
            return;
        }
        var iAddOptionNo = 0;
        var aAddOptionName = [];
        for (var i = 0, iAddOptionNameLength = add_option_name.length; i < iAddOptionNameLength; i++) {
            if ($('#' + add_option_id + i).val() == '' || typeof($('#' + add_option_id + i).val()) == 'undefined') {
                continue;
            }
            this.UTIL.appendHidden('option_add[]', $('#' + add_option_id + i).val());
            aAddOptionName[iAddOptionNo++] = add_option_name[i];
        }
        this.UTIL.appendHidden('add_option_name', aAddOptionName.join(';'));
        NEWPRD_ADD_OPTION.setItemAddOptionName(this.oForm); // 품목별 추가옵션명인데 왜 상품단위로 도는지 확인이 필요함
    },
    setCommonInput : function()
    {
        var sBasketType = (typeof(basket_type) === 'undefined') ? 'A0000' : basket_type;
        this.UTIL.setData('sBasketType', sBasketType);

        var oCommon = {
            'product_no' : iProductNo,
            'product_name' : product_name,
            'main_cate_no' : iCategoryNo,
            'display_group' : iDisplayGroup,
            'option_type' : option_type,
            'product_min' : product_min,
            'command' : 'add',
            'has_option' : has_option,
            'product_price' : product_price,
            'multi_option_schema' : $('#multi_option').html(),
            'multi_option_data' : '',
            'delvType' : delvtype,
            'redirect' : this.sType,
            'product_max_type' : product_max_type,
            'product_max' : product_max,
            'basket_type' : sBasketType
        };
        this.UTIL.appendHidden(oCommon);

        if (typeof(CAPP_FRONT_OPTION_SELECT_BASKETACTION) !== 'undefined' && CAPP_FRONT_OPTION_SELECT_BASKETACTION === true) {
            this.UTIL.appendHidden('basket_page_flag', 'T');
        } else {
            this.UTIL.appendHidden('prd_detail_ship_type', $('#delivery_cost_prepaid').val());
        }
        // 수량 체크
        var iQuantity = 1;
        if (EC_SHOP_FRONT_PRODUCT_RESTOCK.isRestock(this.sType) === false) {
            iQuantity = checkQuantity();
            if (iQuantity == false) {
                // 현재 관련상품 선택 했는지 여부 확인
                if (NEWPRD_ADD_OPTION.checkRelationProduct(this.oObject, this.sType) === false) {
                    return false;
                }
            }
        }

        // 폼 세팅
        if (iQuantity == undefined ||  isNaN(iQuantity) === true || iQuantity < 1) {
            iQuantity = 1;
        }
        this.UTIL.appendHidden('quantity', iQuantity);
    },
    VALIDATION : {
        initialize : function(oParent)
        {
            this.parent = oParent;
            return this;
        },
        isRequireLogin : function()
        {
            // ECHOSTING-58174
            if (sIsDisplayNonmemberPrice !== 'T') {
                return true;
            }
            switch (this.parent.sType) {
                case 1 :
                    alert(__('로그인후 상품을 구매해주세요.'));
                    break;
                case 2 :
                    alert(__('로그인후 장바구니 담기를 해주세요.'));
                     break
                default :
                    break;
            }
            btn_action_move_url('/member/login.html');
            return false;
        },
        isPriceContent : function()
        {
            if (typeof(product_price_content) === 'undefined') {
                return true;
            }

            var sProductcontent = product_price_content.replace(/\s/g, '').toString();
            if (sProductcontent === '1') {
                alert(sprintf(__('%s 상품은 구매할 수 있는 상품이 아닙니다.'), product_name));
                return false;
            }

            return true;
        },
        isOptionDisplay : function()
        {
            if (typeof(EC_SHOP_FRONT_NEW_OPTION_COMMON) !== 'undefined'
                && has_option === 'T'
                && Olnk.isLinkageType(sOptionType) === false
                && EC_SHOP_FRONT_NEW_OPTION_COMMON.isValidOptionDisplay(product_option_id) === false) {

                alert(sprintf(__('%s 상품은 구매할 수 있는 상품이 아닙니다.'), product_name));
                return false;
            }
            return true;
        },
        isItemInStock : function()
        {
            if (EC_SHOP_FRONT_PRODUCT_RESTOCK.isRestock(this.parent.sType) === false && ($('.option_box_id').length == 0 && $('.soldout_option_box_id').length > 0) === true) {
                alert(__('품절된 상품은 구매가 불가능합니다.'));
                return false;
            }

            return true;
        },
        isValidOption : function()
        {
            // 필수옵션 체크
            var bIsProductEmptyOption = EC_SHOP_FRONT_PRODUCT_RESTOCK.isRestock(this.parent.sType) === false && checkOptionRequired() == false;
            this.parent.UTIL.setData('bIsProductEmptyOption', bIsProductEmptyOption);

            //추가구성상품 옵션 체크
            var oValidAddProductCount = NEWPRD_ADD_OPTION.isValidAddOptionSelect(this.parent.oForm);

            //관련상품 옵션 체크
            var oValidRelationProductCount = NEWPRD_ADD_OPTION.isValidRelationProductSelect(this.parent.oForm, this.parent.oObject, bIsProductEmptyOption);

            // 개별 구매 관련 검증된 데이터
            var oIndividualValidData = NEWPRD_ADD_OPTION.getIndividualValidCheckData(oValidRelationProductCount, oValidAddProductCount, bIsProductEmptyOption, this.parent.oForm);

            // 옵션 체크
            if (bIsProductEmptyOption === true) {
                // 실패 타입 존재 할 경우
                if (oIndividualValidData.sFailType !== '') {
                    return false;
                }
                //관련상품 및 추가구성상품 단독구매시 유효성 메시지 노출여부 결정(순차 검증진행 추가 or 관련 + 본상품)
                if (NEWPRD_ADD_OPTION.checkIndividualValidAction(oValidRelationProductCount, oValidAddProductCount) === false) {
                    return false;
                }
                // 독립형 일때
                var oExistRequiredSelect = (option_type === 'F') ? $('select[id^="' + product_option_id + '"][required="true"]') : false;
                var sMsg = __('필수 옵션을 선택해주세요.');
                try {
                    // 관련상품 체크 확인 유무
                    if (NEWPRD_ADD_OPTION.checkRelationProduct(this.parent.oObject, this.parent.sType) === false) {
                        return false;
                    }

                    if (oIndividualValidData.isValidInidual === false && EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.setLayer(iProductNo, iCategoryNo, 'normal') === true) {
                        return false;
                    }

                    if (Olnk.getOptionPushbutton($('#option_push_button')) === true ) {
                        var bCheckOption = false;
                        $('select[id^="' + product_option_id + '"]').each(function() {
                            if (Boolean($(this).attr('required')) === true &&  Olnk.getCheckValue($(this).val(),'') === false) {
                                bCheckOption = true;
                                return false;
                            }
                        });
                        if (bCheckOption === false) {
                            sMsg = __('품목을 선택해 주세요.');
                        }
                    }
                } catch (e) {
                }

                // 메인상품 품목데이터 확인
                var isEmptyItemData = ITEM.getItemCode().length == false || ITEM.getItemCode() === false;
                // 추가구성상품 및 관련상품의 개별적 구매
                if (isEmptyItemData === true && oIndividualValidData.isValidInidual === true) {
                    if (NEWPRD_ADD_OPTION.checkVaildIndividualMsg(oIndividualValidData, this.parent.sType, this.parent.oObject) === false) {
                        return false;
                    }

                } else {
                    // 기존 유효성 검증 메세지
                    var sOrginalValidMsg = NEWPRD_ADD_OPTION. checkExistingValidMessage(this.parent.oObject, oValidAddProductCount);
                    //추가구성상품의 선택되어있으면서 본상품의 옵션이 선택 안되었을때
                    sMsg = (sOrginalValidMsg === false) ? sMsg : sOrginalValidMsg;

                    alert(sMsg);
                    if (oExistRequiredSelect !== false) {
                        oExistRequiredSelect.focus();
                    }
                    return false;
                }
            } else {
                // 관련상품 체크 확인
                if (NEWPRD_ADD_OPTION.checkRelationProduct(this.parent.oObject, this.parent.sType) === false) {
                    return false;
                }

                // 단독구매시 메인상품 품절된 상품일때 메시지 처리
                if (NEWPRD_ADD_OPTION.checkSoldOutProductValid(this.parent.oObject) === true) {
                    this.parent.UTIL.appendHidden('is_product_sold_out', 'T');
                    if (NEWPRD_ADD_OPTION.checkVaildIndividualMsg(oIndividualValidData, this.parent.sType, this.parent.oObject) === false) {
                        return false;
                    }
                }
                if (FileOptionManager.checkValidation() === false) {
                    return false;
                }
            }
            if (oValidAddProductCount.result === false) {
                if (oValidAddProductCount.message !== '') {
                    alert(oValidAddProductCount.message);
                    oValidAddProductCount.object.focus();
                }
                return false;
            }
            if (oValidRelationProductCount.result === false) {
                if (oValidRelationProductCount.message !== '') {
                    alert(oValidRelationProductCount.message);
                    oValidRelationProductCount.object.focus();
                }
                return false;
            }
            if (oIndividualValidData.isValidInidual === false) {
                // 추가 옵션 체크 (품목기반 추가옵션일때는 폼제출때 검증 불필요)
                if (NEWPRD_ADD_OPTION.isItemBasedAddOptionType() !== true && checkAddOption() === false) {
                    return false;
                }
            }
            return true;
        },
        isValidAddproduct : function()
        {
            if ($('.add-product-checked:checked').size() === 0) {
                return true;
            }

            var aAddProduct = $.parseJSON(add_option_data);
            var aItemCode = new Array();
            var bCheckValidate = true;
            $('.add-product-checked:checked').each(function() {
                if (bCheckValidate === false) {
                    return false;
                }
                var iProductNum = $(this).attr('product-no');
                var iQuantity = $('#add-product-quantity-'+iProductNum).val();
                var aData = aAddProduct[iProductNum];
                if (aData.item_code === undefined) {
                    if (aData.option_type === 'T') {
                        if (aData.item_listing_type === 'S') {
                            var aOptionValue = new Array();
                            $('[id^="addproduct_option_id_'+iProductNum+'"]').each(function() {
                                aOptionValue.push($(this).val());
                            });
                            if (ITEM.isOptionSelected(aOptionValue) === true) {
                                sOptionValue = aOptionValue.join('#$%');
                                aItemCode.push([$.parseJSON(aData.option_value_mapper)[sOptionValue],iQuantity]);
                            } else {
                                bCheckValidate = false;
                                alert(__('필수 옵션을 선택해주세요.'));
                                return false;
                            }
                        } else {
                            var $eItemSelectbox = $('[name="addproduct_option_name_'+iProductNum+'"]');

                            if (ITEM.isOptionSelected($eItemSelectbox.val()) === true) {
                                aItemCode.push([$eItemSelectbox.val(),iQuantity]);
                            } else {
                                bCheckValidate = false;
                                $eItemSelectbox.focus();
                                alert(__('필수 옵션을 선택해주세요.'));
                                return false;
                            }
                        }
                    } else if (Olnk.isLinkageType(sOptionType) === true) {
                        $('[id^="addproduct_option_id_'+iProductNum+'"]').each(function() {
                            alert( $(this).val());
                            if ($(this).attr('required') == true && ITEM.isOptionSelected($(this).val()) === false) {
                                bCheckValidate = false;
                                $(this).focus();
                                alert(__('필수 옵션을 선택해주세요.'));
                                return false;
                            }

                            if (ITEM.isOptionSelected($(this).val()) === true) {
                                aItemCode.push([$(this).val(),iQuantity]);
                            }
                        });
                    } else {
                        $('[id^="addproduct_option_id_'+iProductNum+'"]').each(function() {
                            if ($(this).attr('required') == true && ITEM.isOptionSelected($(this).val()) === false) {
                                bCheckValidate = false;
                                $(this).focus();
                                alert(__('필수 옵션을 선택해주세요.'));
                                return false;
                            }
                            if (ITEM.isOptionSelected($(this).val()) === true) {
                                aItemCode.push([$(this).val(),iQuantity]);
                            }
                        });
                    }
                } else {
                    aItemCode.push([aData.item_code,iQuantity]);
                }
            });
            if (bCheckValidate === false) {
                return false;
            }
            for (var x = 0 ; x < aItemCode.length ; x++) {
                this.UTIL.appendHidden('relation_item[]', aItemCode[x][1]+'||'+aItemCode[x][0]);
            }
        }
    },
    UTIL : {
        oData : {},
        initialize : function(oParent)
        {
            this.parent = oParent;
            return this;
        },
        appendHidden : function(mParam)
        {
            if (typeof(mParam) === 'string' && arguments.length === 2) {
                this.setHidden(arguments[0], arguments[1]);
            }
            if (typeof(mParam) === 'object') {
                for (var sName in mParam) {
                    this.setHidden(sName, mParam[sName]);
                }
            }
        },
        prependHidden : function(mParam)
        {
            if (typeof(mParam) === 'string' && arguments.length === 2) {
                this.setHidden(arguments[0], arguments[1], 'prepend');
            }
            if (typeof(mParam) === 'object') {
                for (var sName in mParam) {
                    this.setHidden(sName, mParam[sName], 'prepend');
                }
            }
        },
        setHidden : function(sName, sValue, sAppendType)
        {
            //ECHOSTING-9736
            if (typeof(sValue) == "string" && (sName == "option_add[]" || sName.indexOf("item_option_add") === 0)) {
                 sValue = sValue.replace(/'/g,  '\\&#039;');
            }

            // 타입이 string 일때 연산시 단일 따움표 " ' " 문자를 " ` " 액센트 문자로 치환하여 깨짐을 방지
            var oAttribute = {
                'name': sName,
                'type': 'hidden',
                'class' : 'basket-hidden'
            };
            if (sAppendType === 'prepend') {
                this.parent.oForm.prepend($('<input>').attr(oAttribute).val(sValue));

            } else {
                this.parent.oForm.append($('<input>').attr(oAttribute).val(sValue));

            }
        },
        setData : function(sKey, mValue)
        {
            this.oData[sKey] = mValue;
            return true;
        },
        getData : function(sKey)
        {
            return this.oData[sKey];
        }
    },
    DEBUG : {
        aMessage : [],
        initialize : function(oParent)
        {
            this.aMessage = [];
            this.parent = oParent;
            this.bIsDebugConsoleOut = this.parent.bIsDebugConsoleOut;
            return this;
        },
        setInfo : function()
        {
            if (this.bIsDebugConsoleOut === false) {
                return;
            }
            if (window.console) {
                var aMessage = [];
                for (var i = 0 ; i < arguments.length ; i++) {
                    aMessage.push(arguments[i]);
                }
                console.info(aMessage.join(''));
            }
        },
        setMessage : function(sMessage)
        {
            this.aMessage.push(sMessage);
            this.setConsoleDebug();
            throw 'USER_DEFINED_ERROR';
        },
        setConsoleDebug : function()
        {
            if (this.bIsDebugConsoleOut === false) {
                return;
            }
            if (window.console) {
                console.warn(this.aMessage.join('\n'));
            }
        },
        messageOut : function(mError)
        {
            if (this.bIsDebugConsoleOut === true && mError !== 'USER_DEFINED_ERROR') {
                console.error(mError);
            }
            return false;
        }
    }
};


// 상품 옵션 id
var product_option_id = 'product_option_id';

// 추가옵션 id
var add_option_id = 'add_option_';

// 선택된 상품만 주문하기
var sIsPrdOverride = 'F';

//모바일로 접속했는지
var bIsMobile = false;

//분리형 세트상품의 구성상품(품절)에서 SMS 재입고 알림 팝업 호출
function set_sms_restock(iProductNo) {
    if (typeof(iProductNo) === 'undefined') {
        return;
    }

    // 모바일 접속 및 레이어 팝업 여부 확인
    if (typeof(EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER) !== 'undefined') {
        var sParam = 'product_no=' + iProductNo;
        if (EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER.createSmsRestockLayerDisplayResult(sParam) === true) {
            return;
        }
    }

    window.open('/product/sms_restock.html?product_no=' + iProductNo, 'sms_restock', 200, 100, 459, 490);
}

// 예약 주문 체크
var STOCKTAKINGCHECKRESERVE = {
    checkReserve : function()
    {
        var bIsReserveStatus = $('.option_box_id').filter('[data-item-reserved="R"]').length > 0;
        // 예약 주문이 있는경우
        if (bIsReserveStatus === true) {
            alert(__('예약주문 상품의 경우, 별도배송이 될 수 있습니다.'));
        }
        return false;
    }
}


/**
 * sType - 1:바로구매, 2:장바구니,naver_checkout:네이버 페이 form.submit - 바로구매, 장바구니, 관심상품
 * TODO 바로구매 - 장바구니에 넣으면서 주문한 상품 하나만 주문하기
 *
 * @param string sAction action url
 */
function product_submit(sType, sAction, oObj)
{
    PRODUCTSUBMIT.initialize(sType, sAction, oObj);
    if (PRODUCTSUBMIT.isValidRequest() === true && PRODUCTSUBMIT.setBasketForm() === true) {
        PRODUCTSUBMIT.setBasketAjax();
    }
    return;
}

/**
 * 선택한상품만 주문하기
 *
 * @param string sOptionParam 옵션 파람값
 * @param int iProductNo 상품번호
 * @param string sSelectedItemByEtype 상품연동형의 경우 입력되는 선택된옵션 json 데이터
 */
function selectbuy_action(sOptionParam, iProductNo, sSelectedItemByEtype)
{
    var sAddParam = '';
    if (typeof sSelectedItemByEtype != 'undefined' && sSelectedItemByEtype != '') {
        sAddParam = '&' + sSelectedItemByEtype;
    }

    var sUrl = '/exec/front/order/basket/?command=select_prdcnt&product_no=' + iProductNo + '&option_type=' + (window['option_type'] || '') + sOptionParam + sAddParam;

    $.ajax(
    {
        url : sUrl,
        dataType : 'json',
        async : false,
        success : function(data)
        {
            if (data.result > 0) {
                //1+N상품이라면
                if (typeof(EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE) !== 'undefined' && EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.oBundleConfig.hasOwnProperty(iProductNo) === true) {
                    sIsPrdOverride = 'F';
                } else {
                    if (!confirm(sprintf(__('동일상품이 장바구니에 %s개 있습니다.'), data.result) +'\n'+ __('함께 구매하시겠습니까?'))) {
                        sIsPrdOverride = 'T';
                    }
                }
            }
        }
    });
}

/**
 * 장바구니 담기(카테고리)
 *
 * @param int iProductNo 상품번호
 * @param int iCategoryNo 카테고리 번호
 * @param int iDisplayGroup display_group
 * @param string sBasketType 무이자 설정(A0000:일반, A0001:무이자)
 * @param string iQuantity 주문수량
 * @param string sItemCode 아이템코드
 * @param string sDelvType 배송타입
 */
function category_add_basket(iProductNo, iCategoryNo, iDisplayGroup, sBasketType, bList, iQuantity, sItemCode, sDelvType, sProductMaxType, sProductMax)
{
    if (iQuantity == undefined) {
        iQuantity = 1;
    }

    if (bList == true) {
        try {
            if ($.type(EC_ListAction) == 'object') {
                EC_ListAction.getOptionSelect(iProductNo, iCategoryNo, iDisplayGroup, sBasketType);
            }
        } catch (e) {
            alert(__('장바구니에 담을 수 없습니다.'));
            return false;
        }
    } else {
        var sAction = '/exec/front/order/basket/';
        var sData = 'command=add&quantity=' + iQuantity + '&product_no=' + iProductNo + '&main_cate_no=' + iCategoryNo + '&display_group='
                + iDisplayGroup + '&basket_type=' + sBasketType + '&delvtype=' + sDelvType + '&product_max_type=' + sProductMaxType + '&product_max=' + sProductMax;
        // 장바구니 위시리스트인지 여부
        if (typeof (basket_page_flag) != 'undefined' && basket_page_flag == 'T') {
            sData = sData + '&basket_page_flag=' + basket_page_flag;
        }

        // 뉴상품 옵션 선택 구매
        sData = sData + '&selected_item[]='+iQuantity+'||' + sItemCode + '000A';

        action_basket(2, 'category', sAction, sData, sBasketType);
    }
}

/**
 * 구매하기
 *
 * @param int iProductNo 상품번호
 * @param int iCategoryNo 카테고리 번호
 * @param int iDisplayGroup display_group
 * @param string sBasketType 무이자 설정(A0000:일반, A0001:무이자)
 * @param string iQuantity 주문수량
 */
function add_order(iProductNo, iCategoryNo, iDisplayGroup, sBasketType, iQuantity)
{
    if (iQuantity == undefined) {
        iQuantity = 1;
    }

    var sAction = '/exec/front/order/basket/';
    var sData = 'command=add&quantity=' + iQuantity + '&product_no=' + iProductNo + '&main_cate_no=' + iCategoryNo + '&display_group='
            + iDisplayGroup + '&basket_type=' + sBasketType;

    action_basket(1, 'wishlist', sAction, sData, sBasketType);
}

/**
 * 레이어 생성
 *
 * @param layerId
 * @param sHtml
 */
function create_layer(layerId, sHtml, oTarget)
{
    //아이프레임일때만 상위객체에 레이어생성
    if (oTarget === parent) {
        oTarget.$('#' + layerId).remove();
        oTarget.$('body').append($('<div id="' + layerId + '" style="position:absolute; z-index:10001;"></div>'));
        oTarget.$('#' + layerId).html(sHtml);
        oTarget.$('#' + layerId).show();

        //옵션선택 레이어 프레임일 경우 그대로 둘경우 영역에대해 클릭이 안되는부분때문에 삭제처리
        if (typeof(bIsOptionSelectFrame) !== 'undefined' && bIsOptionSelectFrame === true) {
            parent.CAPP_SHOP_NEW_PRODUCT_OPTIONSELECT.closeOptionCommon();
        }
    } else {
        $('#' + layerId).remove();
        $('<div id="' + layerId + '"></div>').appendTo('body');
        $('#' + layerId).html(sHtml);
        $('#' + layerId).show();
    }
    // set delvtype to basket
    try {
        $(".xans-product-basketadd").find("a[href='/order/basket.html']").attr("href", "/order/basket.html?delvtype=" + delvtype);
    } catch (e) {}
    try {
        $(".xans-order-layerbasket").find("a[href='/order/basket.html']").attr("href", "/order/basket.html?delvtype=" + delvtype);
    } catch (e) {}
}

/**
 * 레이어 위치 조정
 *
 * @param layerId
 */
function position_layer(layerId)
{
    var obj = $('#' + layerId);

    var x = 0;
    var y = 0;
    try {
        var hWd = parseInt(document.body.clientWidth / 2 + $(window).scrollLeft());
        var hHt = parseInt(document.body.clientHeight / 2 + $(window).scrollTop() / 2);
        var hBW = parseInt(obj.width()) / 2;
        var hBH = parseInt(hHt - $(window).scrollTop());

        x = hWd - hBW;
        if (x < 0) x = 0;
        y = hHt - hBH;
        if (y < 0) y = 0;

    } catch (e) {}

    obj.css(
    {
        position : 'absolute',
        display : 'block',
        top : y + "px",
        left : x + "px"
    });

}


// 장바구니 담기 처리중인지 체크 - (ECHOSTING-85853, 2013.05.21 by wcchoi)
var bIsRunningAddBasket = false;

/**
 * 장바구니/구매 호출
 *
 * @param sType
 * @param sGroup
 * @param sAction
 * @param sParam
 * @param aBasketType
 * @param bNonDuplicateChk
 */
function action_basket(sType, sGroup, sAction, sParam, sBasketType, bNonDuplicateChk)
{
    // 장바구니 담기에 대해서만 처리
    // 중복 체크 안함 이 true가 아닐경우(false나 null)에만 중복체크
    if (sType == 2 && bNonDuplicateChk != true) {
        if (bIsRunningAddBasket) {
            alert(__('처리중입니다. 잠시만 기다려주세요.'));
            return;
        } else {
            bIsRunningAddBasket = true;
        }
    }

    if (sType == 'sms_restock') {
        action_sms_restock(sParam);
        return ;
    }

    if (sType == 'email_restock') {
        action_email_restock();
        return;
    }

    if (sType == 2 && EC_SHOP_FRONT_BASKET_VALIID.isBasketProductDuplicateValid(sParam) === false) {
        bIsRunningAddBasket = false;
        return false;
    }

    $.post(sAction, sParam, function(data)
    {
        basket_result_action(sType, sGroup, data, sBasketType);

        bIsRunningAddBasket = false; // 장바구니 담기 처리 완료

    }, 'json');

    // 관신상품 > 전체상품 주문 ==> 장바구니에 들어가기도 전에 /exec/front/order/order/ 호출하게 되어 오류남
    // async : false - by wcchoi
    // 다시 async모드로 원복하기로 함 - ECQAINT-7857
    /*
    $.ajax({
        type: "POST",
        url: sAction,
        data: sParam,
        async: false,
        success: function(data) {
            basket_result_action(sType, sGroup, data, sBasketType);
            bIsRunningAddBasket = false; // 장바구니 담기 처리 완료
        },
        dataType: 'json'
    });
    */
}

/**
 * 리스트나 상세에서 장바구니 이후의 액션을 처리하고 싶을 경우 이변수를 파라미터로 지정해줌
 */
var sProductLink = null;
/**
 * 장바구니 결과 처리
 *
 * @param sType
 * @param sGroup
 * @param aData
 * @param aBasketType
 */
function basket_result_action(sType, sGroup, aData, sBasketType)
{
    if (aData == null) {
        return;
    }

    var sHtml = '';
    var bOpener = false;
    var oTarget = CAPP_SHOP_FRONT_COMMON_UTIL.findTargetFrame();
    var bIsProgressLink = true;

    var oCheckZoomPopUp = {
        isPopUp : function()
        {
            var bIsPopup = false;
            if (bIsProgressLink === true || (typeof(sIsPopUpWindow) !== "undefined" && sIsPopUpWindow === "T")) {
                if (CAPP_SHOP_FRONT_COMMON_UTIL.isPopupFromThisShopFront() === true) {
                    bIsPopup = true;
                }
            }
            return bIsPopup;
        }
    };

    //var oOpener = findMainFrame();
    //var sLocation = location;
    var bBuyLayer = false;

    if (aData.result >= 0) {
        try {
            bBuyLayer = ITEM.setBodyOverFlow(true);
        } catch (e) {}

        // 네이버 페이
        if (sType == 'naver_checkout') {
            var sUrl = '/exec/front/order/navercheckout';

            // inflow param from naver common JS to Checkout Service
            try {
                if (typeof(wcs) == 'object') {
                    var inflowParam = wcs.getMileageInfo();
                    if (inflowParam != false) {
                        sUrl = sUrl + '?naver_inflow_param=' + inflowParam;
                    }
                }
            } catch (e) {}

            if (is_order_page == 'N' && bIsMobile == false) {
                window.open(sUrl);
                return false;
            } else {
                oTarget.location.href = sUrl;
                return false;
            }
        }

        // 배송유형
        var sDelvType = '';
        if (typeof(delvtype) != 'undefined') {
            if (typeof(delvtype) == 'object') {
                sDelvType = $(delvtype).val();
            } else {
                sDelvType = delvtype;
            }
        } else if (aData.sDelvType != null) {
            sDelvType = aData.sDelvType;
        }

        if (sType == 1) { // 바로구매하기
            if (aData.isLogin == 'T') { // 회원
                oTarget.location.href = "/order/orderform.html?basket_type=" + sBasketType + "&delvtype=" + sDelvType;
            } else { // 비회원
                sUrl = '/member/login.html?noMember=1&returnUrl=' + encodeURIComponent('/order/orderform.html?basket_type=' + sBasketType + "&delvtype=" + sDelvType);
                sUrl += '&delvtype=' + sDelvType;

                oTarget.location.href = sUrl;
            }
        } else { // 장바구니담기
            if (sGroup == 'detail') {
                if (mobileWeb === true) {
                    if (typeof (basket_page_flag) != 'undefined' && basket_page_flag == 'T') {
                        oTarget.reload();
                        return;
                    }
                }

                var oSearch = /basket.html/g;
                //레이어가 뜨는 설정이라면 페이지이동을 하지 않지만
                //레이어가 뜨어라고 확대보기팝업이라면 페이지 이동

                if (typeof(aData.isDisplayBasket) != "undefined" && aData.isDisplayBasket == 'T' && oSearch.test(window.location.pathname) == false) {
                    if ((typeof(aData.isDisplayLayerBasket) != "undefined" && aData.isDisplayLayerBasket == 'T') && (typeof(aData.isBasketPopup) != "undefined" && aData.isBasketPopup == 'T')) {
                        layer_basket2(sDelvType, oTarget);
                    } else {
                        //ECQAINT-14010 Merge이슈 : oTarget이 정상
                        layer_basket(sDelvType, oTarget);
                    }

                    bIsProgressLink = false;
                }

                //확인 레이어설정이 아니거나 확대보기 팝업페이지라면 페이지이동
                if (oCheckZoomPopUp.isPopUp() === true || bIsProgressLink === true) {
                    oTarget.location.href = "/order/basket.html?"  + "&delvtype=" + sDelvType;
                }
            } else {
                // from으로 위시리스트에서 요청한건지 판단.
                var bIsFromWishlist = false;
                if (typeof(aData.from) != "undefined" && aData.from == "wishlist") {
                    bIsFromWishlist = true;
                }

                // 장바구니 위시리스트인지 여부
                if (typeof (basket_page_flag) != 'undefined' && basket_page_flag == 'T' || bIsFromWishlist == true) {
                    oTarget.reload();
                    return;
                }

                if ((typeof(aData.isDisplayLayerBasket) != "undefined" && aData.isDisplayLayerBasket == 'T') && (typeof(aData.isBasketPopup) != "undefined" && aData.isBasketPopup == 'T')) {
                    layer_basket2(sDelvType, oTarget);
                } else {
                    layer_basket(sDelvType, oTarget);
                }
            }
        }
    } else {
        var msg = aData.alertMSG.replace('\\n', '\n');
        msg = decodeURIComponent(msg);
        try {
            msg = decodeURIComponent(msg);
        } catch (err) {}
        alert(msg);

        if (aData.result == -111 && sProductLink !== null) {
            oTarget.href = '/product/detail.html?' + sProductLink;
        }
        if (aData.result == -101) {
            sUrl = '/member/login.html?noMember=1&returnUrl=' + encodeURIComponent(oTarget.location.href);
            oTarget.location.href = sUrl;
        }
    }

    // ECHOSTING-130826 대응, 쿠폰적용상품 리스트에서 옵션상품(뉴옵션)담기 처리시, 화면이 자동으로 닫히지 않아 예외처리 추가
    if (oTarget.couponPopupClose !== undefined) {
        oTarget.couponPopupClose();
    }
    if (oCheckZoomPopUp.isPopUp() === true) {
        self.close();
    } else {
        // ECHOSTING-130826 대응, 특정 화면에서 장바구니에 상품 담기 시 async 가 동작하지 않아,
        // 장바구니 담기처리 후처리 구간에 async 강제 실행추가
        // 쿠폰 적용 가능상품 리스트 에서 장바구니 담기시, 여기서 실행할 경우 js 오류가 발생하여, 함수 상단에 별도 처리 추가
        if (typeof(oTarget) !== 'undefined' && typeof(oTarget.CAPP_ASYNC_METHODS) !== 'undefined') {
            oTarget.CAPP_ASYNC_METHODS.init();
        } else {
            CAPP_ASYNC_METHODS.init();
        }
    }
}

function layer_basket(sDelvType, oTarget)
{
    var oProductName = null;
    if (typeof(product_name) !== 'undefined') {
        oProductName = {'product_name' : product_name};
    }
    $('.xans-product-basketoption').remove();
    $.get('/product/add_basket.html?delvtype='+sDelvType, oProductName, function(sHtml)
        {
            sHtml = sHtml.replace(/<script.*?ind-script\/optimizer.php.*?<\/script>/g, '');
            // scirpt를 제거하면서 document.ready의 Async 모듈이 실행안되서 강제로 실행함
            CAPP_ASYNC_METHODS.init();
            create_layer('confirmLayer', sHtml, oTarget);
        });
}

function layer_basket2(sDelvType, oTarget)
{
    $('.xans-order-layerbasket').remove();
    var oTarget = CAPP_SHOP_FRONT_COMMON_UTIL.findTargetFrame();
    $.get('/product/add_basket2.html?delvtype=' + sDelvType + '&layerbasket=T', '', function(sHtml)
    {
        sHtml = sHtml.replace(/<script.*?ind-script\/optimizer.php.*?<\/script>/g, '');

        //scirpt를 제거하면서 document.ready의 Async 모듈이 실행안되서 강제로 실행함
        CAPP_ASYNC_METHODS.init();
        create_layer('confirmLayer', sHtml, oTarget);
    });
}

function layer_wishlist(oTarget)
{
    $('.layerWish').remove();
    $.get('/product/layer_wish.html','' ,function(sHtml)
    {
        sHtml = sHtml.replace(/<script.*?ind-script\/optimizer.php.*?<\/script>/g, '');
        create_layer('confirmLayer', sHtml, oTarget);
    });
}

function go_basket()
{
    var oTarget = CAPP_SHOP_FRONT_COMMON_UTIL.findTargetFrame();
    oTarget.location.href = '/order/basket.html';
    if (CAPP_SHOP_FRONT_COMMON_UTIL.isPopupFromThisShopFront() === true) {
        self.close();
    }
}

function move_basket_page()
{
    var sLocation = location;
    try {

        sLocation = ITEM.setBodyOverFlow(location);
    } catch (e) {}

    sLocation.href = '/order/basket.html';
}

/**
 * 이미지 확대보기 (상품상세 버튼)
 */
function go_detail()
{
    var sUrl = '/product/detail.html?product_no=' + iProductNo;
    var oTarget = CAPP_SHOP_FRONT_COMMON_UTIL.findTargetFrame();

    if (typeof(iCategoryNo) != 'undefined') {
        sUrl += '&cate_no='+iCategoryNo;
    }

    if (typeof(iDisplayGroup) != 'undefined') {
        sUrl += '&display_group='+iDisplayGroup;
    }

    oTarget.location.href = sUrl;
    if (CAPP_SHOP_FRONT_COMMON_UTIL.isPopupFromThisShopFront() === true) {
        self.close();
    }
}

/**
 * 바로구매하기/장바구니담기 Action  - 로그인하지 않았을 경우
 */
function check_action_nologin()
{
    alert(__('회원만 구매 가능합니다. 비회원인 경우 회원가입 후 이용하여 주세요.'));

    var oTarget = CAPP_SHOP_FRONT_COMMON_UTIL.findTargetFrame();
    var sLocation = location;

    sLocation = ITEM.setBodyOverFlow(location);

    sUrl = '/member/login.html?noMember=1&returnUrl=' + encodeURIComponent(oTarget.location.href);
    oTarget.location.href = sUrl;
}

/**
 * 바로구매하기 Action  - 불량회원 구매제한
 */
function check_action_block(sMsg)
{
    if (sMsg == '' ) {
        sMsg = __('쇼핑몰 관리자가 구매 제한을 설정하여 구매하실 수 없습니다.');
    }
    alert(sMsg);
}

/**
 * 관심상품 등록 - 로그인하지 않았을 경우
 */
function add_wishlist_nologin(sUrl)
{

    alert(__('로그인 후 관심상품 등록을 해주세요.'));

    btn_action_move_url(sUrl);
}

/**
 * 바로구매하기 / 장바구니 담기 / 관심상품 등록 시 url 이동에 사용하는 메소드
 * @param sUrl 이동할 주소
 */
function btn_action_move_url(sUrl)
{
    var oTarget = CAPP_SHOP_FRONT_COMMON_UTIL.findTargetFrame();

    sLocation = ITEM.setBodyOverFlow(location);

    sUrl += '?returnUrl=' + encodeURIComponent(oTarget.location.pathname + oTarget.location.search);
    oTarget.location.replace(sUrl);
}

/**
 * return_url 없이 url 이동에 사용하는 메소드
 * @param sUrl 이동할 주소
 */
function btn_action_move_no_return_url(sUrl)
{
    var oTarget = CAPP_SHOP_FRONT_COMMON_UTIL.findTargetFrame();
    oTarget.location.replace(sUrl);
}

/**
 * 관심상품 등록 - 파라미터 생성
 * @param bIsUseOptionSelect 장바구니옵션선택 새모듈 사용여부(basket_option.html, Product_OptionSelectLayer)
 */
function add_wishlist(sMode, bIsUseOptionSelect)
{
    var sUrl = '//' + location.hostname;
    sUrl += '/exec/front/Product/Wishlist/';
    var param = location.search.substring(location.search.indexOf('?') + 1);
    sParam = param + '&command=add';
    sParam += '&referer=' + encodeURIComponent('//' + location.hostname + location.pathname + location.search);

    add_wishlist_action(sUrl, sParam, sMode, bIsUseOptionSelect);
}

var bWishlistSave = false;
/**
 * @param bIsUseOptionSelect 장바구니옵션선택 새모듈 사용여부(basket_option.html, Product_OptionSelectLayer)
 */
function add_wishlist_action(sAction, sParam, sMode, bIsUseOptionSelect)
{
    //연동형 옵션 여부
    var bIsOlinkOption = Olnk.isLinkageType(sOptionType);
    if (bWishlistSave === true) {
        return false;
    }
    var required_msg = __('품목을 선택해 주세요.');
    if (sOptionType !== 'F') {
        var aItemCode = ITEM.getWishItemCode();
    } else {
        var aItemCode = null;
    }
    var sSelectedItemByEtype   = '';

    var frm = $('#frm_image_zoom');
    frm.find(":hidden").remove();
    frm.attr('method', 'POST');
    frm.attr('action', '/' + sAction);

    if (bIsOlinkOption === true) {
        if (isNewProductSkin() === false) {
            sItemCode = Olnk.getSelectedItemForWishOldSkin(sProductCode, $('[id^="product_option_id"]'));

            if (sItemCode !== false) {
                frm.append(getInputHidden('selected_item_by_etype[]', $.toJSON(sItemCode)));
                //sSelectedItemByEtype += 'selected_item_by_etype[]='+$.toJSON(sItemCode) + '&';
                aItemCode.push (sItemCode);
            }

        } else {
            $('.soldout_option_box_id,.option_box_id').each(function(i) {
                sItemCode = Olnk.getSelectedItemForWish(sProductCode, $(this));
                if (sItemCode.bCheckNum === false) {
                    sItemCode = Olnk.getProductAllSelected(sProductCode ,  $(this) , 1);
                }
                frm.append(getInputHidden('selected_item_by_etype[]', $.toJSON(sItemCode)));
                //sSelectedItemByEtype += 'selected_item_by_etype[]='+$.toJSON(sItemCode) + '&';
                aItemCode.push (sItemCode);
            });

            // 전부 선택인 경우 필요값 생성한다.
            if ( sSelectedItemByEtype === '') {
                iQuantity = (buy_unit >= product_min ? buy_unit : product_min);
                aItemValueNo = Olnk.getProductAllSelected(sProductCode , $('[id^="product_option_id"]') , 1);
                if ( aItemValueNo !== false ) {
                    frm.append(getInputHidden('selected_item_by_etype[]', $.toJSON(aItemValueNo)));
                    //sSelectedItemByEtype += 'selected_item_by_etype[]='+$.toJSON(aItemValueNo) + '&';
                    aItemCode.push (aItemValueNo);
                }
            }

            NEWPRD_ADD_OPTION.setItemAddOptionName(frm);
            $('.option_box_id').each(function(i) {

                iQuantity = $('#' + $(this).attr('id').replace('id','quantity')).val();
                _aItemValueNo = Olnk.getSelectedItemForBasket(sProductCode, $(this), iQuantity);

                if (_aItemValueNo.bCheckNum === false) { // 옵션박스는 있지만 값이 선택이 안된경우
                    _aItemValueNo = Olnk.getProductAllSelected(sProductCode , $(this) , iQuantity);
                }

                var oItem = $('[name="item_code[]"]:eq('+i+')');
                var sItemCode = oItem.val();

              //품목별 추가옵션 셋팅
                var sItemAddOption = unescape(oItem.attr('data-item-add-option'));
                NEWPRD_ADD_OPTION.setItemAddOption(sProductCode + '000A_' + i , sItemAddOption, frm);
            });


        }

        if (bIsUseOptionSelect !== true && (/^\*+$/.test(aItemCode) === true  || aItemCode == '')) {
            alert(required_msg);
            return false;
        }
    } else {
        if (isNewProductSkin() === true) {
            //품목별 추가옵션 이름 셋팅
            NEWPRD_ADD_OPTION.setItemAddOptionName(frm);

            $('[name="quantity_opt[]"][id^="option_box"]').each(function(i) {

                var oItem = $('[name="item_code[]"]:eq('+i+')');
                var sItemCode = oItem.val();

                //품목별 추가옵션 셋팅
                var sItemAddOption = unescape(oItem.attr('data-item-add-option'));
                NEWPRD_ADD_OPTION.setItemAddOption(sItemCode, sItemAddOption, frm);
            });
        }
    }

    if (aItemCode === false && bIsUseOptionSelect !== true) {
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.setLayer(iProductNo, iCategoryNo, 'normal') === true) {
            return;
        }
        alert(required_msg);
        return false;
    }


    if (aItemCode !== null) {
        var sItemCode = '';
        var aTemp = [];

        if (Olnk.isLinkageType(sOptionType) === true) {
            frm.append(getInputHidden('selected_item[]', '000A'));
            //sParam = sParam + '&' + 'selected_item[]=000A&' + sSelectedItemByEtype;
        } else {
            for (var x in aItemCode) {
                try {
                    var opt_id = aItemCode[x].substr(aItemCode[x].length-4, aItemCode[x].length);
                    frm.append(getInputHidden('selected_item[]', opt_id));
                    //aTemp.push('selected_item[]='+opt_id);
                }catch(e) {}
            }
        }
    }

    if (typeof(iProductNo) !== undefined && iProductNo !== '' && iProductNo !== null) {
        frm.append(getInputHidden('product_no', iProductNo));
    }
    frm.append(getInputHidden('option_type', sOptionType));
    //sParam = sParam + '&product_no='+iProductNo;


    // 추가 옵션 체크 (품목기반 추가옵션일때는 폼제출때 검증 불필요)
    //뉴모듈사용시에는 체크안함
    if (bIsUseOptionSelect !== true && (NEWPRD_ADD_OPTION.isItemBasedAddOptionType() !== true && checkAddOption() === false)) {
        return false;
    }

    // 추가옵션
    var aAddOptionStr = new Array();
    var aAddOptionRow = new Array();
    if (add_option_name) {
        for (var i=0;i<add_option_name.length;i++) {
            if (add_option_name[i] != '') {
                aAddOptionRow.push(add_option_name[i] + '*' + $('#' + add_option_id + i).val());
            }
        }
    }
    aAddOptionStr.push(aAddOptionRow);

    frm.append(getInputHidden('add_option', aAddOptionStr.join('|')));
    //sParam += '&add_option=' + encodeURIComponent(aAddOptionStr.join('|'));

    // 파일첨부 옵션 유효성 체크
    if (bIsUseOptionSelect !== true && FileOptionManager.checkValidation() === false) return;

    bWishlistSave = true;

    // 파일첨부 옵션의 파일업로드가 없을 경우 바로 관심상품 넣기
    if (FileOptionManager.existsFileUpload() === false) {
        sParam = sParam + '&' + frm.serialize();
        add_wishlist_request(sParam, sMode);
    // 파일첨부 옵션의 파일업로드가 있으면
    } else{
        FileOptionManager.upload(function(mResult){
            // 파일업로드 실패
            if (mResult===false) {
                bWishlistSave = false;
                return false;
            }

            // 파일업로드 성공
            for (var sId in mResult) {
                frm.append(getInputHidden(sId, FileOptionManager.encode(mResult[sId])));
                //sParam += '&'+sId+'='+FileOptionManager.encode(mResult[sId]);
            }

            sParam = sParam + '&' + frm.serialize();
            add_wishlist_request(sParam, sMode);
        });
    }
}

function add_wishlist_request(sParam, sMode)
{
    var sUrl = '/exec/front/Product/Wishlist/';

    $.post(
        sUrl,
        sParam,
        function(data) {
            if (sMode != 'back') {
                add_wishlist_result(data);
            }
            bWishlistSave = false;
        },
        'json');
}

function add_wishlist_result(aData)
{
    var oTarget = CAPP_SHOP_FRONT_COMMON_UTIL.findTargetFrame();
    var agent = navigator.userAgent.toLowerCase();

    if (aData == null) return;
    //새로운 모듈 사용시에는 중복되어있어도 처리된것으로 간주함.. 왜 그렇게하는지는 이해불가
    if (aData.result == 'SUCCESS' || (aData.bIsUseOptionSelect === true && aData.result === 'NO_TARGET')) {

        bBuyLayer = ITEM.setBodyOverFlow(true);

        if (aData.confirm == 'T' && CAPP_SHOP_FRONT_COMMON_UTIL.isPopupFromThisShopFront() === false) {
            layer_wishlist(oTarget);
            return;
        }
        alert(__('관심상품으로 등록되었습니다.'))
    } else if (aData.result == 'ERROR') {
        alert(__('실패하였습니다.'));
    } else if (aData.result == 'NOT_LOGIN') {
        alert(__('회원 로그인 후 이용하실 수 있습니다.'));
    } else if (aData.result == 'INVALID_REQUEST') {
        alert(__('파라미터가 잘못되었습니다.'));
    } else if (aData.result == 'NO_TARGET') {
        alert(__('이미 등록되어 있습니다.'));
    }
}

/**
* 추가된 함수
* 해당 value값을 받아 replace 처리
* @param string sValue value
* @return string replace된 sValue
*/
function replaceCheck(sName,sValue)
{
   //ECHOSTING-9736
   if (typeof(sValue) == "string" && (sName == "option_add[]" || sName.indexOf("item_option_add") === 0)) {
        sValue = sValue.replace(/'/g,  '\\&#039;');
   }
   // 타입이 string 일때 연산시 단일 따움표 " ' " 문자를 " ` " 액센트 문자로 치환하여 깨짐을 방지
   return sValue;
}


/**
 * name, value값을 받아 input hidden 태그 반환
 *
 * @param string sName name
 * @param string sValue value
 * @return string input hidden 태그
 */
function getInputHidden(sName, sValue)
{
    sValue = replaceCheck(sName,sValue); // 추가된 부분 (replaceCheck 함수 호출)
    return $('<input>').attr({'type':'hidden', 'name':sName}).val(sValue);
}


/**
 * 필수옵션이 선택되었는지 체크
 *
 * @return bool 필수옵션이 선택되었다면 true, 아니면 false 반환
 */
function checkOptionRequired(sReq)
{
    var bResult = true;
    // 옵션이 없다면 필수값 체크는 필요없음.
    if (has_option === 'F') {
        return bResult;
    }
    var sTargetOptionId = product_option_id
    if (sReq != null) {
        sTargetOptionId = sReq;
    }

    if (option_type === 'F') {
        // 단독구성
        var iOptionCount = $('select[id^="' + sTargetOptionId + '"][required="true"]').length;
        if (iOptionCount > 0) {
            if (ITEM.getItemCode() === false) {
                bResult = false;
                return false;
            }

            var aRequiredOption = new Object();
            var aItemCodeList = ITEM.getItemCode();
            // 필수 옵션정보와 선택한 옵션 정보 비교
            for (var i=0;i<aItemCodeList.length;i++) {
                var sTargetItemCode =  aItemCodeList[i];
                $('select[id^="' + sTargetOptionId + '"][required="true"] option').each(function() {
                    if ($(this).val() == sTargetItemCode) {
                        var sProductOptionId = $(this).parent().attr('id');
                        aRequiredOption[sProductOptionId] = true;
                    }
                });

            }
            // 필수옵션별 개수보다 선택한 옵션개수가 적을경우 리턴
            if (iOptionCount > Object.size(aRequiredOption)) {
                bResult = false;
                return bResult;
            }
        }
    } else {
        if (Olnk.isLinkageType(sOptionType) === true) {
            if (isNewProductSkin() === false) {
                $('select[id^="' + product_option_id + '"][required="true"]').each(function() {
                    var sel = parseInt($(this).val());

                    if (isNaN(sel) === true) {
                        $(this).focus();
                        bResult = false;
                        return false;
                    }
                });
                // 추가 구매 check
                $('.' + $.data(document, 'multiple_option_select_class')).each(function(i)
                {
                    if (Boolean($(this).attr('required')) === true) {
                        var sel = parseInt($(this).val());

                        if (isNaN(sel) === true) {
                            $(this).focus();
                            bResult = false;
                            return false;
                        }
                    }
                });
            } else { // 연동형 사용중이면서 뉴스킨
                var aItemCodeList = ITEM.getItemCode();
                if (aItemCodeList === false) {
                    bResult = false;
                    return false;
                }
                // 연동형 옵션의 버튼 사용중이지만 선택된 품목이 없는 경우 , 뉴스킨에서만 동작해야 함.
                if ( Olnk.getOptionPushbutton($('#option_push_button')) === true  && $('.option_box_id').length === 0 ) {
                    bResult = false;
                    return false;
                }
            }
            return bResult;
        }
        if (ITEM.getItemCode() === false) {
            bResult = false;
            return false;
        }
        // 조합구성
        if (item_listing_type == 'S') {
            // 분리선택형
            var eTarget = $.parseJSON(option_value_mapper);
            for (var x in eTarget) {
                if (ITEM.getItemCode().indexOf(eTarget[x]) > -1) {
                    bResult = true;
                    break;
                } else {
                    bResult = false;
                }
            }
            if (bResult === false) {
                bResult = false;
                return false;
            }
        } else {
            $('select[id^="' + product_option_id + '"][required="true"]').each(function() {
                var eTarget = $(this).find('option[value!="*"][value!="**"]');
                bResult = false;
                eTarget.each(function() {
                    if (ITEM.getItemCode().indexOf($(this).val()) > -1) {
                        bResult = true;
                        return false;
                    }
                });
                if (bResult === false) {
                    return false;
                }
            });
        }
    }

    return bResult;
}

/**
 * 추가옵션 입력값 체크
 *
 * @return bool 모든 추가옵션에 값이 입력되었다면 true, 아니면 false
 */
function checkAddOption(sReq)
{
    var sAddOptionField = add_option_id;

    var oAddOptionSelector = '[id^="' + sAddOptionField + '"]';
    if (sReq != null) {
        sAddOptionField = sReq;
        oAddOptionSelector = '[id="' + sAddOptionField + '"]';
    }

    var bResult = true;
    $(oAddOptionSelector).filter(':visible').each(function()
    {
        if ($(this).attr('require') !== false && $(this).attr('require') == 'T') {
            if ($(this).val().replace(/^[\s]+|[\s]+$/g, '').length == 0) {
                alert(__('추가 옵션을 입력해주세요.'));
                $(this).focus();
                bResult = false;
                return false;
            }
        }
    });

    return bResult;
}

/**
 * 수량 가져오기
 *
 * @return mixed 정상적인 수량이면 수량(integer) 반환, 아니면 false 반환
 */
function getQuantity()
{
    // 뉴상품인데 디자인이 수정안됐을 수 있다.
    if (isNewProductSkin() === false) {
        iQuantity = parseInt($(quantity_id).val(),10);
    } else {
        if (has_option == 'T') {
            var iQuantity = 0;

            if (Olnk.isLinkageType(sOptionType) === true) {
                iQuantity = parseInt($(quantity_id).val(),10);
                return iQuantity;
            }

            $('[name="quantity_opt[]"]').each(function() {
                iQuantity = iQuantity + parseInt($(this).val(),10);
            });
        } else {
            var iQuantity = parseInt($(quantity_id).val().replace(/^[\s]+|[\s]+$/g,'').match(/[\d\-]+/),10);
            if (isNaN(iQuantity) === true || $(quantity_id).val() == '' || $(quantity_id).val().indexOf('.') > 0) {
                return false;
            }
        }

    }

    return iQuantity;
}

/**
 * 수량 체크
 *
 * @return mixed 올바른 수량이면 수량을, 아니면 false
 */
function checkQuantity()
{
    // 수량 가져오기
    var iQuantity = getQuantity();

    if (isNewProductSkin() === false) {
        if (iQuantity === false) return false;

        // 구스킨의 옵션 추가인 경우 수량을 모두 합쳐야 함..하는수 없이 each추가
        // 재고 관련도 여기서 하나?
        if (Olnk.isLinkageType(option_type) === true) {
            var sOptionIdTmp = '';
            $('select[id^="' + product_option_id + '"]').each(function() {
                if (/^\*+$/.test($(this).val()) === false ) {
                    sOptionIdTmp = $(this).val();
                    return false;
                }
            });

            $('.EC_MultipleOption').each(function(i){
                iQuantity +=  parseInt($(this).find('.' + $.data(document,'multiple_option_quantity_class')).val(),10);
            });

            if ( Olnk.getStockValidate(sOptionIdTmp , iQuantity) === true ) {
                alert(__('상품의 수량이 재고수량 보다 많습니다.'));
                $(quantity_id).focus();
                return false;
            }
        }

        if (iQuantity < product_min) {
            alert(sprintf(__('최소 주문수량은 %s개 입니다.'), product_min));
            $(quantity_id).focus();
            return false;
        }
        if (iQuantity > product_max && product_max > 0) {
            alert(sprintf(__('최대 주문수량은 %s개 입니다.'), product_max));
            $(quantity_id).focus();
            return false;
        }

    } else {
        var bResult = true;
        var bSaleMainProduct = false;
        var aQuantity = new Array();
        var iTotalOuantity = 0;
        var iProductMin = product_min;
        var iProductMax = product_max;
        $('#totalProducts > table > tbody').not('.add_products').find('[name="quantity_opt[]"]').each(function() {
            // 본상품 구매여부
            bSaleMainProduct = true;
            iQuantity = parseInt($(this).val());

            var iProductNum = iProductNo;
            // 추가 구성상품인 경우 product_min ,  product_max 값은 다른값을 비교해야 함..
            if ($(this).attr('id').indexOf('add_') > -1) {
                iProductMin = $('#'+$(this).attr('id').replace('quantity','productmin')).val();
                iProductMax = $('#'+$(this).attr('id').replace('quantity','productmax')).val();
                var iProductNum = $('#'+$(this).attr('id').replace('quantity','id')).attr('class').replace('option_add_box_','');
            }
            if (typeof(aQuantity[iProductNum]) === 'undefined') {
                aQuantity[iProductNum] = new Array();
            }
            aQuantity[iProductNum].push(iQuantity);

            // 상품기준의 경우 품목 총합으로 판단
            if (order_limit_type !== 'P') {
                if (iQuantity < iProductMin) {
                    alert(sprintf(__('상품별 최소 주문수량은 %s 입니다.'), iProductMin));
                    $(quantity_id).focus();
                    bResult = false;
                    return false;
                }
                if (iQuantity > iProductMax && iProductMax > 0) {
                    alert(sprintf(__('상품별 최대 주문수량은 %s 입니다.'), iProductMax));
                    $(quantity_id).focus();
                    bResult = false;
                    return false;
                }
            }
            iTotalOuantity = iTotalOuantity + iQuantity;
        });

        if (bResult == false) {
            return bResult;
        }
        if (typeof(EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE) === 'object') {
            for (var iProductNum in aQuantity) {
                if (aQuantity.hasOwnProperty(iProductNum) === false) {
                    continue;
                }
                if (EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.oBundleConfig.hasOwnProperty(iProductNum) === false) {
                    continue;
                }

                if (EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.isValidQuantity(aQuantity[iProductNum], iProductNum) === false) {
                    return false;
                }
            }
        }
        // 본상품 없이 구매가능하기때문에 본상품있을떄만 체크
        if (bSaleMainProduct === true) {
            if (order_limit_type === 'P') {
                if (iTotalOuantity < iProductMin) {
                    alert(sprintf(__('최소 주문수량은 %s개 입니다.'), iProductMin));
                    bResult = false;
                    return false;
                }
                if (iTotalOuantity > iProductMax && iProductMax > 0) {
                    alert(sprintf(__('최대 주문수량은 %s개 입니다.'), iProductMax));
                    bResult = false;
                    return false;
                }
            }
            if (buy_unit_type === 'P') {
                if (iTotalOuantity % parseInt(buy_unit, 10) !== 0) {
                    alert(sprintf(__('구매 주문단위는 %s개 입니다.'), parseInt(buy_unit, 10)));
                    bResult = false;
                    return false;
                }
            }
        }
        if ($('.add_products').find('[name="quantity_opt[]"]').length > 0) {
            var aTotalQuantity = {};
            $('.add_products').find('[name="quantity_opt[]"]').each(function () {
                    iQuantity = parseInt($(this).val());
                    if (typeof(aTotalQuantity[$(this).attr('product-no')]) === 'undefined' || aTotalQuantity[$(this).attr('product-no')] < 1) {
                        aTotalQuantity[$(this).attr('product-no')] = 0;
                    }
                    aTotalQuantity[$(this).attr('product-no')] += parseInt($(this).val(), 10);

                }
            );

            for (var iProductNo in aTotalQuantity) {
                var aProductQuantityInfo = ProductAdd.getProductQuantityInfo(iProductNo);

                if (aProductQuantityInfo.order_limit_type === 'P') {
                    if (aTotalQuantity[iProductNo] < aProductQuantityInfo.product_min) {
                        alert(sprintf(__('최소 주문수량은 %s개 입니다.'), aProductQuantityInfo.product_min));
                        bResult = false;
                        return false;
                    }
                    if (aTotalQuantity[iProductNo] > aProductQuantityInfo.product_max && aProductQuantityInfo.product_max > 0) {
                        alert(sprintf(__('최대 주문수량은 %s개 입니다.'), aProductQuantityInfo.product_max));
                        bResult = false;
                        return false;
                    }
                }
                if (aProductQuantityInfo.buy_unit_type === 'P') {
                    if (aTotalQuantity[iProductNo] % parseInt(aProductQuantityInfo.buy_unit, 10) !== 0) {
                        alert(sprintf(__('구매주문단위는 %s개 입니다.'), parseInt(aProductQuantityInfo.buy_unit, 10)));
                        bResult = false;
                        return false;
                    }
                }
            }
        }
        if (bResult == false) {
            return bResult;
        }
    }

    return iQuantity;
}

function commify(n)
{
    var reg = /(^[+-]?\d+)(\d{3})/; // 정규식
    n += ''; // 숫자를 문자열로 변환
    while (reg.test(n)) {
        n = n.replace(reg, '$1' + ',' + '$2');
    }
    return n;
}

var isClose = 'T';
function optionPreview(obj, sAction, sProductNo, closeType)
{
    var sPreviewId = 'btn_preview_';
    var sUrl = '/product/option_preview.html';
    var layerId = $('#opt_preview_' + sAction + '_' + sProductNo);

    // layerId = action명 + product_no 로 이루어짐 (한 페이지에 다른 종류의 상품리스트가 노출될때 구분 필요)
    if ($(layerId).length > 0) {
        $(layerId).show();
    } else if (sProductNo != '') {
        $.post(sUrl, 'product_no=' + sProductNo + '&action=' + sAction, function(result)
        {
            $(obj).after(result.replace(/[<]script( [^ ]+)? src=\"[^>]*>([\s\S]*?)[<]\/script>/g,""));
        });
    }
}

function closeOptionPreview(sAction, sProductNo)
{
    isClose = 'T';
    setTimeout("checkOptionPreview('" + sAction + "','" + sProductNo + "')", 150);
}

function checkOptionPreview(sAction, sProductNo)
{
    var layerId = $('#opt_preview_' + sAction + '_' + sProductNo);
    if (isClose == 'T') $(layerId).hide();
}

function openOptionPreview(sAction, sProductNo)
{
    isClose = 'F';
    var layerId = $('#opt_preview_' + sAction + '_' + sProductNo);
    $(layerId).show();

    $(layerId).mousemouseenter(function()
    {
        $(layerId).show();
    }).mouseleave(function()
    {
        $(layerId).hide();
    });

}

/**
 * 네이버 페이 주문하기
 */
function nv_add_basket_1_product()
{
    bIsMobile = false;

    if (_isProc == 'F') {
        alert(__("네이버 페이 입점상태를 확인하십시오."));
        return;
    }

    if (typeof(set_option_data) != 'undefined') {
        alert(__('세트상품은 네이버 페이 구매가 불가하오니, 쇼핑몰 바로구매를 이용해주세요. 감사합니다.'));
        return;
    }

    product_submit('naver_checkout', '/exec/front/order/basket/')
}

/**
 * 네이버 페이 찜하기
 */
function nv_add_basket_2_product()
{
    if (_isProc == 'F') {
        alert(__("네이버 페이 입점상태를 확인하십시오."));
        return;
    }

    window.open("/exec/front/order/navercheckoutwish?product_no=" + iProductNo, "navercheckout_basket",
            'scrollbars=yes,status=no,toolbar=no,width=450,height=300');
}

/**
 * 네이버 페이 주문하기
 */
function nv_add_basket_1_m_product()
{
    bIsMobile = true;

    if (_isProc == 'F') {
        alert(__("네이버 페이 입점상태를 확인하십시오."));
        return;
    }

    if (typeof(set_option_data) != 'undefined') {
        alert(__('세트상품은 네이버 페이 구매가 불가하오니, 쇼핑몰 바로구매를 이용해주세요. 감사합니다.'));
        return;
    }

    product_submit('naver_checkout', '/exec/front/order/basket/')
}

/**
 * 네이버 페이 찜하기
 */
function nv_add_basket_2_m_product()
{
    if (_isProc == 'F') {
        alert(__("네이버 페이 입점상태를 확인하십시오."));
        return;
    }

    window.location.href = "/exec/front/order/navercheckoutwish?product_no=" + iProductNo;
    //window.open("/exec/front/order/navercheckoutwish?product_no=" + iProductNo, "navercheckout_basket", 'scrollbars=yes,status=no,toolbar=no,width=450,height=300');
}

/**
 * 옵션 추가 구매시에 같은 옵션을 검사하는 함수
 *
 * @returns Boolean
 */
function duplicateOptionCheck()
{
    var bOptionDuplicate = getOptionDuplicate();
    //var bAddOptionDuplicate = getAddOptionDuplicate();

    if (bOptionDuplicate !== true  ){ //}&& bAddOptionDuplicate !== true) {
        alert(__('동일한 옵션의 상품이 있습니다.'));
        return false;
    }

    return true;
}

/**
 * 텍스트 인풋 옵션 중복 체크
 *
 * @returns {Boolean}
 */
function getAddOptionDuplicate()
{
    var aOptionRow = new Array();
    var iOptionLength = 0;
    var aOptionValue = new Array();
    var bReturn = true;
    // 기본 옵션
    $('[id^="' + add_option_id + '"]').each(function()
    {
        aOptionRow.push($(this).val());
    });
    aOptionValue.push(aOptionRow.join(',@,'));
    $('.EC_MultipleOption').each(function()
    {
        aOptionRow = new Array();
        $($(this).find('.' + $.data(document, 'multiple_option_input_class'))).each(function()
        {
            aOptionRow.push($(this).val());
        });
        var sOptionRow = aOptionRow.join(',@,');
        if ($.inArray(sOptionRow, aOptionValue) > -1) {
            bReturn = false;
            return false;
        } else {
            aOptionValue.push(sOptionRow);
        }
    });
    return bReturn;
}
/**
 * 일반 셀렉트박스형 옵션 체크 함수
 *
 * @returns {Boolean}
 */
function getOptionDuplicate() {
    // 선택여부는 이미 선택이 되어 있음
    var aOptionId = new Array();
    var aOptionValue = new Array();
    var aOptionRow = new Array();
    var iOptionLength = 0;
    // 기본 옵션
    $('select[id^="' + product_option_id + '"]').each(function (i) {
        aOptionValue.push($(this).val());
        iOptionLength++;
    });
    // 추가 구매
    $('.' + $.data(document, 'multiple_option_select_class')).each(function (i) {
        aOptionValue.push($(this).val());
    });

    var aOptionRow = new Array();
    for (var x in aOptionValue) {
        var sOptionValue = aOptionValue[x];
        aOptionRow.push(sOptionValue);
        if (x % iOptionLength == iOptionLength - 1) {
            var sOptionId = aOptionRow.join('-');

            if ($.inArray(sOptionId, aOptionId) > -1) {
                return false;
            }
            aOptionId.push(sOptionId);
            aOptionRow = new Array();
        }
    }

    return true;
}

//sms 재입고
function action_sms_restock(sParam)
{
    // 모바일 접속 및 레이어 팝업 여부 확인
    if (typeof(EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER) !== 'undefined') {
        if (EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER.createSmsRestockLayerDisplayResult(sParam) === true) {
            return;
        }
    }

    window.open('#none', 'sms_restock' ,'width=459, height=490, scrollbars=yes');
    $('#frm_image_zoom').attr('target', 'sms_restock');
    $('#frm_image_zoom').attr('action', '/product/sms_restock.html');
    $('#frm_image_zoom').submit();
}

//email 재입고
function action_email_restock(iProductNo)
{
    if (typeof(iProductNo) === 'undefined') {
        iProductNo = '';
    }

    window.open('#none', 'email_restock' ,'width=459, height=490, scrollbars=yes');
    $('#frm_image_zoom').attr('target', 'email_restock');
    $('#frm_image_zoom').attr('action', '/product/email_restock.html?product_no' + iProductNo);
    $('#frm_image_zoom').submit();
}

// 최대 할인쿠폰 다운받기 팝업
function popupDcCoupon(product_no, coupon_no, cate_no, opener_url, location)
{
    var Url = '/';
    if ( location === 'Front' || typeof location === 'undefined') {
        Url += 'product/'
    }
    Url += '/coupon_popup.html';
    window.open(Url + "?product_no=" + product_no + "&coupon_no=" + coupon_no + "&cate_no=" + cate_no + "&opener_url=" + opener_url, "popupDcCoupon", "toolbar=no,scrollbars=no,resizable=yes,width=800,height=640,left=0,top=0");
}

/**
 * 관련상품 열고 닫기
 */
function ShowAndHideRelation()
{
    try {
        var sRelation = $('ul.mSetPrd').parent();
        var sRelationDisp = sRelation.css('display');
        if (sRelationDisp === 'none') {
            $('#setTitle').removeClass('show');
            sRelation.show();
        } else {
            $('#setTitle').addClass('show');
            sRelation.hide();
        }
    } catch(e) { }
 }

var ITEM = {
    getItemCode : function()
    {
        var chk_has_opt = '';
        try {
            chk_has_opt = has_option;
        }catch(e) {chk_has_opt = 'T';}

        if (chk_has_opt == 'F') {
            return [item_code];
        } else {
            // 필수값 체크
            var bRequire = false;
            $('[id^="product_option_id"]').each(function() {
                if (Boolean($(this).attr('required')) === true || $(this).attr('required') == 'required') {
                    bRequire = true;
                    return false;
                }
            });

            var aItemCode = new Array();
            if (bRequire === true) {
                if ($('#totalProducts').size() === 0) {
                    sItemCode = this.getOldProductItemCode();
                    if (sItemCode !== false) {
                        if (typeof(sItemCode) === 'string') {
                            aItemCode.push(sItemCode);
                        } else {
                            aItemCode = sItemCode;
                        }
                    } else {
                        // 옵션이 선택되지 않음
                        return false;
                    }
                } else {
                    if ($('.option_box_id').length == 0) {
                        // 옵션이 선택되지 않음
                        return false;
                    }
                    $('.option_box_id').each(function() {
                        aItemCode.push($(this).val());
                    });
                }
            }

            return aItemCode;
        }
    },
    getWishItemCode : function()
    {
        var chk_has_opt = '';
        try {
            chk_has_opt = has_option;
        }catch(e) {chk_has_opt = 'T';}

        if (chk_has_opt == 'F') {
            return [item_code];
        } else {
            // 필수값 체크
            var bRequire = false;
            $('[id^="product_option_id"]').each(function() {
                if (Boolean($(this).attr('required')) === true || $(this).attr('required') == 'required') {
                    bRequire = true;
                    return false;
                }
            });

            var aItemCode = new Array();
            if (bRequire === true) {
                if ($('#totalProducts').size() === 0) {
                    sItemCode = this.getOldProductItemCode();
                    if (sItemCode !== false) {
                        if (typeof(sItemCode) === 'string') {
                            aItemCode.push(sItemCode);
                        } else {
                            aItemCode = sItemCode;
                        }
                    } else {
                        // 옵션이 선택되지 않음
                        return false;
                    }
                } else {
                    if ($('.soldout_option_box_id,.option_box_id').length == 0) {
                        // 옵션이 선택되지 않음
                        return false;
                    }
                    $('.soldout_option_box_id,.option_box_id').each(function() {
                        aItemCode.push($(this).val());
                    });
                }
            }

            return aItemCode;
        }
    },
    getOldProductItemCode : function(sSelector)
    {
        if (sSelector === undefined) {
            sSelector = '[id^="product_option_id"]';
        }
        var sItemCode = null;
        // 뉴상품 옵션 선택 구매
        if (has_option === 'F') {
            // 화면에 있음
            sItemCode = item_code;
        } else {
            if (item_listing_type == 'S') {
                var aOptionValue = new Array();
                $(sSelector).each(function() {
                    if (ITEM.isOptionSelected($(this).val()) === true) {
                        aOptionValue.push($(this).val());
                    }
                });

                if (option_type === 'T') {
                    var aCodeMap = $.parseJSON(option_value_mapper);
                    sItemCode = aCodeMap[aOptionValue.join('#$%')];
                } else {
                    sItemCode = aOptionValue;
                }
            } else {
                sItemCode = $(sSelector).val();
            }
        }

        if (sItemCode === undefined) {
            return false;
        }

        return sItemCode;
    },
    isOptionSelected : function(aOption)
    {
        var sOptionValue = null;
        if (typeof aOption === 'string') {
            sOptionValue = aOption;
        } else {
            if (aOption.length === 0) return false;
            sOptionValue = aOption.join('-|');
        }

        sOptionValue = '-|'+sOptionValue+'-|';
        return !(/-\|\*{1,2}-\|/g).test(sOptionValue);
    },
    setBodyOverFlow : function(sType)
    {
        var sLocation =  location;
        var bBuyLayer = false;

        //var oReturnData = new Object();
        if (EC_SHOP_FRONT_PRODUCT_OPTIONLAYER.isExistLayer(true) === true) {
            //parent.$('html, body').css('overflowY', 'auto');
            closeBuyLayer(false);
            sLocation =  parent.location;
            bBuyLayer = true;
        }

        //프레임으로 선언된 페이지일경우
        if (typeof(bIsOptionSelectFrame) !== 'undefined' && bIsOptionSelectFrame === true) {
            sLocation =  parent.location;
            bBuyLayer = true;
        }
        /*
        oReturnData['sLocation'] = sLocation;
        oReturnData['bBuyLayer'] = bBuyLayer;
        */

        oReturnData = sLocation;

        if (typeof(sType) === 'boolean') {
            oReturnData = bBuyLayer;
        }
        return oReturnData;
    }
};

var EC_SHOP_FRONT_PRODUCT_RESTOCK = (function() {

    return {
        isRestock : function(sType) {

            if (sType === 'sms_restock') {
                return true;
            }

            if (sType === 'email_restock') {
                return true;
            }

            return false;
        },
        openRestockEmailPopup : function()
        {
            product_submit('email_restock');
        },
        bindOpenRestockEmailPopup : function(product_no)
        {
            action_email_restock(product_no);

        }
    }
})();

//상세 장바구니 담기확인창에서 스크립트를 중목으로 볼러오는부분을 제거하기위해서 추가
//사용자 디자인에서도 basket.js에 있는 함수에 의존적이라서 추가가 안되어있다면 아래 함수들을 실행하도록 함
if (typeof(layer_basket_paging) !== 'function') {
  //레이어 장바구니 페이징
  function layer_basket_paging(page_no)
  {
      var sUrl = '/product/add_basket2.html?page=' + page_no + '&layerbasket=T';
      if (typeof(sBasketDelvType) !== 'undefined') {
          sUrl += sUrl + '&delvtype=' + sBasketDelvType;
      }
      $.get(sUrl, '', function(sHtml)
      {
          sHtml = sHtml.replace(/<script.*?ind-script\/optimizer.php.*?<\/script>/g, '');
          $('#confirmLayer').html(sHtml);
          $('#confirmLayer').show();

          // set delvtype to basket
          try {
              $(".xans-order-layerbasket").find("a[href='/order/basket.html']").attr("href", "/order/basket.html?delvtype=" + delvtype);
          } catch (e) {}
      });
  }
}

if (typeof(Basket) === 'undefined') {
  var Basket = {
      orderLayerAll : function(oElem) {
          var aParam = {basket_type:'all_buy'};
          var sOrderUrl = $(oElem).attr('link-order') || '/order/orderform.html?basket_type='+ aParam.basket_type;

          if (sBasketDelvType != "") {
              sOrderUrl += '&delvtype=' + sBasketDelvType;
          }
          var sLoginUrl = $(oElem).attr('link-login') || '/member/login.html';

          $.post('/exec/front/order/order/', aParam, function(data){
              if (data.result < 0) {
                  alert(data.alertMSG);
                  return;
              }

              if (data.isLogin == 'F') { // 비로그인 주문 > 로그인페이지로 이동
                  location.href = sLoginUrl + '?noMember=1&returnUrl=' + escape(sOrderUrl);
              } else {
                  location.href = sOrderUrl;
              }
          }, 'json');
      }
  }
}

/**
 * 장바구니 유효성 검증 validation
 */
var EC_SHOP_FRONT_BASKET_VALIID = {
    // 장바구니 상품 중복여부 확인
    isBasketProductDuplicateValid : function (sParam)
    {
        var bReturn = true;

        $.ajax({
            url:  '/exec/front/order/Basketduplicate/',
            type: 'post',
            data: sParam,
            async: false,
            dataType: 'json',
            success: function(data) {
                if (data.result === true) {
                    if (confirm(__('장바구니에 동일한 상품이 있습니다. ' + '\n' + '장바구니에 추가하시겠습니까?')) === false) {
                        bReturn = false;
                        return false;
                    }
                }
            }
        });

        return (bReturn === false) ? false : true;
    }
};

/**
 * 추가구성 상품 라이브러리
 */
var TotalAddSale = function() {
  //추가할인액계산
    var oProductList = new Object();
    var oOlnkProductList = new Object();
    var oTotalAddSaleParam = new Object();
    var iTotalAddSalePrice = 0;
    var oTotalAddSaleData = new Object();
    var bSoldOut = false;
    var oDefaultOption = {
            url : "/exec/front/shop/CalculatorProduct",
            type : "post",
            data : oTotalAddSaleParam,
            dataType : "json",
            timeout : 5000,
            compleat : function() {
                TotalAddSale.setAsyncMode(true);
            }
        };

    /**
     * 추가할인액 주문api조회
     * @param fCallback 콜백함수
     * @return TotalAddSale.iTotalAddSalePrice
     */
    var getCalculatorSalePrice = function (fCallback, iPrice) {
        var oOption = {
                success : function(oResponse){
                    TotalAddSale.oTotalAddSaleData = oResponse;
                    if (TotalAddSale.bSoldOut === false) {
                        TotalAddSale.iTotalAddSalePrice = oResponse.iTotalAddSalePrice;
                        TotalAddSale.iTotalOrderPrice = oResponse.iTotalOrderPrice;
                        TotalAddSale.oProductTaxTypeText = oResponse.product_tax_type_text;
                        TotalAddSale.sDisplayVatSeparately = oResponse.display_prd_vat_separately;
                    }

                    fCallback(iPrice);
                },
                error : function(){
                    if ($('.EC-price-warning').size() > 0) {
                        $('.EC-price-warning').removeClass('displaynone').show();
                    } else {
                        alert(__('할인가가 적용된 최종 결제예정금액은 주문 시 확인할 수 있습니다.'));
                    }
                    fCallback(iPrice);
                }
                
        }

        // 품절일 경우 할인액 계산 제외
        if ($('.soldout_option_box_id').length > 0) {
            $('.soldout_option_box_id').each(function(){
                delete oDefaultOption.data['product'][$(this).val()];
            });
        }
        $.ajax($.extend(oDefaultOption, oOption));
    }

    return {
        removeProductData : function(sOptionKey)
        {
            delete oProductList[sOptionKey];
        },
        setProductClear : function()
        {
            oProductList = {};
        },
        // 총 추가할인액 반환
        getTotalAddSalePrice : function() {
            return TotalAddSale.iTotalAddSalePrice;
        },
        // 계산할 정보 셋팅
        setParam : function(sKey, value) {
            oTotalAddSaleParam[sKey] = value;
        },
        clearAddSaleParam : function(sKey)
        {
            delete oTotalAddSaleParam[sKey];
        },
        getParam : function()
        {
            return oTotalAddSaleParam;
        },
        // 계산될 상품리스트
        getProductList : function() {
            return oProductList;
        },
        // 총 추가할인금액 리셋
        setTotalAddSalePrice : function(iSalePrice) {
            TotalAddSale.iTotalAddSalePrice = iSalePrice;
        },
        // 계산할 정보 수량 셋팅
        setQuantity : function(sItemCode, sQuantity) {
            oProductList[sItemCode] = sQuantity;
        },
        setOlnkAddProduct : function(sItemCode, iProductNo) {
            oOlnkProductList[sItemCode] = iProductNo;
        },
        getOlnkAddProductList : function() {
            return oOlnkProductList;
        },
        // api호출
        getCalculatorSalePrice : function(fCallback, iPrice) {
            getCalculatorSalePrice(fCallback, iPrice);
        },
        // 총 추가할인액 반환
        getItemAddSalePrice : function(sItemCode) {
            if ( typeof(TotalAddSale.oTotalAddSaleData) != 'undefined' ){
                return parseFloat(TotalAddSale.oTotalAddSaleData[sItemCode].unit_add_sale , 10);
            } else {
                return 0;
            }
        },
        // 총 추가할인금액 리셋
        setSoldOutFlag : function(bSoldOut) {
            if ( typeof(bSoldOut) == 'undefined' || bSoldOut === null) {
                bSoldOut = false;
            }
            TotalAddSale.bSoldOut = bSoldOut;
        },
        // 적립금 총 계산
        getMileageGenerateCalc : function(sItemCode, iQuantity) {
            if (TotalAddSale.bSoldOut === false && typeof(TotalAddSale.oTotalAddSaleData) != 'undefined') {
                if (typeof(TotalAddSale.oTotalAddSaleData[sItemCode]) !== 'undefined' && typeof(TotalAddSale.oTotalAddSaleData[sItemCode].mileage_generate_calc) !== 'undefined') {
                    return parseFloat(TotalAddSale.oTotalAddSaleData[sItemCode].mileage_generate_calc, 10);
                } else {
                    return 0;
                }
            } else {
                return (typeof(mileage_generate_calc) != 'undefined') ? mileage_generate_calc * iQuantity : 0;
            }
        },
        // 적립금 유효성 검증
        checkVaildMileageValue : function(iMileageValue) {
            if (typeof (iMileageValue) === 'undefined' && iMileageValue === 0.00 || iMileageValue <= 0) {
                return false;
            }

            return true;
        },
        // 추가할인가 재계산 필요 여부 리턴
        needRecalculatorSalePrice : function() {
            // 부가세 표시문구 확인
            var oProductTaxTypeText = TotalAddSale.getProductTaxTypeText();
            if (typeof(oProductTaxTypeText) !== 'undefined') {
                return true;
            }

            if (typeof product_sale_price != 'undefined' && product_sale_price > 0) {
                return true;
            }

            if (TotalAddSale.getTotalAddSalePrice() > 0) {
                return true;
            }

            return false;
        },
        // 판매가 부가세 표시문구 설정
        getProductTaxTypeText : function() {
            return TotalAddSale.oProductTaxTypeText;
        },
        // 실제 총 주문금액
        getTotalOrderPrice : function() {
            return TotalAddSale.iTotalOrderPrice;
        },
        // 부가세 별도 표시 설정
        getDisplayVatSeparately : function() {
            return TotalAddSale.sDisplayVatSeparately;
        },
        getItemSalePrice : function(sItemCode)
        {
            if (typeof(TotalAddSale.oTotalAddSaleData[sItemCode]) === 'undefined') {
                return false;
            }
            return TotalAddSale.oTotalAddSaleData[sItemCode].unit_sale_price;
        },
        // 부가세 고정세율 총상품금액
        getVatSubTotalPrice : function(sItemCode) {
            var sDisplayVatSeparately = TotalAddSale.getDisplayVatSeparately();
            if (typeof(sDisplayVatSeparately) === 'undefined') {
                return 0;
            }

            if (sDisplayVatSeparately !== true) {
                return 0;
            }

            if (typeof(TotalAddSale.oTotalAddSaleData[sItemCode]) === 'undefined') {
                return 0;
            }

            return TotalAddSale.oTotalAddSaleData[sItemCode].vat_sub_total_price;
        }
    };
}();

$(document).ready(function(){

});

// sms 재입고 알림 모바일 레이어 팝업
var EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER = {
    bExistMobileLayerModule : false,
    sRequireSmsRestockParam : '',

    setCheckSmsRestockLayerPopup : function()
    {
        //모바일이 아니라면 사용하지 않음
        if (mobileWeb === false) {
            return;
        }

        if ($('a[id^="btn_restock"]').length < 1) {
            return;
        }

        //아이프레임 내에서는 레이어를 다시띄우지 않음
        if (CAPP_SHOP_FRONT_COMMON_UTIL.findTargetFrame() === parent) {
            return;
        }

        $.ajax({
            url : '/exec/front/Product/Moduleexist?section=product&file=sms_restock_layer&module=Product_RestockSms',
            dataType : 'json',
            success : function (data) {
                if (data.result === true) {
                    EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER.bExistMobileLayerModule = true;
                }
            }
        });
    },
    createSmsRestockLayerDisplayResult : function(sParam)
    {
        //레이어 사용가능상태가 아니면 false로 바로 리턴
        if (EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER.bExistMobileLayerModule === false) {
            return false;
        }

        if ($.trim(sParam).length < 1) {
            return false;
        }

        try {
            EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER.sRequireSmsRestockParam = sParam;
            EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER.setProductSmsRestockCreateLayer();
        } catch (e) {
            return false;
        }

        return true;
    },
    setProductSmsRestockCreateLayer : function()
    {
        try {
            $('#ec-product-sms-restock-layer').remove();
        } catch ( e ) {}

        var sSmsLayerUrl = '/product/sms_restock_layer.html?' + EC_SHOP_FRONT_PRODUCT_SMS_RESTOCK_LAYER.sRequireSmsRestockParam + '&bSmsRestockLayer=T';
        var aSmsRestockLayerHtml = [];

        aSmsRestockLayerHtml.push('<div id="ec-product-sms-restock-layer" style="position:fixed; top:0; left:0; right:0; bottom:0; webkit-overflow-scrolling:touch; z-index:999;">');
        aSmsRestockLayerHtml.push('<iframe src="'+sSmsLayerUrl+'" id="smsRestockLayerIframe" frameborder="0" style="width:100%; height:100%;"></iframe>');
        aSmsRestockLayerHtml.push('</div>');

        $('body').append(aSmsRestockLayerHtml.join(''));
        $('body').addClass('eMobilePopup');
    },
    closeSmsRestockLayer : function()
    {
        if (opener) {
            self.close();
        } else {
            parent.$('body').attr('id', 'layout');
            parent.$('body').removeClass('eMobilePopup');
            parent.$('#ec-product-sms-restock-layer').remove();
        }
    }
};

/**
 * 목록 > 상품 좋아요.
 */
var EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT = {
    bIsReady    : false,   // 좋아요 클릭준비완료 여부.
    bIsSetEvent : false,   // 좋아요 버튼 이벤트 지정 여부.
    aImgSrc     : [], // 좋아요(On/Off) 아이콘 경로.
    aImgAlt     : [], // 좋아요(On/Off) 아이콘 Alt태그
    aMyLikePrdNo: [], // 유저가 이미 좋아요 선택한 상품번호
    oMyshopLikeCntNode : null, // layout_shopingInfo 좋아요 span 노드

    // 상품 좋아요 초기화
    init : function() {
        // 상품 좋아요 사용안함시
        if (EC_SHOP_FRONT_NEW_LIKE_COMMON.aConfig.bIsUseLikeProduct !== true) {
            return;
        }

        // ajax 유저가 이미 좋아요 선택한 상품번호 얻기 + 아이콘세팅
        this.setLoadData();
    },

    // 유저가 이미 좋아요 선택한 상품번호 얻기 + 아이콘세팅
    setLoadData : function() {
        if ($('.likePrdIcon').count < 1) {
            return;
        }

        var self = this;

        EC_SHOP_FRONT_NEW_LIKE_COMMON.getMyLikeProductNoInList(function(aData) {
            self.aImgSrc = aData.imgSrc;
            self.aImgAlt = aData.imgAlt;
            self.aMyLikePrdNo = aData.rows;

            // 아이콘(on) 세팅
            self.setMyLikeProductIconOn();

            // 좋아요 클릭 이벤트핸들러 지정
            if (self.bIsSetEvent === false) {
                self.setEventHandler();
                self.bIsSetEvent = true;
            }
        }, function() {
            self.bIsReady = true;
        });
    },

    // 페이지 로드시 유저가 좋아요한 상품 On.아이콘으로 변경
    setMyLikeProductIconOn : function() {
        var aData = this.aMyLikePrdNo;

        for (var i=0; i < aData.length; i++) {
            // selected 스타일 적용
            $(".likePrd_" + aData[i].product_no).each(function() {
                $(this).addClass('selected');
            });

            // 아이콘 이미지경로 변경
            $(".likePrdIcon[product_no='" + aData[i].product_no + "']").each(function() {
                $(this).attr({'src':EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.aImgSrc.on, 'icon_status':'on', 'alt' : EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.aImgAlt.on});
            });
        }
    },

    // 이벤트핸들러 지정
    setEventHandler : function() {
        // 좋아요 아이콘 클릭 이벤트
        $('.likePrd').live('click', EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.clickLikeIcon);

        var sContext = '';
        if (typeof(PREVIEWPRDOUCT) === 'undefined') {
            sContext = window.parent.document;
        }
        // 마이쇼핑 > 상품좋아요 페이지
        if ($(".xans-myshop-likeproductlist", sContext).length > 0) {
            // 팝업 확대보기창 닫기 이벤트
            if ($(".xans-product-zoompackage").length > 0) {
                $('.xans-product-zoompackage div.close').live('click', EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.closeZoomReload);
            }
        }
    },

    // 좋아요 아이콘 클릭 이벤트핸들러
    clickLikeIcon : function() {
        if (EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.bIsReady === false ) {
            return;
        }

        // 클릭한 상품의 좋아요수, 아이콘 정보얻기
        var iPrdNo     = $('.likePrdIcon', this).attr('product_no');
        var iCateNo    = $('.likePrdIcon', this).attr('category_no');
        var sIconStatus= $('.likePrdIcon', this).attr('icon_status');
        // 카운트 string > int 형으로 변환 (ECHOSTING-260504)
        var iLikeCount = EC_SHOP_FRONT_NEW_LIKE_COMMON.getNumericRemoveCommas($('.likePrdCount', this).text());

        // 아이콘경로 및 좋아요수 증감처리
        var sNewImgSrc = sNewIconStatus = "";
        var iNewLikeCount = 0;
        var oLikeWrapNode = $(".likePrd_" + iPrdNo);

        if (sIconStatus === 'on') {
            sNewIconStatus = 'off';
            sNewImgSrc = EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.aImgSrc.off;
            sNewImgAlt = EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.aImgAlt.off;
            if (iLikeCount > 0) {
                iNewLikeCount = --iLikeCount;
            }

            oLikeWrapNode.each(function() {
                $(this).removeClass('selected');
            });
        } else {
            sNewIconStatus = 'on';
            sNewImgSrc = EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.aImgSrc.on;
            sNewImgAlt = EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.aImgAlt.on;
            iNewLikeCount = ++iLikeCount;

            // 동일상품 selected 스타일적용
            oLikeWrapNode.each(function() {
                $(this).addClass('selected');
            });
        }
        // 좋아요 카운트 number_format (ECHOSTING-260504)
        iNewLikeCount = EC_SHOP_FRONT_NEW_LIKE_COMMON.getNumberFormat(iNewLikeCount);
        // 상단.layout_shopingInfo 좋아요수 업데이트
        EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.updateShopInfoCount(sNewIconStatus);

        // 좋아요 아이콘이미지 + 좋아요수 업데이트
        EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.updateLikeIconCount(iPrdNo, sNewImgSrc, sNewIconStatus, iNewLikeCount, sNewImgAlt);

        // ajax 호출 좋아요수(상품) + 마이쇼핑 좋아요 저장
        EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.submitMyLikeProduct(iPrdNo, iCateNo, sNewIconStatus);

        // 확대보기 팝업에서 좋아요 클릭시, 부모프레임 좋아요 업데이트
        if ($(".xans-product-zoompackage").length > 0) {
            window.parent.EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.updateShopInfoCount(sNewIconStatus);
            window.parent.EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.updateLikeIconCount(iPrdNo, sNewImgSrc, sNewIconStatus, iNewLikeCount);
        }
    },

    // 마이쇼핑 > 상품좋아요 목록 > 팝업 확대보기창 닫기 이벤트핸들러
    closeZoomReload : function() {
        var sIconsStatus = $('.xans-product-zoompackage .likePrdIcon').attr('icon_status');

        // 팝업에서 좋아요를 취소했으면 좋아요 목록 새로고침
        if (sIconsStatus === 'off') {
            window.parent.location.reload();
        }
    },

    // 좋아요 아이콘이미지 + 좋아요수 업데이트
    updateLikeIconCount : function(iPrdNo, sImgSrc, sIconStatus, iLikeCount, sNewImgAlt) {
        // 클릭한 동일상품 아이콘 변경
        $(".likePrdIcon[product_no='" + iPrdNo + "']").each(function() {
            $(this).attr({'src':sImgSrc, 'icon_status':sIconStatus, 'alt' : sNewImgAlt});
        });

        // 클릭한 동일상품 좋아요수 변경
        $('.likePrdCount_' + iPrdNo).each(function() {
            $(this).text(iLikeCount);
        });
    },

    // 상단.layout_shopingInfo 좋아요수 업데이트
    updateShopInfoCount : function(sIconStatus) {
        if (EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.oMyshopLikeCntNode === null) {
            EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.oMyshopLikeCntNode = $('#xans_myshop_like_prd_cnt');
        }

        if (EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.oMyshopLikeCntNode !== null) {
            var iMyshopLikeCnt = parseInt( $(EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.oMyshopLikeCntNode).text() );
            iMyshopLikeCnt = (sIconStatus === 'on') ? iMyshopLikeCnt + 1  : iMyshopLikeCnt - 1;
            iMyshopLikeCnt = (iMyshopLikeCnt < 0 || isNaN(iMyshopLikeCnt)) ? 0 : iMyshopLikeCnt;
            EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.oMyshopLikeCntNode.text(iMyshopLikeCnt + '개');
        }
    },

    // 상품 좋아요수 + 마이쇼핑 좋아요 저장
    submitMyLikeProduct : function(iPrdNo, iCateNo, sIconStatus) {
        if (sIconStatus === 'on') {
            this.aMyLikePrdNo.push(iPrdNo);
        } else {
            this.aMyLikePrdNo.pop(iPrdNo);
        }

        $.ajax({
            url: '/exec/front/shop/LikeCommon',
            type: 'get',
            data: {
                'mode'    : 'saveMyLikeProduct',
                'iPrdNo'  : iPrdNo,
                'iCateNo' : iCateNo,
                'sIconStatus': sIconStatus
            },
            dataType: 'json',
            success: function(oReturn) {
                if (oReturn.bResult === true) {
                    EC_SHOP_FRONT_NEW_LIKE_COMMON.purgeMyLikeProductNoInList();
                }
            },
            complete: function() {
                EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.bIsReady = true;
            }
        });
    }
};

$(document).ready(function() {
    EC_SHOP_FRONT_NEW_LIKE_COMMON_PRODUCT.init();  // 상품 좋아요.
});

var EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE = {
    oBundleConfig : {},

    iProductQuantity : 0,

    init : function(oInit)
    {
        if (typeof(oInit) === 'object') {
            this.oBundleConfig  = oInit;
        } else {
            if (sBundlePromotion === '' || typeof(sBundlePromotion) === 'undefined') {
                return;
            }
            this.oBundleConfig = $.parseJSON(sBundlePromotion);
        }
        // 강제로 후킹
        buy_unit = 1;
        product_min = 1;
        product_max = 0;

        $.data(document,'BundlePromotion', true);
    },
    getQuantityStep : function(iProductNum)
    {
        return this.oBundleConfig[iProductNum].bundle_quantity + 1;
    },
    /**
     * 실제 UI의 수량대신 1+N 이벤트로 인해 후킹된 상품 수량을 리턴
     */
    getQuantity : function(iQuantity, iProductNum)
    {
        var iReturn = iQuantity;
        if (typeof(this.oBundleConfig[iProductNum]) === 'undefined') {
            return iReturn;
        }

        iReturn = Math.ceil(iQuantity / this.getQuantityStep(iProductNum));

        return iReturn;
    },
    /**
     * 정확한 구매 수량이 맞는지 검증
     */
    isValidQuantity : function(aQuantity, iProductNum)
    {
        var bReturn = true;
        if (typeof(this.oBundleConfig[iProductNum]) === 'undefined') {
            return bReturn;
        }

        if (this.isValidQuantityCheck(aQuantity, iProductNum) === false) {
            alert(this.getAlertMessage([iProductNum]));
            return false;
        }
        return bReturn;
    },
    isValidQuantityCheck : function(aQuantity, iProductNum)
    {
        var iQuantityStep = this.getQuantityStep(iProductNum);

        if (this.oBundleConfig[iProductNum].bundle_apply_type === 'P') {
            EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.iProductQuantity = 0;
            $.map(aQuantity, function(pv, cv) {
                EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.iProductQuantity += pv;
            });
            return (EC_SHOP_FRONT_PRODUCT_DEATAIL_BUNDLE.iProductQuantity % iQuantityStep) === 0;
        }

        if (this.oBundleConfig[iProductNum].bundle_apply_type === 'I') {
            for (var i in aQuantity) {
                if (aQuantity.hasOwnProperty(i) === false) {
                    continue;
                }
                if (aQuantity[i] % iQuantityStep !== 0) {
                    return false;
                }
            }
        }
        return true;
    },
    getAlertMessage : function(iProductNum)
    {
        var sSubject = this.oBundleConfig[iProductNum].bundle_apply_type === 'P' ? '옵션에 상관없이' : '동일한 옵션으로';
        var sReturn = '1+%s 이벤트상품입니다.\n'+sSubject+' 수량을 %s개 단위로 구매해주세요.';
        return sprintf(__(sReturn), this.oBundleConfig[iProductNum].bundle_quantity, this.getQuantityStep(iProductNum));
    }
};

var isMobile = false;
var sInputMileBackground = '';
$(document).ready(function() {
    // 모바일접속 여부
    // mobileWeb 값이 있으면 참조하고 없으면 m. 도메인 체크
    if (mobileWeb == undefined) {
        if (window.location.hostname.substr(0, 2) == 'm.' || window.location.hostname.substr(0, 12) == 'mobile--shop' || window.location.hostname.substr(0, 11) == 'skin-mobile') {
            isMobile = true;
        }
    } else {
        isMobile = mobileWeb;
    }

    // 주문서 작성 페이지
    try {
        $('#np_use0').attr('checked', 'true');

        $('#np_use0').click(function() {
            if ($(this).attr('checked') == false) {
                initNaverMileage();
                if (isMobile == true && typeof(nbp) == 'object') {
                    nbp.mileage.inactive();
                }
            } else {
                if (isMobile == true && typeof(nbp) == 'object') {
                    nbp.mileage.active();
                }
            }
            if (isMobile == false) {
                setNaverPoint();
            }
        });
    } catch(e) {}

    // 네이버마일리지 적립금과 동시사용 불가에 따른 처리
    // 동시사용 불가인 경우 디자인 수정을 안했을때 기존꺼 노출
    try {
        if (isNMCanUseWithMileage() == false && isApplyDesignNMCanUseWithMileage() == false) {
            $('div.boardView').find('#input_mile').parents('div:first').removeClass('displaynone');
            $('div.boardView').find('#np_use0').parents('div:first').removeClass('displaynone');
        }
    } catch (e) {}

    // 적립금동시사용불가 디자인적용에 따른 처리
    try {
        if (isApplyDesignNMCanUseWithMileage()) {
            $('#either_mileage_navermileage_select0').attr('checked', true);
            if (isMobile == true) {
                $('input[name^="mileage_use_select"]').click(function() {
                    var oInputMile = getInputMileObject();
                    if ($(this).val() == 'mileage') {
                        initNaverMileage();
                        oInputMile.css('background', sInputMileBackground);
                        oInputMile.attr('readonly', false);
                        if (isApplyDesignNMCanUseWithMileage() == true) {
                            nbp.mileage.inactive();
                        }
                    } else {
                        sInputMileBackground = oInputMile.css('background');
                        oInputMile.val(0);
                        oInputMile.attr('readonly', true);
                        oInputMile.css('background', '#CCCCCC');
                        if (isApplyDesignNMCanUseWithMileage() == true) {
                            nbp.mileage.active();
                        }

                        if (bInflowParam != false){
                        } else {
                            $('#_either_mileage_acc').hide();
                        }
                    }
                    set_total_price();
                });
            } else {
                $('#navermileage_use_container').css({"display":"none"});
                $('input[id^="either_mileage_navermileage_select1"]').css("margin-left", "10px");
                $('label[for^="either_mileage_navermileage_select"]').css("padding-left", "3px");

                $('input[name^="mileage_use_select"]').click(function() {
                    var oMileageUseContainer = $('#mileage_use_container');
                    var oNavermileageUseContainer = $('#navermileage_use_container');
                    var oNavermileageGuideContainer = $('#navermileage_guide_cotainer');
                    var oInputMile = getInputMileObject();
                    oMileageUseContainer.css('display', 'none');
                    oNavermileageUseContainer.css('display', 'none');
                    oNavermileageGuideContainer.css('display', 'none');

                    if ($(this).val() == 'mileage') {
                        oMileageUseContainer.css('display', '');
                        initNaverMileage();
                    } else {
                        oNavermileageUseContainer.css('display', '');
                        oNavermileageGuideContainer.css('display', '');
                        oInputMile.val(0);

                        //네이버 ON 상태는 꼭 이렇게 비교하라고 해서 이렇게 함
                        if (bInflowParam != false) {
                        } else {
                            $('#either_divNvPointBtnAdd').hide();
                            $('#either_divNvDefaultGuide').html('네이버 통해 방문 시 적립/사용 가능');
                        }

                    }

                    if (bInflowParam != false) {
                        setNaverPoint();
                    }
                    set_total_price();
                });

                var oNavermileageGuideContainer = $('#navermileage_guide_cotainer');
                oNavermileageGuideContainer.css('display', 'none');
            }
        }
    } catch (e) {}


    // PC 쇼핑몰 > 주문서 작성페이지
    if (isMobile == false) {
        try {
            // 네이버마일리지 가이드 폭조정(동시사용 불가능 UI)
            $('.navermileage_guide').css({'text-align':'center', 'padding-top':'5px', 'padding-bottom':'5px', 'background-color':'#f7f7ff'});

            // 적립률 색상 변경 & bold처리
            $('#txt_np_save').css({'color':'#1ec228', 'font-weight':'bold'});
            $('#divNvPointOpr').css({'color':'#1ec228', 'font-weight':'bold'});
        } catch (e) {}
    }

    // 네이버 추가 적립률 네이버공통스크립트로 부터 가져오기
    try {
        var oNaverMileage = {
            'def' : 0,
            'base' : 0,
            'add' : 0
        };
        oNaverMileage.def = $('#np_save_rate_default').val();

        var oNvSaveRateBase = $('#naver_mileage_save_rate_base');
        var oNvMileageHelp  = $('#imgNaverMileageHelp');
        if ($('.naver_mileage_compare').length > 0 || mobileWeb === true) { // 상품비교, 모바일
            oNvSaveRateBase = $('.naver_mileage_save_rate_base');
            oNvMileageHelp  = $('.img_naver_mileage_help');
        }

        // get save rate of naverMileage
        if (typeof(wcs) == 'object') {
            var bInflowParam = wcs.getMileageInfo();
            if (bInflowParam != false) {
                oNaverMileage.base = wcs.getBaseAccumRate();
                oNaverMileage.add = wcs.getAddAccumRate();

                if (isMobile == false) {
                    if ($('.xans-order-form').length > 0) {//주문서
                        var oNaverStateImg = '<img src="//img.echosting.cafe24.com/design/skin/default/product/txt_naver_on1.png" style="margin:3px">';
                        $('#either_mileage_navermileage_select0').parents('tbody').find('th > label').html('적립금&<br>네이버마일리지<br>' + oNaverStateImg + '(택1)');

                        $('#naverPointStatus').html(oNaverStateImg);
                        $('#naverPointStatus img').css({'margin':'-3px 3px 0'});

                        $('#either_imgNaverMileageHelp').attr('//img.cafe24.com/images/ec_admin/btn/icon_q_green.gif');

                        if ($('#np_use0').parent().find("img").attr("src") == null || $('#np_use0').parent().find("img").attr("src") == undefined) {
                            $('#np_use0').parent().append(oNaverStateImg);
                        }
                        $('#imgNaverMileageHelp').attr('src', '//img.cafe24.com/images/ec_admin/btn/icon_q_green.gif');
                    } else {
                        $('#imgNaverMileageHelp').css({'margin-top' : '-2px'});
                    }
                }

            } else {
                oNaverMileage.base = oNaverMileage.def;

                if (isMobile == false) {
                    if ($('.xans-order-form').length > 0) {//주문서
                        var oNaverStateImg = '<img src="//img.echosting.cafe24.com/design/skin/default/product/txt_naver_off1.png" style="margin:3px">';

                        //택1 일 경우 (어차피 display none 일 때는 안 보임)
                        $('#either_mileage_navermileage_select0').parents('tbody').find('th > label').html('적립금&<br>네이버마일리지<br>' + oNaverStateImg + '(택1)');

                        $('#naverPointStatus').html(oNaverStateImg);
                        $('#naverPointStatus img').css({'margin':'-3px 3px 0'});

                        $('#np_use0').hide();
                        $('#divNvPointBtnAdd').hide();
                        $('#divNvDefaultGuide').html('네이버 통해 방문 시 적립/사용 가능');


                        $('label[for="np_use0"]').parent().html('네이버 마일리지' + oNaverStateImg);
                        $('#imgNaverMileageHelp').attr('src', '//img.cafe24.com/images/ec_admin/btn/icon_q_green.gif');
                        $('.naverInfo').hide();
                    } else {//상품상세
                        var sNaverStateImg = '//img.echosting.cafe24.com/design/skin/default/product/txt_naver_off2.png';
                        var sOnClick = "NaverMileage.openMileageIntroPopup('http://static.mileage.naver.net/static/20130708/ext/intro.html');";
                        oNvSaveRateBase.parent().html('네이버 마일리지 <a href="#none" onclick="' + sOnClick + '"><img src="' + sNaverStateImg + '" style="margin-top:-2px;"></a><br>(네이버 통해 방문 시 적립/사용 가능)');

                    }
                }

            }
        } else {
            oNaverMileage.base = $('#np_save_rate').val();
            oNaverMileage.add = $('#np_save_rate_add').val();
        }

        if (oNaverMileage.base == 0 || oNaverMileage.base == '') {
            oNaverMileage.base = oNaverMileage.def;
        }

        // casting data type
        oNaverMileage.def = castDataType(oNaverMileage.def);
        oNaverMileage.base = castDataType(oNaverMileage.base);
        oNaverMileage.add = castDataType(oNaverMileage.add);

        // true -  상품상세/상품비교 페이지, false - 주문서 작성 페이지
        if (document.getElementById('naver_mileage_save_rate_base') != undefined && document.getElementById('naver_mileage_save_rate_base') != null) {
            //ECHOSTING-73678
            oNvMileageHelp.attr('src','//img.echosting.cafe24.com/design/skin/default/product/txt_naver_on2.png');

            if (oNaverMileage.base > 0) {
                var iTotalNaverMileageRate = oNaverMileage.base + oNaverMileage.add;
                oNvSaveRateBase.html(iTotalNaverMileageRate + '%');
            } else {
                oNvSaveRateBase.html(oNaverMileage.def + '%');
            }
        } else {
            var iSaveRateSum = oNaverMileage.base;
            if (oNaverMileage.add > 0) {
                iSaveRateSum += oNaverMileage.add;
            }
            $('#divNvDefaultGuide .naver_mileage_save_rate_sum').html(castDataType(iSaveRateSum));
            $('#either_divNvDefaultGuide .naver_mileage_save_rate_sum').html(castDataType(iSaveRateSum));
        }
        // 모바일 > 주문서 작성 페이지인 경우에만 실행(마일리지 모바일버전은 ui노출부분이 다르다.)
        if (isMobile) {
            initNavermileageWithWcs();

            if ($('#frm_order_act').length > 0) {//주문서
                var bUseSelectMileage = isApplyDesignNMCanUseWithMileage();
            }

            if (bInflowParam != false) {
                if ($('.xans-product-detail').length > 0 || $('.xans-product-detaildesign').length > 0) { //상품상세
                    var sOnImg = '<img src="//img.echosting.cafe24.com/design/skin/mobile/txt_naver_on1.png" style="width:28px;margin-bottom:-1px;">';
                    $('.naver_mileage_save_rate_add').html('적립 ' + sOnImg);
                    $('.naverMileageSaveText').hide();
                } else {//주문서
                    $('#naverMileageTitle').append(' <img src="//img.echosting.cafe24.com/design/skin/default/product/txt_naver_on1.png" style="margin-bottom:-1px">');

                    if (bUseSelectMileage) {//택1
                        $('#navermileage_use_container').find('label > span').append(' <img src="//img.echosting.cafe24.com/design/skin/default/product/txt_naver_on1.png" style="margin-bottom:-1px">');
                    }
                }
            } else {
                if ($('#frm_order_act').length > 0) {//주문서
                    $('#np_use0').hide();
                    $('#naverMileageTitle').append(' <img src="//img.echosting.cafe24.com/design/skin/default/product/txt_naver_off1.png">');
                    $('#_mileage_acc').html('네이버 통해 방문 시 적립/사용 가능 ');

                    if (bUseSelectMileage) {//택1
                        $('#navermileage_use_container').find('label > span').append(' <img src="//img.echosting.cafe24.com/design/skin/default/product/txt_naver_off1.png" style="margin-bottom:-1px">');
                        $('#_mile_acc_rate').parent().hide();
                        $('#navermileage_use_container').find('.either_navermileage_use_container').append('네이버 통해 방문 시 적립/사용 가능');
                    }

                } else{//상품상세
                    $('.naver_mileage_save_rate_base').hide();
                    var sOffImg = '<img src="//img.echosting.cafe24.com/design/skin/mobile/txt_naver_off1.png" style="width:28px;margin-bottom:-1px;">';
                    $('.naver_mileage_save_rate_add').html(sOffImg+ ' (네이버 통해 방문 시 적립/사용 가능) ');
                    $('.naverMileageSaveText').hide();
                }
            }
        }

    } catch (e) {}
});

var naver_reqTxId;
var bNvOn = false;
var NaverMileage = {
    onNvPointLayer:function(dMode)
    {
        bNvOn = true;
        var obj = document.getElementById('divNvPointInfo');
        $('#divNvPointInfo').show();

        var leftMargine = obj.offsetWidth;
        if (dMode == 1) {
            var XY = $('#imgNaverMileageHelp').position();

            obj.style.top = XY.top+14+'px';
            obj.style.left = XY.left-150+'px';

            if (obj.attachEvent) {
                obj.attachEvent('onmouseover', NaverMileage.setNvOn);
            } else {
                obj.addEventListener('mouseover', NaverMileage.setNvOn, false);
            }
        }
        return true;
    },
    setNvOn:function() {
        bNvOn = true;
    },
    offNvPointLayerTic:function(bIntval)
    {
        bNvOn = false;
        if (bIntval == true) {
            setTimeout("NaverMileage.offNvPointLayer()", 200);
        } else {
            NaverMileage.offNvPointLayer();
        }
    },
    offNvPointLayer:function()
    {
        if (bNvOn == false) $('#divNvPointInfo').hide();
    },

    openMileageIntroPopup : function(sUrl)
    {
        var iWidth = 404;
        var iHeight = 412;
        var iLeft = (screen.width - iWidth) / 2;
        var iTop = (screen.height  - iHeight) / 2;
        var sOpt = 'width='+iWidth+', height='+iHeight+', left='+iLeft+', top='+iTop+', status=no, resizable=no';

        window.open(sUrl, 'mileageIntroPopup', sOpt);
    }
};


function showNaverCashShowAccumPopup()
{
    if (isNMCanUseWithMileage() == false && isApplyDesignNMCanUseWithMileage() == false) {
        var oInputMile = getInputMileObject();
        if (parseInt(oInputMile.val()) > 0) {
            alert(__('네이버마일리지는 적립금과 동시사용할 수 없습니다.'));
            return false;
        }
    }

    if (document.getElementById('np_use0').checked == false) {
        alert(__('네이버 마일리지 사용/적립 시에는 좌측의 체크박스를 선택하셔야 합니다.'));
        return false;
    }
    var sUrl = "https://service.mileage.naver.com/service/accumulation/"+$('#np_api_id').val()+"?doneUrl="+$('#np_done_url').val();

    var sUrl = "https://service.mileage.naver.com/service/v2/accumulation/"+$('#np_api_id').val()+"?doneUrl="+$('#np_done_url').val();
    if (typeof(sIsNaverMileageSandbox) != 'undefined') {
        if (sIsNaverMileageSandbox == 'T') {
            var sUrl = "https://sandbox-service.mileage.naver.com/service/v2/accumulation/"+$('#np_api_id').val()+"?doneUrl="+$('#np_done_url').val();
        }
    }

    if (naver_reqTxId) {
        sUrl = sUrl + "&reqTxId=" + naver_reqTxId;
    }

    var sNcisy = new String();
    if (typeof(wcs) == 'object') {
        var inflowParam = wcs.getMileageInfo();
        if (inflowParam != false) {
            sNcisy = inflowParam;
        }
    } else {
        sNcisy = $('#np_ncisy').val();
    }

    sUrl = sUrl + "&Ncisy=" + sNcisy;
    sUrl = sUrl + "&sig=" + $('#np_req_sig').val();
    sUrl = sUrl + "&timestamp=" + $('#np_timestamp').val();

    try {
        if (typeof($('#r_total_price').val()) != 'undefined') {
            var iMaxUseAmount = SHOP_PRICE.toShopPrice($('#r_total_price').val());
            sUrl = sUrl + "&maxUseAmount=" + iMaxUseAmount;
        }
    } catch (e) {}

    var sWinName = document.getElementById('np_window_name').value;
    window.open(sUrl , sWinName, "width=496,height=434,status=no,resizable=no");
}

function enableNaverCashPanel(baseAccumRate, addAccumRate, useAmount, balanceAmount, reqTxId, sig, resultCode, mileageUseAmount, cashUseAmount, totalUseAmount)
{
    naver_reqTxId = reqTxId;

    if (SHOP_PRICE.toShopPrice(stringReplace(',','',$('#total_price').val())) + parseInt($('#np_use_amt').val()) < parseInt(totalUseAmount)) {
        alert(__('결제하셔야 할 금액보다 사용금액이 큽니다. 다시 사용금액을 입력해주세요'));
        return false;
    }

    if ($('#np_req_tx_id').val() != null && reqTxId != '' && reqTxId != 0 && resultCode == 'E1000') {
        $('#np_req_tx_id').val(reqTxId);
        $('#np_save_rate').val(baseAccumRate);
        $('#np_save_rate_add').val(addAccumRate);
        $('#np_use_amt').val(useAmount);
        $('#np_mileage_use_amount').val(mileageUseAmount);
        $('#np_cash_use_amount').val(cashUseAmount);
        $('#np_total_use_amount').val(totalUseAmount);
        $('#np_use_amt').val(useAmount);
        $('#np_balance_amt').val(balanceAmount);
        $('#np_sig').val(sig);
        if ($('#np_use0').attr('checked') == true) {
            $('#np_use').val('T');
        } else {
            $('#np_use').val('');
        }
    } else {
        initNaverMileage();
    }

    $('#imgNaverMileageHelp').show();

    // PC쇼핑몰인경우만 ui에 사용 마일리지&캐쉬 정보 적용
    if (isMobile == false) {
        setNaverPoint();
    }
}


function setNaverPoint()
{
    try {

        var bUseNaverMileage = false;
        if (isApplyDesignNMCanUseWithMileage()) {
            if ($('#either_mileage_navermileage_select1').attr('checked') == true) {
                bUseNaverMileage = true;
            }
        } else {
            if ($('#np_use0').attr('checked') == true) {
                bUseNaverMileage = true;
            }
        }

        if (bUseNaverMileage == false) {
            initNaverMileage();
        }

        var sNpReqTxId = document.getElementById('np_req_tx_id').value;
        var iNpUseAmt = SHOP_PRICE.toShopPrice(document.getElementById('np_use_amt').value);
        var iNpMileageUseAmt = SHOP_PRICE.toShopPrice(document.getElementById('np_mileage_use_amount').value);
        var iNpCashUseAmt = SHOP_PRICE.toShopPrice(document.getElementById('np_cash_use_amount').value);
        var iNpTotalUseAmt = SHOP_PRICE.toShopPrice(document.getElementById('np_total_use_amount').value);
        var iNpBalanceAmt = SHOP_PRICE.toShopPrice(document.getElementById('np_balance_amt').value);
        var iNpSaveRate = parseFloat(document.getElementById('np_save_rate').value);
        var iNpSaveRateAdd = parseFloat(document.getElementById('np_save_rate_add').value);
        var iNpSaveRateTotal = iNpSaveRate + iNpSaveRateAdd;

        if (isNMCanUseWithMileage() == false && isApplyDesignNMCanUseWithMileage() == true) {
            var elmNvDefaultGuide = document.getElementById('either_divNvDefaultGuide');
            var oDivNvPointUse    = document.getElementById('either_divNvPointUse');
            var oDivNvPointSave   = document.getElementById('either_divNvPointSave');
            var oDivNvPointOpr    = document.getElementById('either_divNvPointOpr');
            var oDivNvPointBtnAdd = document.getElementById('either_divNvPointBtnAdd');
            var oDivNvPointBtnMod = document.getElementById('either_divNvPointBtnMod');
            var oTxtNpUse         = document.getElementById('either_txt_np_use');
            var oTxtNpSave        = document.getElementById('either_txt_np_save');
            var oExTxNpSave       = document.getElementById('either_ex_tx_np_save');
            var oExTxNpUse        = document.getElementById('either_ex_tx_np_use');

            var bInflowParam = wcs.getMileageInfo();

        } else {
            var elmNvDefaultGuide = document.getElementById('divNvDefaultGuide');
            var oDivNvPointUse    = document.getElementById('divNvPointUse');
            var oDivNvPointSave   = document.getElementById('divNvPointSave');
            var oDivNvPointOpr    = document.getElementById('divNvPointOpr');
            var oDivNvPointBtnAdd = document.getElementById('divNvPointBtnAdd');
            var oDivNvPointBtnMod = document.getElementById('divNvPointBtnMod');
            var oTxtNpUse         = document.getElementById('txt_np_use');
            var oTxtNpSave        = document.getElementById('txt_np_save');
            var oExTxNpSave       = document.getElementById('ex_tx_np_save');
            var oExTxNpUse        = document.getElementById('ex_tx_np_use');
        }


        if (isUseNaverMileage() == false) {
            elmNvDefaultGuide.style.display = '';
        }

        oDivNvPointUse.style.display = 'none';
        oDivNvPointSave.style.display = 'none';
        oDivNvPointOpr.style.display = 'none';
        oDivNvPointBtnAdd.style.display = 'none';
        oDivNvPointBtnMod.style.display = 'none';

        if (iNpTotalUseAmt > 0 && iNpSaveRate > 0) {//& opr
            oDivNvPointOpr.style.display = 'inline';
        }
        if (iNpTotalUseAmt > 0 || iNpSaveRateTotal > 0) {
            oDivNvPointBtnMod.style.display = 'inline';
        } else {
            oDivNvPointBtnAdd.style.display = 'inline';
        }
        if (iNpSaveRateTotal > 0) {//적립
            if (elmNvDefaultGuide) {
                elmNvDefaultGuide.style.display = 'none';
            }

            oDivNvPointSave.style.display = 'inline';
            oTxtNpSave.innerHTML = oExTxNpSave.innerHTML.replace("[np_rate]", iNpSaveRateTotal);
        }

        set_total_price();

        if (iNpTotalUseAmt > 0) {
            if (elmNvDefaultGuide) {
                elmNvDefaultGuide.style.display = 'none';
            }

            oDivNvPointUse.style.display = 'inline';
            var sTmp = oExTxNpUse.innerHTML;

            var aUseNaverValue = new Array();
            if (iNpMileageUseAmt > 0) {
                aUseNaverValue.push('마일리지 ' + addCommas(iNpMileageUseAmt) + '원');
            }
            if (iNpCashUseAmt > 0) {
                aUseNaverValue.push('캐쉬 ' + addCommas(iNpCashUseAmt) + '원');
            }

            oTxtNpUse.innerHTML = aUseNaverValue.join(' + ') + ' 사용';
        }

        paymethod_display($(':input:radio[name="addr_paymethod"]:checked').val());

    } catch (e) {
        initNaverMileage();
        set_total_price();
    }

}


/**
 * 네이버 마일리지/캐쉬 reset
 * @return void
 */
function resetNaverPoint()
{
    try {
        $('#np_use0').attr('checked',false);
        setNaverPoint();
        $('#np_use0').attr('checked',true);
        paymethod_display($(':input:radio[name="addr_paymethod"]:checked').val());
    } catch (e) {}
}


/**
 * 네이버 마일리지/캐쉬 사용안함
 * @return void
 */
function initNaverMileage()
{
    // clear value
    try {
        document.getElementById('np_req_tx_id').value          = "";
        document.getElementById('np_use_amt').value            = 0;
        document.getElementById('np_mileage_use_amount').value = 0;
        document.getElementById('np_cash_use_amount').value    = 0;
        document.getElementById('np_total_use_amount').value   = 0;
        document.getElementById('np_balance_amt').value        = 0;
        document.getElementById('np_save_rate').value          = 0;
        document.getElementById('np_save_rate_add').value      = 0;
        document.getElementById('np_sig').value                = "";
    } catch (e) {}

    // init design
    try {
        if (isNMCanUseWithMileage() == false && isApplyDesignNMCanUseWithMileage() == true) {
            var oDivNvPointUse    = document.getElementById('either_divNvPointUse');
            var oDivNvPointSave   = document.getElementById('either_divNvPointSave');
            var oDivNvPointOpr    = document.getElementById('either_divNvPointOpr');
            var oDivNvPointBtnAdd = document.getElementById('either_divNvPointBtnAdd');
            var oDivNvPointBtnMod = document.getElementById('either_divNvPointBtnMod');
        } else {
            var oDivNvPointUse    = document.getElementById('divNvPointUse');
            var oDivNvPointSave   = document.getElementById('divNvPointSave');
            var oDivNvPointOpr    = document.getElementById('divNvPointOpr');
            var oDivNvPointBtnAdd = document.getElementById('divNvPointBtnAdd');
            var oDivNvPointBtnMod = document.getElementById('divNvPointBtnMod');
        }
        oDivNvPointUse.style.display    = 'none';
        oDivNvPointSave.style.display   = 'none';
        oDivNvPointOpr.style.display    = 'none';
        oDivNvPointBtnAdd.style.display = 'inline';
        oDivNvPointBtnMod.style.display = 'none';
    } catch (e) {}

    //  clear trasaction id
    try {
        naver_reqTxId = '';
    } catch (e) {}
}


/**
 * 네이버 마일리지/캐쉬 사용 여부
 * @return boolean
 */
function isUseNaverMileage()
{
    var bIsUse = false;
    try {
        if ($('#np_req_tx_id').val() != '' || $('#np_save_rate').val() > 0) {
            bIsUse = true;
        }
    } catch (e) {}
    return bIsUse;
}

/**
 * 자료형 cast
 * @param float fData 숫자
 * @return mixed
 */
function castDataType(fData)
{
    if (isNaN(fData) == false) {
        if ((fData % 1) == 0) {
            return parseInt(fData);
        } else {
            return parseFloat(fData);
        }
    } else {
        return 0;
    }
}


/**
 * 모바일 마일리지 Library 초기화
 */
function initNavermileageWithWcs()
{
    try {
        // 네이버마일리지 관련 변수가 controller에서 assign이 안되어 있으면 아래부분 실행시도를 안한다.
        if (typeof(nbp) == 'object') {

            var iMaxuseAmount = parseInt($('#total_price').val().replace(/,/g, ''));
            var iBaseAccumRate = parseFloat($('#np_save_rate_default').val());
            var iTimestamp = parseInt($('#np_timestamp').val());
            var sId = '_mileage_acc';
            if (isNMCanUseWithMileage() == false && isApplyDesignNMCanUseWithMileage() == true) {
                sId = '_either_mileage_acc';
            }

            var bResult = nbp.mileage.initWithWcs({
                'sId': sId,
                'sApiId': $('#np_api_id').val(),
                'sDoneUrl': decodeURIComponent($('#np_done_url').val()),
                'nMaxUseAmount': iMaxuseAmount,
                'sSig': $('#np_req_sig').val(),
                'nTimestamp': iTimestamp,
                'nBaseAccumRate': iBaseAccumRate,
                'bActive' : true,
                'event' : {
                    'beforeAccum' : function(oEvent) { //적립/사용페이지가 뜨기 직전 호출된다.
                        set_total_price();
                        nbp.mileage.setMaxUseAmount(getNavermileageMaxAmount());
                        if (oEvent.bActive === false) { //마일리지 모듈이 비활성화 상태에서 적립/사용 버튼 클릭 callback 구현
                            alert('네이버 마일리지를 사용/적립하려면, 먼저 \'네이버 마일리지\'를 선택해야합니다. ');
                            return false;
                        }
                    },
                    'accum' : function(aRetVal) {
                        aRetVal.resultCode = convertResultCode(aRetVal.resultCode);
                        enableNaverCashPanel(aRetVal.baseAccumRate, aRetVal.addAccumRate, aRetVal.mileageUseAmount, aRetVal.balanceAmount, aRetVal.reqTxId, aRetVal.sig, aRetVal.resultCode, aRetVal.mileageUseAmount, aRetVal.cashUseAmount, aRetVal.totalUseAmount);
                        set_total_price();
                    }
                }
            });

            if (bResult) {
                if (isNMCanUseWithMileage() == false && isApplyDesignNMCanUseWithMileage() == true) {
                    nbp.mileage.inactive();
                }
            } else {
                if ($('#np_is_use').val() == 'T' && document.getElementById('_mileage_acc') != null && document.getElementById('_mileage_acc') != undefined) {
                    alert('네이버마일리지 적립/사용 초기화가 정상적이지 않습니다. 지속발생시 운영자에게 문의 해주세요.');
                }
            }
        }
    } catch (e) {}
}

/**
 * pg모듈에서 리턴해주는 형식으로 변환
 * @param string sCode 코드
 * @return string
 */
function convertResultCode(sCode)
{
    if (sCode == 'OK') {
        return 'E1000';
    } else if (sCode == 'CANCEL') {
        return 'E1001';
    } else if (sCode == 'ERROR') {
        return 'E1002';
    } else {
        return 'E1100';
    }
}

/**
 *모바일 마일리지 최대사용가능 금액(결제금액 + 마일리지 사용금액)
 * @return int
 */
function getNavermileageMaxAmount()
{
    var iMaxAmount = SHOP_PRICE.toShopPrice($('#total_price').val().replace(/,/g, ''));
    iMaxAmount    += check_parseInt(getUseNaverMileageCash());

    return iMaxAmount;
}

var BigDataLog = {
        '_elementId'  : 'bigdata_log',
        '_cookieName' : 'bigdata_log',

        'getcookie' : function(name) {
            if (!document.cookie) return null;

            name = name || this._cookieName;
            var val = null;
            var arr = document.cookie.split((escape(name)+'='));
            if (arr.length >= 2) {
                var arrSub = arr[1].split(';');
                val = unescape(arrSub[0]);
            }

            return val;
        },

        'delcookie' : function(name) {
            name = name || this._cookieName;
            var sCookie  = escape(name) + '=; ';
                sCookie += 'expires='+ (new Date(1)).toGMTString() +'; ';
                sCookie += 'path=/; ';
                sCookie += 'domain='+ document.domain.replace(/^(www|m)\./i, '') +'; ';
            document.cookie = sCookie;
        },

        '_script' : function(src) {
            var node = document.createElement('script');
            node.setAttribute('type', 'text/javascript');
            node.setAttribute('id', this._elementId);
            node.setAttribute('src', src);
            document.body.appendChild(node);
        },

        '_iframe' : function(src) {
            var node = document.createElement('iframe');
            node.setAttribute('id', this._elementId);
            node.setAttribute('src', src);
            node.style.display = 'none';
            node.style.width = '0';
            node.style.height = '0';
            document.body.appendChild(node);
        },

        'save' : function() {
            var src  = '/exec/front/External/Save'; // 환경에 맞게 변경하여 사용
                src += '?referer='+encodeURIComponent(document.referrer);
                src += '&href='+encodeURIComponent(location.href);

            this._script(src);
            //this._iframe(src);
         }
};
if (BigDataLog.getcookie()) {
    BigDataLog.delcookie();
} else {
    if (window.attachEvent) window.attachEvent('onload', function(){BigDataLog.save();});
    else                    window.addEventListener('load', function(){BigDataLog.save();}, false);
}
var COLORCHIP_FRONT = {
    setFrontInit : function()
    {
        $('.xans-product-colorchip').find('.chips').each(function() {

            var sColor = COLORCHIP_FRONT.RGB2Color($(this).css('backgroundColor'));
            var sCursor = '';
            if (COLORCHIP_FRONT.checkValidation(sColor) === true && aOptionColorchip[sColor] != '') {
                if (EC_SHOP_FRONT_NEW_OPTION_EXTRA_IMAGE.isDisplayImageDesign() === false) {
                    return;
                }
                sCursor = 'pointer';
                $(this).bind('mouseover click', function() {
                    EC_SHOP_FRONT_NEW_OPTION_EXTRA_IMAGE.setImage(aOptionColorchip[sColor], true);
                });
            }
            $(this).css('cursor', sCursor);
        });
    },

    RGB2Color : function (sRgb)
    {
        try {
            rgb = sRgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            if (rgb === null) {
                return sRgb.toString().toUpperCase();
            } else {
                return '#' + COLORCHIP_FRONT.byte2Hex(rgb[1]) + COLORCHIP_FRONT.byte2Hex(rgb[2]) + COLORCHIP_FRONT.byte2Hex(rgb[3]);
            }
        } catch (e) {
            return '';
        }
    },

    byte2Hex : function (n)
    {
        var nybHexString = "0123456789ABCDEF";
        return String(nybHexString.substr((n >> 4) & 0x0F,1)) + nybHexString.substr(n & 0x0F,1);
    },

    checkValidation : function(sColor)
    {
        var regex = /^#?[0-9A-F]{6}$/i;
        return regex.test(sColor);
    }
}

$(document).ready(function() {
    COLORCHIP_FRONT.setFrontInit();
});

$(document).ready(function()
{
    // 썸네일 이미지에 대한 마우스 오버 액션 (sUseAddimageAction: 추가 이미지 액션)
    $('.ThumbImage').mouseover(function() {
        if (ImageAction.sUseAddimageAction === 'O') {
            ImageAction.setThumbImageAction($(this));
        }
    });

    // 썸네일 이미지에 대한 마우스 클릭 액션 (sUseAddimageAction: 추가 이미지 액션)
    $('.ThumbImage').click(function() {
        if (ImageAction.sUseAddimageAction === 'C') {
            ImageAction.setThumbImageAction($(this));
        }
    });

    ImagePreview.eBigImgSrc = $('.BigImage').attr('src');

    var bPreview = ($.data(document,'Preview') == 'T') ? true : false;

    // 제일 처음 로딩시 이미지값 저장해놓음..뉴상품에서는 small == big 이지만 구상품 스킨에서는
   // tiny와 big의 이미지명 틀림!!
    ImagePreview.eBigImgSrc = $('.BigImage').attr('src');

    if (bPreview === true) {
        ImagePreview.Init();
    }
});

var ImageAction = {
    // 확대 이미지
    sBigSrc: $('.BigImage').attr('src'),

    // 추가 이미지 액션 (기본값 - O: 마우스 오버)
    sUseAddimageAction: 'O',

    // 썸네일 마우스 액션 (마우스 오버 및 클릭에 대한 중복으로 인해 분기)
    setThumbImageAction: function(target)
    {
        $('#prdDetailImg').attr('rel', $(this).parent().index());

        var sSrc = target.attr('src');

        if (sSrc.indexOf('/product/tiny/') > 0) {
            if (sSrc.substring(sSrc.lastIndexOf('/')) === this.sBigSrc.substring(this.sBigSrc.lastIndexOf('/'))) {
                sSrc = sSrc.replace('/product/tiny/', '/product/big/');
            } else {
                sSrc = ImagePreview.eBigImgSrc;
            }

            $('.BigImage').attr('src', sSrc);

            // 일단 복잡한 과정은 제외하고 파일 교체만 처리
        } else if (sSrc.indexOf('/product/small/') > 0) {
            if (sSrc.substring(sSrc.lastIndexOf('/')) === this.sBigSrc.substring(this.sBigSrc.lastIndexOf('/'))) {
                sSrc = sSrc.replace('/product/small/', '/product/big/');
            } else {
                sSrc = ImagePreview.eBigImgSrc;
            }

            $('.BigImage').attr('src', sSrc);
        } else if (sSrc.indexOf('/thumb/') > 0) {
            $('.BigImage').attr('src', ImagePreview.eBigImgSrc);
        } else {
            // 추가 이미지
            sSrc = sSrc.replace('/product/extra/small/', '/product/extra/big/');

            $('.BigImage').attr('src', sSrc);

            // 단일 선택형 + 추가 이미지 액션이 C(마우스 클릭)인 경우 추가 이미지에 선택에 대한 품목 선택 처리
            if (oSingleSelection.isItemSelectionTypeS() === true && this.sUseAddimageAction === 'C') {
                // 품목 코드가 있을 경우 해당되는 UI 선택
                if (target.attr('item_code') !== '') {
                    EC_SHOP_FRONT_NEW_OPTION_COMMON.setValueByAddImage(target.attr('item_code'));
                }
            }
        }
    }
};

var ImagePreview =
{
    bNewProduct : false,
    eTarget : null,
    eBigImgSrc : null,
    Init : function()
    {
        this.eTarget = $('.xans-product-image img.BigImage');
        this.eTarget.parent().addClass('cloud-zoom');
        this.showNotice();
        ImagePreview.setZoom();

    },
    showNotice : function()
    {
        var sLang = SHOP.getLanguage();
        if (sLang == 'ja_JP') {
            var iImgWidth = 107;
        } else {
            var iImgWidth = 85;
        }

        var sZoomImage = '//img.echosting.cafe24.com/design/skin/admin/'+sLang+'/txt_product_zoom.gif';

        var sLeft = this.eTarget.width() / 2 - iImgWidth;
        $('<div id="zoomNotice"><img src="'+sZoomImage+'"></div>').css(
            {
                'height' : '0px',
                'position' : 'relative',
                'opacity' : '0.75',
                'KHTMLOpacity' : '0.75',
                'MozOpacity' : '0.75',
                'filter' : 'Alpha(opacity=75)',
                'top' : '-27px',
                'margin-left' : sLeft
            }).appendTo(this.eTarget.parent());
    },
    setZoom : function()
    {
        $('.cloud-zoom').mouseover(function()
        {
            $('.cloud-zoom').CloudZoom();
        });
    },
    //ECHOSTING-236342 preview(확대보기) 기능에서 상세페이지 연결 오류
    setIframeSrcReplaceProductNo : function(iProductNo)
    {
        if (typeof(iProductNo) === 'undefined' || iProductNo == 0) {
            return;
        }

        var oTargetIframe = $(parent.document).find('#modalContent');

        if (typeof($(oTargetIframe).attr('src')) === 'undefined') {
            return;
        }

        // 목록에서의 상품 확대 보기시 상위 iframe src의 파라미터 product_no 를 다음,이전 화면 이동시 해당 상품번호 받아와 변환
        var sUrlReplaceProductNo = $(oTargetIframe).attr('src').replace(/product_no=[\d]+/,'product_no=' + iProductNo);

        $(oTargetIframe).attr('src', sUrlReplaceProductNo);
    },
    viewProductBtnClick : function(sActionType)
    {
        if (typeof(iProductNo) === 'undefined' || $.inArray(sActionType, ['next', 'prev']) < 0) {
            return;
        }

        this.bNewProduct = true;
        var sParamUrl = ImagePreview.getViewProductUrl(iProductNo);
        var aMatchResult = ImagePreview.getLocationPathMatchResult();
        var sRefDoc = (aMatchResult !== null) ? 'product' : location.pathname;

        $.ajax({
            url : '/exec/front/Product/Detailnavi'+ sParamUrl + '&refdoc='+ sRefDoc +'&navi_action='+ sActionType,
            type : 'GET',
            async : false,
            dataType : 'json',
            success : function(data) {
                if (data.result === true) {
                    location.href = ImagePreview.getViewProductUrl(data.response.product_no, data.response.seo_url_link);
                } else {
                    if (data.response.empty_msg !== null) {
                        alert(data.response.empty_msg);
                    }
                }
            }
        });
    },
    getLocationPathMatchResult : function()
    {
        var sPath = document.location.pathname;
        var sPattern = /^\/product\/(.+)\/([0-9]+)(\/.*)/;
        return sPath.match(sPattern);
    },
    getViewProductUrl : function(iProductNo, sSeoUrl)
    {
        var aMatchResult = ImagePreview.getLocationPathMatchResult();
        var bExistSeoUrl = (sSeoUrl !== '' && typeof(sSeoUrl) !== 'undefined') ? true : false;
        var sResultUrl = '';

        ImagePreview.setIframeSrcReplaceProductNo(iProductNo);

        if (aMatchResult !== null) {
            if (bExistSeoUrl === true) {
                sResultUrl = sSeoUrl;
            } else {
                sResultUrl = (this.bNewProduct === false) ? ImagePreview.getOldProductDetailUrl(iProductNo) : '?product_no=' + iProductNo + '&cate_no='+ iCategoryNo + '&display_group=' + iDisplayGroup;
            }
        } else {
            var sSearchRelplace = location.search.replace(/product_no=[\d]+/,'product_no=' + iProductNo);
            sResultUrl = (this.bNewProduct === true) ? sSearchRelplace : location.pathname + sSearchRelplace;
        }

        return sResultUrl;
    },
    getOldProductDetailUrl : function(iProductNo)
    {
        var sSearchString = '';

        if (location.search) {
            sSearchString = '&' + location.search.replace(/\?/,'');
        }

        return '/front/php/product.php?product_no=' + iProductNo + sSearchString;
    }
}

// 이전, 다음 상품 보기
function viewProduct(iProductNo, sSeoUrl)
{
    location.href = ImagePreview.getViewProductUrl(iProductNo, sSeoUrl);
}


// 팝업
function product_popup(sLink, sName, sOption, ele)
{
    var aMatchResult = ImagePreview.getLocationPathMatchResult();
    var sSearchQuery = location.search;

    if (aMatchResult) {
        if (sSearchQuery) {
            sSearchQuery = sSearchQuery + '&product_no=' + aMatchResult[2];
        } else {
            sSearchQuery = '?product_no=' + aMatchResult[2];
        }
    }

    try {
        var sDetailUri = '';
        if (ele) {
            var iOrder = $(ele).attr('rel');
            if (window.location.href.indexOf('/surl/P/') != -1) {
                sDetailUri = '?product_no=' + parseInt(window.location.href.split('/surl/P/')[1]) + '&order=' + iOrder;
            } else {
                sDetailUri = sSearchQuery + '&order=' + iOrder;
            }
        }
        window.open('/' + sLink + sDetailUri, sName, sOption);
    } catch (e) {
        window.open('/' + sLink + sSearchQuery, sName, sOption);
    }
}

var STOCKLAYER = (function() {

    var sUrl = '/product/stocklayer.html';

    //세트 상품 여부
    function isSetProdct()
    {
        if (typeof(set_option_data) === 'undefined') {
            return false;
        }

        return true;
    }

    //모든 재고 레이어 Element Get
    function getAllStockLayer()
    {
        return $('.ec-shop-detail-stock-layer');
    }

    return {
        init : function() {
            $('.EC-stockdesign').live('click', function (e) {
                e.preventDefault();
                var iProductNo = $(this).attr('product_no');
                var sPageType = $(this).attr('page_type');
                STOCKLAYER.closeStockLayer();

                if ($(this).parent().find('.ec-shop-detail-stock-layer').length == 0) {
                    var oParam = {};

                    oParam['product_no'] = iProductNo;
                    oParam['page_type'] = sPageType;


                    if (sPageType === 'detail') {
                        if (isSetProdct() === true) {
                            oParam['stockData']  = $.parseJSON(set_option_data);
                            oParam['is_set_product'] = 'T';
                        } else {
                            oParam['stockData'] = $.parseJSON(option_stock_data);
                            oParam['is_set_product'] = 'F';
                        }
                    }
                    var oHtml = $('<div>');
                    oHtml.addClass('ec-shop-detail-stock-layer');
                    $(this).parent().append(oHtml);
                    $.ajax ({
                        type : 'POST',
                        url : sUrl,
                        data : oParam,
                        success : function(sHtml) {
                            sHtml = sHtml.replace(/[<]script( [^ ]+)? src=\"[^>]*>([\s\S]*?)[<]\/script>/g, "");
                            oHtml.html(sHtml);
                        },
                        error : function(e) {
                            __('오류발생');
                        }
                    });
                } else {
                    $(this).parent().find('.ec-shop-detail-stock-layer').show();
                }

                e.preventDefault();
            });
        },

        closeStockLayer : function() {
            var $oAllStockLayer = getAllStockLayer();
            $oAllStockLayer.hide();
        }
    }
})();

$(document).ready ( function() {
    STOCKLAYER.init();
});

//상품 옵션 id
var product_option_id = 'product_option_id';
$(document).ready(function(){
    //ECHOSTING-77239 - 80113 : 배송준비중관리에서 특정된 두개의 기호가 포함된 옵션값만 깨져서 노출

    //표시된 옵션 선택박스에 대해 이벤트바인드 정리

    //추가입력 옵션 ; 제거 > ECHOSTING-77239건과 동일 이슈로 인해 역슬래시 기호 추가(ECHOSTING-182704)
    $('.input_addoption, .rel_input_addoption').blur(function(){
        var regex = /[\;\\]/g;
        if (regex.test($(this).val()) === true) {
            alert(__('특수문자는 입력할 수 없습니다.'));
            $(this).val($(this).val().replace(regex, ''));
        }
    });


    //추가옵션 글자수 체크
    $('.rel_input_addoption').live('keyup', function() {
        NEWPRD_ADD_OPTION.checkProductAddOptionWord(this);
    });
});

// 뉴상품에 뉴상품 스킨인지 확인하는 메소드 (뉴상품인데 구상품인 경우에는 false)
function isNewProductSkin()
{
    return $('#totalProducts').length > 0;
}

// 구스킨을 사용할경우 총 금액 계산
function setOldTotalPrice()
{

    if (product_price_content == true) {
        return ;
    }

    // 판매가 회원 공개인 경우 옵션 값 계산 필요없음!
    if (sIsDisplayNonmemberPrice === 'T') {
        $('#span_product_price_text').html(sNonmemberPrice);
        return ;
    }

    var iQuantity = 1;
    if (typeof($(quantity_id).val()) != 'undefined' ) {
        iQuantity = parseInt($(quantity_id).val(),10);
    }

    var iOptionPrice = 0;
    if (option_type === 'T') {
        iOptionPrice = SHOP_PRICE.toShopPrice(product_price);
    }
    var aStockData = new Array();
    if (typeof(option_stock_data) != 'undefined') {
        aStockData = $.parseJSON(option_stock_data);
    }

    // 복합형
    if (option_type == 'T') {
        // 일체선택형
        if (item_listing_type == 'S') {
            sOptionId = ITEM.getOldProductItemCode();
            if (sOptionId !== false) {
                iOptionPrice += (aStockData[sOptionId].option_price - product_price);
            }
        } else {
            $('select[id^="product_option_id"][value!="*"] option:selected').each(function() {
                var sOptionId = $(this).val();
                if (typeof(aStockData[sOptionId]) != 'undefined' && aStockData[sOptionId].stock_price != 0) {
                    iOptionPrice += (aStockData[sOptionId].option_price - product_price);
                }
            });
        }
    } else if (Olnk.isLinkageType(option_type) === true) { // 저장형
        var iPrdPrice = SHOP_PRICE.toShopPrice(product_price);
        var iOptPrice = 0;
        var sPrice = '';
        $('select[id^="product_option_id"]').each(function() {
            var iValNo = parseInt($(this).val());
            if (isNaN(iValNo) === true) {
                return;
            }

            iOptPrice += SHOP_PRICE.toShopPrice(aStockData[iValNo].stock_price);
        });

        iOptionPrice = iPrdPrice + iOptPrice;
    } else {
        // 단독형일때는 구상품과 다르게 품목단위로 계산이 필요함.
        $('select[id^="product_option_id"][value!="*"] option:selected').each(function() {
            var sOptionId = $(this).val();
            if (typeof(aStockData[sOptionId]) != 'undefined' && aStockData[sOptionId].stock_price != 0) {
                    iOptionPrice += aStockData[sOptionId].option_price;
            } else {
                iOptionPrice += aStockData[sOptionId].option_price;
            }
        });
    }
    if (option_type === 'F' && iOptionPrice === 0) {
        iOptionPrice = product_price;
    }


    iPrice = getProductPrice(iQuantity, iOptionPrice, null, null, function(iPrice){
        $('#span_product_price_text').html(SHOP_PRICE_FORMAT.toShopPrice(iPrice));
    });

}

/**
 * 뉴상품 프론트 옵션을 관리하는 객체
 * 앞으로 전역으로 함수를 선언하지 말고 여기에 선언
 */
var NEWPRD_OPTION = {
    DELIMITER_SEMICOLON:';',
    DELIMITER_SLASH:'/',
    iOptionBoxSequence : 0,
    /**
     * 셀렉트 엘리먼트의 첫번째 옵션으로 변경
     * @param oSelect object 셀렉트 엘리먼트 객체
     */
    resetSelectElement: function(oSelect) {
        if (typeof(oSelect) !== 'object' || typeof(oSelect.is) !== 'function' || oSelect.is('select') !== true) {
            return false;
        }

        if (this.setOlnkOptionReset(oSelect) !== false ) {
            EC_SHOP_FRONT_NEW_OPTION_COMMON.setValue(oSelect, '*');
        }
    },

    /**
     * 옵션 셀렉트박스의 첫번째/두번째 값인지
     * @param  sOptionValue 선택값
     */
    isOptionSelectTitleOrDivider: function(sOptionValue) {
        return ($.inArray(sOptionValue, ['*', '**']) !== -1) ? true : false;
    },

    setOlnkOptionReset: function(oSelect) {
        // option code가 있으면 연동형옵션
        // 만일을 대비해서 하단
        if (oSelect.attr('option_code') != undefined && oSelect.attr('option_code') !== '' ) {

            var aOptionIdArray = oSelect.attr('id').split('_');
            var iOptionLength = aOptionIdArray.length;
            var sOptionIdTxt = 'product_option_id';
            var iOptionNum = 0;
            var sOptionButtonIdTxt = 'option_push_button';

            if (iOptionLength === 3 ) { // product_option_idX
                iOptionNum = oSelect.attr('id').replace(sOptionIdTxt,'');
            } else if (iOptionLength === 5 ) { //addproduct_option_id_product_no_x
                sOptionIdTxt = 'addproduct_option_id_' + aOptionIdArray[3] + '_';
                iOptionNum = aOptionIdArray[4];
                sOptionButtonIdTxt = 'add_option_push_button_'+aOptionIdArray[3];
            }

            // 연동형 옵션의 버튼형인 경우 리셑 처리 없이 그냥 리턴
            if (Olnk.getOptionPushbutton($('#'+sOptionButtonIdTxt)) === true) {
                return false;
            }
        }
        return true;
    }
};

/**
 * 뉴상품 프론트 추가옵션을 관리하는 객체
 * 앞으로 전역으로 함수를 선언하지 말고 여기에 선언
 */
var NEWPRD_ADD_OPTION = {
    /**
     * 추가옵션 리스트 리턴 (필수, 선택모두)
     * @returns array 추가옵션 리스트
     */
    getCurrentAddOption: function() {
        var aAddOption = [];

        $(".input_addoption").not('[name^=addproduct_add_option_name_]').each(function(){
            aAddOption.push($(this).val());
        });

        return aAddOption;
    },

        /**
         * 현재 작성되어있는 추가옵션으로 품목에 표시할 타이틀 리턴
         * @param aAddOption array 추가옵션 리스트
         * @returns string 현재 작성된 추가옵션 타이틀
         */
    getCurrentAddOptionTitle: function(aAddOption) {
        var aAddOptionTitle = [];

        $.each(aAddOption, function(iIdx, sValue){

            if (!sValue) {
                return true;
            }

            var sOptionName = add_option_name[iIdx];
            if (sOptionName !== undefined) {
                var sAddOptionTitle = sOptionName+NEWPRD_OPTION.DELIMITER_SLASH+sValue;
                aAddOptionTitle.push(sAddOptionTitle);
            }

        });

        var delimeter = ', ';
        return (aAddOptionTitle.length > 0) ? aAddOptionTitle.join(delimeter)+delimeter : '';
    },

    /**
     * 셀렉트 엘리먼트의 첫번째 옵션으로 변경
     * @param oSelect object 셀렉트 엘리먼트 객체
     */
    resetSelectElement: function(oSelect) {
        return NEWPRD_OPTION.resetSelectElement(oSelect);
    },

    /**
     * 품목별 추가옵션 처리를위한 모든 추가옵션항목을 폼에 셋팅
     */
    setItemAddOptionName: function(frm) {
        if (!add_option_name) {
            return;
        }

        frm.append(getInputHidden('item_add_option_name', add_option_name.join(NEWPRD_OPTION.DELIMITER_SEMICOLON)));
    },

    /**
     * 품목별 추가옵션을 셋팅
     * @param sItemCode string 품목코드
     * @param sItemAddOption string 품목별 추가옵션 입력값
     */
    setItemAddOption: function(sItemCode, sItemAddOption, frm) {

        if (!add_option_name || !sItemAddOption) {
            return;
        }

        var aAddOption = sItemAddOption.split(NEWPRD_OPTION.DELIMITER_SEMICOLON);
        var iLength = aAddOption.length;

        if (iLength < 1) {
            return;
        }

        for (var iIdx=0; iIdx<iLength; iIdx++) {
            frm.prepend(getInputHidden('item_option_add['+sItemCode+']['+iIdx+']', aAddOption[iIdx]));
        }
    },

    /**
     * 품목기반의 추가옵션타입을 사용해야하는지
     * @returns bool 품목기반의 추가옵션이면 true 아니면 false
     */
    isItemBasedAddOptionType: function() {
        // 옵션이 없을때
        if (has_option !== 'T') {
            return false;
        }

        // 뉴스킨이 아닐때
        if (isNewProductSkin() !== true) {
            return false;
        }

        // 연동형 옵션일때 (전역:sOptionType)
        if (Olnk.isLinkageType(sOptionType) === true) {
            return false;
        }

        return true;
    },

    isValidAddOptionSelect : function(frm, bIsSetProduct) {
        var bReturn = true;
        var iCount = 0;
        var sMsg = '';
        var oObject = null;

        $('input[class^="option_add_box_"][name="basket_add_product[]"]').each(function() {
            var sAddOptionId = $(this).attr('id').replace('_id','');
            var iAddProductNo = parseInt($(this).attr('class').substr($(this).attr('class').lastIndexOf('_')+1));
            var iQuantity = $('#'+sAddOptionId+'_quantity').val();
            var sItemCode = $(this).val();
            $('select[name="addproduct_option_name_'+iAddProductNo+'"][required="true"]:visible').each(function() {
                if ($(this).val() == '*' || $(this).val() == '**') {
                    sMsg = __('필수 옵션을 선택해주세요.');
                    oObject = $(this);
                    bReturn = false;
                    return false;
                }
            });
            if (bReturn === false) {
                return false;
            }

            frm.append(getInputHidden('selected_add_item[]', iQuantity+'||'+sItemCode));

            if (bIsSetProduct === true) {
                bResult = ProductSetAction.checkAddProductAddOption('addproduct_add_option_id_'+iAddProductNo);
            } else {
                bResult = checkAddOption('addproduct_add_option_id_'+iAddProductNo);
            }
            if (bReturn === false) {
                return false;
            }
            iCount++;
        });

        return {'result' : bReturn, 'count' : iCount, 'message' : sMsg, 'object' : oObject};
    },

    isValidRelationProductSelect : function(frm, oObj, bIsMainProductCheck) {
        var bReturn = true;
        var iCount = 0;
        var sMsg = '';
        var oObject = null;
        var sFailType = '';

        $('input[name="basket_info[]"]:checked').each(function() {
            var iRelationProductNum = $(this).val().substr(0, $(this).val().indexOf('|'));
            var eQuantity = $('#quantity_' + iRelationProductNum);
            var eOption = $('select[name="option_' + iRelationProductNum + '[]"]');

            var aValue = $(this).val().split('|');
            var sOptionType = aValue[6]; // appShopUtilNewProductFetchRelation::getCheckboxForm참조
            var sIsAddOptionName = aValue[8]; //관련상품 추가옵션 여부
            var sRelationProductName = decodeURIComponent(aValue[4]); //관련상품명
            var sIsProductPriceContent = aValue[9]; //관련상품 판매가 대체문구
            var user_option_id = 'user_option_'; //관련상품 추가옵션 id

            if (sIsProductPriceContent === 'T') {
                sMsg = sprintf(__('%s 상품은 구매할 수 있는 상품이 아닙니다.'), sRelationProductName);
                NEWPRD_ADD_OPTION.checkVaildRelationProductObject(oObj, sMsg, bIsMainProductCheck, this);
                sFailType = 'bProductPriceContent';
                oObject = $(this);
                iCount++;
                bReturn = false;
                return false;
            }

            if (NEWPRD_ADD_OPTION.checkVaildRelationProductQuantity(iRelationProductNum, this) === false) {
                sFailType = 'bRelationQuantity';
                oObject = $(this);
                iCount++;
                bReturn = false;
                return false;
            }

            if (eQuantity.attr('item_code')) {
                // 단품인가
                frm.append(getInputHidden('relation_item[' + iCount + ']', eQuantity.val()+'||'+eQuantity.attr('item_code')));
                iCount++;
            } else {
                // 품목이 있는가
                bReturn = true;
                // 조합/분리 형의 경우 value_mapper가 있어야한다. 있으면 가서 쓰고 없어서 undefined가 뜨면 catch를 실행 - 억지코드임.
                try {
                    var aOptionMapper = $.parseJSON(eval('sOptionValueMapper'+iRelationProductNum));
                    var aOptionValue = new Array();
                    eOption.each(function() {
                        if ($(this).is('[required="true"]') === true && ($(this).val() == '*' || $(this).val() == '**')) {
                            sMsg = __('필수 옵션을 선택해주세요.');
                            NEWPRD_ADD_OPTION.checkVaildRelationProductObject(oObj, sMsg, bIsMainProductCheck, this);
                            sFailType = 'sRequiredVaild';
                            oObject = $(this);
                            iCount++;
                            bReturn = false;
                            return false;
                        } else {
                            aOptionValue.push($(this).val());
                        }
                    });
                    sOptionValue = aOptionValue.join('#$%');
                    var sItemCode = aOptionMapper[sOptionValue];
                } catch(e) {
                    eOption.each(function() {
                        if ($(this).is('[required="true"]') === true && ($(this).val() == '*' || $(this).val() == '**')) {
                            sMsg = __('필수 옵션을 선택해주세요.');
                            NEWPRD_ADD_OPTION.checkVaildRelationProductObject(oObj, sMsg, bIsMainProductCheck, this);
                            sFailType = 'sRequiredVaild';
                            oObject = $(this);
                            iCount++;
                            bReturn = false;
                            return false;
                        }
                    });
                    var sItemCode = eOption.val();
                }
                if (bReturn === true) {

                    if (Olnk.isLinkageType(eQuantity.attr('option_type')) === false) {
                        if (sOptionType === 'F') {
                            // 독립형
                            eOption.each(function() {
                                frm.append(getInputHidden('relation_item[' + iCount + ']', eQuantity.val()+'||'+$(this).val()));
                                iCount++;
                            });
                        } else {
                            // 조합형
                            frm.append(getInputHidden('relation_item[' + iCount + ']', eQuantity.val()+'||'+sItemCode));
                            iCount++;
                        }
                    } else  {
                        // 연동형
                        var _sProductCode = eQuantity.attr('product_code');
                        var _iQuantity = eQuantity.val();

                        var _sItemCode = _sProductCode + '000A';
                        var _aItemValueNo = Olnk.getSelectedItemForBasket(_sProductCode, eOption, _iQuantity);

                        frm.append(getInputHidden('relation_item[' + iCount + ']', _iQuantity+'||'+_sItemCode));
                        frm.append(getInputHidden('relation_item_by_etype[' + iCount + ']', $.toJSON(_aItemValueNo)));
                        iCount++;
                    }
                } else {
                    return false;
                }
            }

            if (typeof(rel_add_option_data) !== 'undefined' && $.trim(rel_add_option_data) !== '') {
                var aRelAddOptData = $.parseJSON(rel_add_option_data);
                var sRelAddOptName = '' + aRelAddOptData[iRelationProductNum] + '';
                var aRelAddOptNameData = sRelAddOptName.split('#$%');
            }

            if (sIsAddOptionName === 'T' && $(aRelAddOptNameData).length > 0) {
                $(aRelAddOptNameData).each(function(iRelationIndex) {
                    var sAddOptionKey  = iRelationProductNum + '_' + iRelationIndex;
                    var sRelAddOptionId = '#' + user_option_id + sAddOptionKey;

                    if ($.trim($(sRelAddOptionId).val()) === '') {
                        if ($(sRelAddOptionId).attr('require') === 'T') {
                            sMsg = __('추가 옵션을 입력해주세요.');
                            NEWPRD_ADD_OPTION.checkVaildRelationProductObject(oObj, sMsg, bIsMainProductCheck, sRelAddOptionId);
                            oObject = $(sRelAddOptionId);
                            sFailType = 'sRelAddOptionValid';
                            bReturn = false;
                            return false;
                        }
                    }
                    frm.append(getInputHidden('rel_option_add[' + sAddOptionKey +']',$(sRelAddOptionId).val()));
                    frm.append(getInputHidden('rel_add_option_name[' + sAddOptionKey + ']',aRelAddOptNameData[iRelationIndex]));
                });
                if (bReturn === false) {
                    return false;
                }
             }
        });

        if ($('input[name="basket_info[]"]:checked').length >= 0) {
            frm.append(getInputHidden('relation_product', 'yes'));
        }

        return {'result' : bReturn, 'count' : iCount, 'message' : sMsg, 'object' : oObject, 'sFailType' : sFailType};
    },

    /**
     * 단독 구매 관련 유효성 검증
     */
    checkVaildIndividualMsg : function(oValidResultData, sBuyType, oObject)
    {
        var bReturn = true;
        var sBuyValidMsg = '본상품의 옵션이 선택되지 않았습니다. \n 선택한 상품만 구매하시겠습니까?';
        var sCartValidMsg = '본상품의 옵션이 선택되지 않았습니다. \n 선택한 상품만 장바구니에 담으시겠습니까?';
        var sBuyTypeMessage = (sBuyType == true) ? sBuyValidMsg : sCartValidMsg;

        if (this.checkRelationProduct(oObject) === false) {
            bReturn = false;
            return false;
        }

        if (oValidResultData.sFailType !== '') {
            bReturn = false;
            return false;
        }

        if (confirm(__('' + sBuyTypeMessage + '')) === false) {
            bReturn = false;
            return false;
        }

        return bReturn;
    },

    /**
     * 단독 구매 관련 데이터 검증
     */
    getIndividualValidCheckData : function(oValidRelationProduct, oValidAddProduct, bIsMainProductEmpty, frm)
    {
        var bIsCheckRelationProduct = (oValidRelationProduct.count > 0) ? true : false;
        var bIsCheckAddProduct = (oValidAddProduct.count > 0) ? true : false;
        var bIsIndividual = false;
        // 메인상품의 존재여부
        if (isNewProductSkin() === true && bIsMainProductEmpty === true) {
            if (is_individual_buy === 'T') {
                bIsIndividual = (bIsCheckAddProduct === true || bIsCheckRelationProduct === true) ? true : false;
            } else {
                if (bIsCheckAddProduct === false) {
                    bIsIndividual = bIsCheckRelationProduct;
                }
            }
        }
        var bIndividualBuyResult = (bIsIndividual === true) ? 'T' : 'F';
        frm.append(getInputHidden('is_individual', bIndividualBuyResult));

        return {
            'isValidInidual' : bIsIndividual,
            'isVaildRelationProduct' : bIsCheckRelationProduct,
            'isVaildAddProduct' : bIsCheckAddProduct,
            'sFailType' : oValidRelationProduct.sFailType
        };
    },

    /**
     * 관련상품 선택여부 확인
     */
    checkRelationProduct : function(oObj, sType)
    {
        var aActionType = [1, 2];

        if ($.inArray(sType, aActionType) === -1) {
            return true;
        }

        if (typeof(oObj) === 'undefined' && $('input[name="basket_info[]"]:checkbox:checked').length <= 0) {
            alert(__('상품을 선택해주세요.'));
            return false;
        }

        return true;
    },

    /**
     * 관련상품 추가옵션 글자수 제한 체크
     */
    checkProductAddOptionWord : function (oObj)
    {
        var iLimit = $(oObj).attr('maxlength');
        var sId = $(oObj).attr('id');
        var sVal = $(oObj).val();
        var iStrLen = sVal.length;

        if (iStrLen > iLimit) {
            alert(sprintf(__('메세지는 %s자 이하로 입력해주세요.'), iLimit));
            $('#'+sId).val(sVal.substr(0, sVal.length-1));
            return;
        }

        $('#'+sId).parent().find('.txtLength').text(iStrLen);
    },

    /**
     * 메인상품 여부확인에 따른 얼럿메시지 노출 처리
     */
    checkVaildRelationProductObject : function(oObj, sMessage, bIsMainProductCheck, oSelected)
    {
        if (isNewProductSkin() === true && this.checkRelationProduct(oObj) === true && (bIsMainProductCheck === true || this.isSoldOutMainProduct() === true)) {
            alert(sMessage);
            $(oSelected).focus();
        }
    },

    /**
     * 본상품의 품절 아이콘이 존재하고 추가구성상품의 단독구매 여부 및 관련상품
     */
    checkSoldOutProductValid : function(oObj)
    {
        if (NEWPRD_ADD_OPTION.isSoldOutMainProduct() === true) {
            if ($('input[class^="option_add_box_"][name="basket_add_product[]"]').length > 0 || $('input[name="basket_info[]"]:checkbox:checked').length > 0) {
                return true;
            } else {
                return false;
            }
        } else if (isNewProductSkin() === true && is_soldout_icon === 'T' && this.checkRelationProduct(oObj) === true) {
            return true;
        }

        return false;
    },

    /**
     * 본상품의 품절여부 (판매가 대체문구 및 판매안함 상품)
     */
    isSoldOutMainProduct : function()
    {
        if (isNewProductSkin() === true && (is_soldout_icon === 'T' || product_price_content == true)) {
            return true;
        }

        return false;
    },

    /**
     * 관련상품 수량 체크 유효성 검증
     */
    checkVaildRelationProductQuantity : function(iRelationProductNum)
    {
        var bReturn = true;
        var aQuantityInfo = $.parseJSON(relation_product);
        var sRelationQuantityId = 'quantity_' + iRelationProductNum;
        var oProductQuantity  = $('input[id^= "'+ sRelationQuantityId +'"]');
        var iRelationQuantity = oProductQuantity.val();

        var iProductMinimum = parseInt(aQuantityInfo[iRelationProductNum].product_min, 10);
        var iProductMaximum = parseInt(aQuantityInfo[iRelationProductNum].product_max, 10);

        if (iRelationQuantity > iProductMaximum && iProductMaximum > 0) {
            alert(sprintf(__('최대 주문수량은 %s개 입니다.'), iProductMaximum));
            oProductQuantity.val(iProductMaximum);
            $(oProductQuantity).focus();
            return false;
        }

        if (iRelationQuantity < iProductMinimum) {
            alert(sprintf(__('최소 주문수량은 %s개 입니다.'), iProductMinimum));
            oProductQuantity.val(iProductMinimum);
            $(oProductQuantity).focus();
            return false;
        }

        if (bReturn === false) {
            return false;
        }

        return bReturn;
    },

    /**
     * 구스킨 > 관련상품 및 추가 구성상품용 유효성 검증 메시지
     */
    checkExistingValidMessage : function(oObj, oAddProductCount)
    {
        var sValidMsg = false;

        // 뉴스킨은 관계 없음
        if (isNewProductSkin() === true) {
            return sValidMsg;
        }

        if (typeof(oObj) === 'undefined') {
            sValidMsg = __('본상품과 함께 구매가 가능합니다. \n 본상품의 필수 옵션을 선택해 주세요.');
        } else if (oAddProductCount.count > 0) {
            //추가구성상품의 선택되어있으면서 본상품의 옵션이 선택 안되었을때
            sValidMsg = __('본상품의 필수 옵션을 선택해 주세요');
        }

        return sValidMsg;
    },

    /**
     * 관련상품 및 단독기능 사용 추가구성 상품시 유효성 검증에 해당하는 메시지의 노출여부 결정
     */
    checkIndividualValidAction : function(oRelationProductCount, oAddProductCount)
    {
        var bIsCheckValid = true;
        // 구스킨은 관계 없음
        if (isNewProductSkin() === false) {
            return bIsCheckValid;
        }

        if (is_individual_buy === 'T') {
            bIsCheckValid = (oAddProductCount.result === false || oRelationProductCount.result === false) ? false : true;
            if (bIsCheckValid === false && oAddProductCount.message !== '') {
                alert(oAddProductCount.message);
                return false;
            }
        } else {
            bIsCheckValid = (oRelationProductCount.result === false) ? false : true;
        }

        return bIsCheckValid;
    }

};

$(document).ready(function(){
    // 파일첨부옵션 초기화
    FileOptionManager.init();
});



/**
 * JSON.stringify
 * @param object aData JSON.stringify 할 데이터
 * @return string JSON.stringify 된 데이터 반환
 */
function JSON_stringify(aData)
{
    if (!$.stringify) {
        // https://gist.github.com/chicagoworks/754454
        jQuery.extend({
            stringify: function stringify(obj) {
                if ("JSON" in window) {
                    return JSON.stringify(obj);
                }

                var t = typeof (obj);
                if (t != "object" || obj === null) {
                    // simple data type
                    if (t == "string") obj = '"' + obj + '"';

                    return String(obj);
                } else {
                    // recurse array or object
                    var n, v, json = [], arr = (obj && obj.constructor == Array);

                    for (n in obj) {
                        v = obj[n];
                        t = typeof(v);
                        if (obj.hasOwnProperty(n)) {
                            if (t == "string") {
                                v = '"' + v + '"';
                            } else if (t == "object" && v !== null){
                                v = jQuery.stringify(v);
                            }

                            json.push((arr ? "" : '"' + n + '":') + String(v));
                        }
                    }

                    return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
                }
            }
        });
    }

    return $.stringify(aData);
}


/**
 * FileOption
 * 파일옵션 class - 파일첨부 옵션 하나당 하나씩
 * @author 백충덕 <cdbaek@simplexi.com>
 */
var FileOption = function(sInputId, aParam)
{
    this.aOpt = {
        inputId: sInputId,
        name: null,
        maxLen: null,
        maxSize: null,
        btnDel: '<a href="#none"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/common/btn_attach_close.gif" /></a>',
        btnDelSelector: 'a',
        eInputFile: null
    };

    $.extend(this.aOpt, aParam);

    var self = this;

    /**
     * 초기화
     */
    this.init = function()
    {
        self.aOpt.eInputFile = $('#'+self.aOpt.inputId+':visible');

        // 지정된 id를 가진 input file이 없을 경우
        if (!self.aOpt.eInputFile) return false;

        // 파일리스트 목록 초기화
        var aFileListContainer = self._getFileListContainer(self.aOpt.inputId);
        if (aFileListContainer.size() < 1) {
            self.aOpt.eInputFile.parent().append('<ul id="'+self._getFileListContainerId(self.aOpt.inputId)+'"></ul>');
            aFileListContainer = self._getFileListContainer(self.aOpt.inputId);
        }

        // 모바일의 경우 삭제버튼 변경
        if (self._isMobileBrowser()===true) {
            self.aOpt.btnDel = '<button type="button" class="btnDelete">삭제</button></li>';
            self.aOpt.btnDelSelector = 'button.btnDelete';
        }

        // 삭제버튼 이벤트 핸들러 세팅
        aFileListContainer.delegate(this.aOpt.btnDelSelector, 'click', function() {
            $(this).parent().remove();
            return false;
        });
    };

    /**
     * 파일 입력폼을 초기화
     * @param jQuery eFile 파일 입력폼
     */
    this.resetFileInput = function(eFile)
    {
        // MSIE
        if (navigator.appVersion.indexOf('MSIE') > -1) {
            eFile.replaceWith(eFile = eFile.clone(true));
        } else {
            eFile.val('');
        }
    };

    /**
     * input:file change 이벤트 핸들러
     * @param object eFileInput change이벤트가 발생한 input:file
     */
    this.onChange = function(eFileInput)
    {
        var eFile = $(eFileInput);

        // 업로드 파일명
        var sFileName = this._getFileName(eFile.val());
        if (sFileName.length<1) return false;

        var eFileList = this._getFileListContainer(eFile.attr('id'));

        // 첨부파일 최대 갯수 제한
        var iCntFile = eFileList.find('li').length;
        if (iCntFile >= this.aOpt.maxLen) {
            if (eFile.val().length>0) alert(sprintf(__('첨부파일은 최대 %s개까지만 업로드 가능합니다.'), self.aOpt.maxLen));
            this.resetFileInput(eFile);
            return false;
        }

        // 업로드 파일리스트 추가
        var eFileItem = $('<li>'+sFileName+' '+this.aOpt.btnDel+'</li>');
        var sId = eFile.attr('id');
        var sRequire = eFile.attr('require');
        var sAccept = eFile.attr('accept');

        // IE8 이하에서는 display가 바뀌어도 onChange가 trigger되므로 onChange 제거
        eFile.get(0).onchange = null;

        eFile.css('display', 'none');
        eFile.attr({
            id: '',
            name: this.aOpt.inputId+'[]'
        });
        eFileItem.append(eFile);
        eFileList.append(eFileItem);

        // 새 파일업로드 input 배치
        var eFileNew = $('<input type="file" onchange="FileOptionManager.onChange(this)"/>');
        eFileNew.attr({
            id:      sId,
            name:    sId,
            require: sRequire,
            accept:  sAccept
        });
        eFileList.parent().prepend(eFileNew);

        // 업로드 가능한 파일인지를 비동기로 확인
        this.checkUpload(sFileName, eFileItem, String(sAccept));
    };

    /**
     * 파일업로드 전 체크
     * @param string sFileName 파일명
     * @param jQuery eFileItem 파일 첨부
     * @param string sAccept accept 속성값 (.jpg,.jpeg,.gif)
     */
    this.checkUpload = function(sFileName, eFileItem, sAccept)
    {
        var self = this;
        var sFileExtension = sFileName.replace(/^.+\.([^.]+)$/, '$1');
        if ($.inArray('.' + sFileExtension, sAccept.split(',')) > -1) {
            // accept 속성에 포함된 확장자인 경우 확인 안함
            return;
        }

        $.ajax({
            url: "/api/product/fileupload/",
            method: "GET",
            data: {
                cmd: "check_upload",
                file_extension: sFileExtension
            },
            dataType: "json",
            success: function(result) {
                if (result && result.err) {
                    eFileItem.find(self.aOpt.btnDelSelector).click();
                    alert(result.err);
                }
            }
        });
    }

    /**
     * 유효성 체크
     * @return bool 유효하면 true, 아니면 false
     */
    this.checkValidation = function()
    {
        // 파일첨부 옵션이 '필수'가 아닐 경우 OK
        if (self.aOpt.eInputFile.attr('require') !== 'T') return true;

        // 파일첨부 옵션이 '필수'인데 업로드 선택 파일이 없을 경우
        if (self.existsFileUpload()===false) {
            alert(self.aOpt.name+' '+__('파일을 업로드 해주세요.'));
            self.aOpt.eInputFile.focus();
            return false;
        }

        return true;
    };

    /**
     * 업로드 해야할 input:file 리스트 반환
     * @return array 업로드 해야할 input:file 리스트
     */
    this.getInputFileUpload = function()
    {
        return self._getFileListContainer(self.aOpt.inputId).find('input:file:hidden');
    };

    /**
     * 업로드 해야할 input:file이 있는지 여부 체크
     * @return bool 업로드 해야할 input:file이 있으면 true, 없으면 false
     */
    this.existsFileUpload = function()
    {
        return self.getInputFileUpload().size() > 0;
    };

    /*
     * 파일업로드 리스트를 담을 노드 반환
     * @param string sSuffix
     * @return element
     */
    this._getFileListContainer = function(sSuffix)
    {
        var sFileListId = self._getFileListContainerId(sSuffix);

        return $('ul[id="'+sFileListId+'"]');
    };

    /**
     * 파일업로드 리스트를 담을 노드의 ID 반환
     * @param string sSuffix id로 사용할 suffix
     * @return string 노드의 ID
     */
    this._getFileListContainerId = function(sSuffix)
    {
        return 'ul_'+sSuffix;
    };

    /**
     * 파일 경로에서 파일명만 추출
     * @param string sFilePath 파일 경로
     * @return mixed 추출된 파일명 반환, 실패시 false 반환
     */
    this._getFileName = function(sFilePath)
    {
        sFilePath = $.trim(sFilePath);
        if (sFilePath.length<1) return false;

        return $.trim(sFilePath.split('/').pop().split('\\').pop());
    };

    /**
     * 모바일 브라우저인지 체크
     * @return bool 모바일 브라우저이면 true, 아니면 false 반환
     */
    this._isMobileBrowser = function()
    {
        // 전역 isMobile 변수가 세팅되어있을 경우 isMobile 변수값 반환
        if (typeof isMobile != 'undefined') {
            return isMobile;
        // 전역 isMobile 변수가 없을 경우 location.hostname으로 판별
        } else {
            return location.hostname.indexOf('m.')===0;
        }
    };
}

/**
 * FileOptionManager
 * 파일옵션 객체를 관리하는 class - 페이지 내의 파일첨부 옵션 전체를 관장
 * @author 백충덕 <cdbaek@simplexi.com>
 */
var FileOptionManager = {
    bIsInputFileSupport: null,
    /**
     * FileOption 객체 리스트
     * @var object
     */
    aList: {},

    /**
     * 초기화
     *   - FileOptionManager.add()를 통해 추가된 FileOption 객체 초기화 처리
     */
    init: function()
    {
        for (var sId in this.aList) {
            if (this.aList.hasOwnProperty(sId)===false) continue;

            // 초기화 과정에 문제가 생긴 객체는 리스트에서 제거
            if (this.aList[sId].init() === false) delete this.aList[sId];
        }
    },

    /**
     * 파일업로드용 input:file의 change 이벤트 핸들러
     * @param object eFileInput change 이벤트가 발생한 input:file
     */
    onChange: function(eFileInput)
    {
        var sId = eFileInput.id;
        this.aList[sId].onChange(eFileInput);
    },

    /**
     * 리스트에 sInputId, aOpt 파라메터로 생성한 FileOption 객체 추가
     * @param string sId 고유 ID (input:file의 id로도 쓰임)
     * @param object aOpt 생성 파라메터
     */
    add: function(sId, aOpt)
    {
        this.aList[sId] = new FileOption(sId, aOpt);
    },

    /**
     * 업로드해야 할 input:file이 있는지 체크
     * @param mixed mId 업로드 해야할 파일이 있는지 체크할 FileOption id. 없거나 하나 혹은 여러개.
     * @return bool 파일업로드가 있으면 true, 아니면 false
     */
    existsFileUpload: function(mId)
    {
        var aId = this._getList(mId);

        for (var i=0; i<aId.length; i++) {
            var sId = aId[i];

            // 업로드해야 할 파일 있음
            if (this.aList[sId].existsFileUpload() === true) return true;
        }

        return false;
    },

    /**
     * 유효성 체크
     * @param mixed mId 유효성 체크할 FileOption id. 없거나 하나 혹은 여러개.
     * @return bool 유효하면 true, 아니면 false
     */
    checkValidation: function(mId)
    {
        var aId = this._getList(mId);

        // 유효성 체크
        for (var i=0; i<aId.length; i++) {
            var sId = aId[i];

            if (this.aList[sId].checkValidation() === false) return false;
        }

        return true;
    },

    /**
     * 파일첨부 옵션 업로드 실행
     * @param mixed mId 파일업로드를 실행할 FileOption id. 없거나 하나 혹은 여러개.
     * @param function callback 파일업로드 완료 후 실행할 callback
     */
    upload: function(mId, callback)
    {
        var self = this;

        // mId 지정하지 않음
        if (typeof mId === 'function') {
            callback = mId;
            mId = null;
        }
        var aId = this._getList(mId);

        // 업로드 해야할 input:file 추출
        var aFile = [];
        var aMaxSize = {};
        for (var i=0; i<aId.length; i++) {
            var sId = aId[i];
            aMaxSize[sId] = this.aList[sId].aOpt.maxSize;

            this.aList[sId].getInputFileUpload().each(function(idx){
                var sVal = $.trim($(this).val());
                if (sVal.length < 1) return;

                aFile.push({
                    eFile: $(this),
                    eParent: $(this).parent()
                });
            });
        }

        // 업로드 할 파일이 없을 경우 중지 (업로드는 성공했다고 반환)
        if (aFile.length < 1) {
            callback(true);
            return true;
        }

        var sTargetName = 'iframe_add_option_file_upload';
        var sAction     = '/api/product/fileupload/';

        // form
        var form = $('<form action="'+sAction+'" method="post" enctype="multipart/form-data" style="display:none;" target="'+sTargetName+'"></form>');
        $('body').append(form);
        // 업로드할 input:file append
        for (var i=0; i<aFile.length; i++) {
            aFile[i].eFile.appendTo(form);
        }

        // 커맨드 지정
        $('<input type="hidden" name="cmd" value="upload" />').prependTo(form);
        // 파일 업로드 사이즈 한계
        $('<input type="hidden" name="max_size" value="'+encodeURIComponent(JSON_stringify(aMaxSize))+'" />').prependTo(form);

        // iframe
        var iframe = $('<iframe src="javascript:false;" name="'+sTargetName+'" style="display:none;"></iframe>');
        $('body').append(iframe);

        // iframe onload(form.submit response) 이벤트 핸들러
        iframe.load(function(){
            var doc = this.contentWindow ? this.contentWindow.document : (this.contentDocument ? this.contentDocument : this.document);
            var root = doc.documentElement ? doc.documentElement : doc.body;
            var sResult = root.textContent ? root.textContent : root.innerText;
            var aResult = $.parseJSON(sResult);
            var mReturn = false;

            if (typeof aResult==='object') {
                // 업로드 성공
                if (aResult.err=='') {
                    // 업로드 성공한 파일정보를 가져와 input:hidden의 value로 저장
                    for (var sId in aResult.files) {
                        var eInputHidden = $('#'+sId+'_hidden');
                        var aVal = {
                            title: self.aList[sId].aOpt.name,
                            files: []
                        };
                        for (var i=0; i<aResult.files[sId].length; i++) {
                            aVal.files.push({
                                path: aResult.files[sId][i].path,
                                name: aResult.files[sId][i].name
                            });
                        }

                        eInputHidden.val(encodeURIComponent(JSON_stringify(aVal)));

                        // 반환값 세팅
                        if (mReturn===false) mReturn = {};
                        mReturn[sId] = aVal;
                    }
                // 업로드 실패
                } else {
                    alert(aResult.err);
                }
            }

            // file element 원래 위치로 이동
            for (var i=0; i<aFile.length; i++) {
                aFile[i].eFile.appendTo(aFile[i].eParent);
            }

            // 임시 element 삭제
            form.remove();
            iframe.remove();

            callback(mReturn);
        });

        // 파일전송
        form.submit();
    },

    /**
     * 브라우저가 input file 지원여부 반환
     * @return bool input file 지원시 true, 아니면 false
     */
    isInputFileSupport: function()
    {
        if (this.bIsInputFileSupport===null) {
            this.bIsInputFileSupport = true;

            try {
                var eInputFile = document.createElement('input');
                eInputFile.type = 'file';
                eInputFile.style.display = 'none';
                document.getElementsByTagName('body')[0].appendChild(eInputFile);

                if (eInputFile.disabled) this.bIsInputFileSupport = false;
            } catch (e) {
                this.bIsInputFileSupport = false;
            } finally {
                if (eInputFile) eInputFile.parentNode.removeChild(eInputFile);
            }
        }

        return this.bIsInputFileSupport;
    },

    // 파라메터로 넘기기 위해 인코딩
    encode: function(sVal)
    {
        return encodeURIComponent(JSON_stringify(sVal)).replace(/'/g, "%27");
    },

    /**
     * 넘겨받은 id에 해당하는 유효한 FileOption id 리스트 반환
     * @param mixed mId 리스트로 추출할 FileOption id. 없거나 하나 혹은 여러개.
     * @return array 유효한 FileOption id 리스트
     */
    _getList: function(mId)
    {
        var aId = [];

        // 지정한 id가 없다면 전체대상
        if (!mId) {
            for (var sId in this.aList) {
                if (this.aList.hasOwnProperty(sId)===false) continue;

                aId.push(sId);
            }
        // 지정한 id가 문자열 하나
        } else if (typeof mId === 'string') {
            aId.push(mId);
        // 지정한 id가 Array(object)
        } else {
            aId = mId;
        }

        // 뭔가 문제가 있을 경우 빈 배열 반환
        if ($.isArray(aId)===false || aId.length<1) return [];

        // 유효한 id만 추출
        var sId = '';
        var aResult = [];
        for (var i=0; i<aId.length; i++) {
            sId = aId[i];
            if (!(sId in this.aList)) continue;

            aResult.push(sId);
        }

        return aResult;
    }
};

$(document).ready(function(){

    // 최근 본 상품 쿠키 세팅하기
    var sPath = document.location.pathname;
    var sPattern = /^\/product\/(.+?)\/([0-9]+)(\/.*|)/;
    var aMatchResult = sPath.match(sPattern);

    if (aMatchResult) {
        var iProductNo = aMatchResult[2];
    } else {
        var iProductNo  = NEWPRODUCT_Recent.getParameterByName('product_no');
    }

    var sCookieName = 'recent_plist' + (SHOP.isDefaultShop() ? '' : EC_SDE_SHOP_NUM);
    var sCookieVal  = $.cookie(sCookieName);

    $.cookie(sCookieName, NEWPRODUCT_Recent.getRecentUnique(iProductNo , sCookieVal), {
        'path' : '/',
        'expires' : 365
    });

    // ie하위 버젼에서는 로컬 스토리지 동작 안함으로 인해서 시도도 안함!
    // 기존 쿠키 방식 그대로 씀
    if (NEWPRODUCT_Recent.getIsLocalStorageAble() === true) {
        NEWPRODUCT_Recent.setProductRecentInfo(iProductNo);
    }


});


var NEWPRODUCT_Recent = {
        iMaxLength : 50,
        sStorageKey : 'localRecentProduct' + EC_SDE_SHOP_NUM,
        /**
         * url에서 파라미터 가져오기
         * @param string name 파라미터명
         * @return string 파라미터 값
         */
         getParameterByName : function (name) {
            name        = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
            var regexS  = "[\\?&]" + name + "=([^&#]*)";
            var regex   = new RegExp(regexS);
            var results = regex.exec(window.location.href);

            if (results == null) {
                return '';
            } else {
                return decodeURIComponent(results[1].replace(/\+/g, " "));
            }
        },

        /**
         * SEO URL 에서 name 파라메터 값 가져오기, SEO URL 이 아니면  getParameterByName 에서 요청
         * @param string name 파라미터명
         * @param string sRegexPattern seo url 에서 category 값 가져오기 패턴
         * @return string 파라미터 값
         */
         getParameterFromSeoUrl : function (name, sRegexPattern) {
            var regex   = new RegExp(sRegexPattern);
            var results = regex.exec(window.location.href);

            if (results == null) {
                return NEWPRODUCT_Recent.getParameterByName(name);
            } else {
                return decodeURIComponent(results[2].replace(/\+/g, " "));
            }
        },

        /**
         * 최근상품번호 리스트 가져오기
         * @param int iProductNo product_no
         * @return string 기존 쿠키값에 현재 상품리스트 추가한 쿠키값
         */
        getRecentUnique : function (iProductNo, sCookieVal)
        {
            var newList    = [];
            var aList      = sCookieVal ? sCookieVal.split('|') : [];

            for (var i = 0; i < aList.length; i++) {
                var sNo = $.trim(aList[i]);
                if (sNo == '' || sNo == iProductNo) {
                    continue; // 이미 있으면 skip...
                }
                newList.push(sNo);
            }
            newList.push(iProductNo);

            if (newList.length >= this.iMaxLength) {
                newList = newList.slice(newList.length - this.iMaxLength);
            }
            return newList.join('|');
        },
        /**
         * 최근상품 상품명 저장시 상품명 자르기
         * @return string 상품명
         */
         getCutProductName : function() {
            var iByte           = 0;
            var sProductNameTmp    =  product_name.replace(/(<([^>]+)>)/ig,'');
            var iStrLength      = product_name.length;
            var iMaxItem        = 10;
            var sProductName    = '';
            var iMaxLimit       = 10;

            // 상품명에 태그가 포함되어 있지 않은 경우
            if (sProductNameTmp === '') {
                sProductNameTmp = product_name;
            }

            for (var i=0; i < iStrLength; i++) {
                if (escape(sProductNameTmp.charCodeAt(i)).length > 4){
                    iByte +=2; //한글이면 2를 더한다
                    iMaxItem -= 1;
                }
                if (iByte > iMaxItem) {
                    sProductName = sProductNameTmp.slice(0,iMaxItem);
                    break;
                }
            }

            if (sProductName === '') {
                sProductName = sProductNameTmp.slice(0,iMaxLimit);
            }
            return sProductName;
        },

        /*
         * sessionStorage 사용
         */
        setProductRecentInfo : function (iProductNo) {

            var oJsonData = this.getSessionStorageData(this.sStorageKey);
            var iObjectKeyCount = 0;
            //if (this.isDulicateCheck(iProductNo ,oJsonData) === false) {
            var sRegexCategoryNumberBySeoUrl = '(\/product\/.+?\/[0-9]+\/category\/)([0-9]+)(\/.*|)';
            var sRegexDisplayNumberBySeoUrl = '(\/product\/.+?\/[0-9]+\/category\/[0-9]+\/display\/)([0-9]+)(\/.*|)';

            var iCateNum       = parseInt(NEWPRODUCT_Recent.getParameterFromSeoUrl('cate_no', sRegexCategoryNumberBySeoUrl), 10);
            var iDisplayGroup  = parseInt(NEWPRODUCT_Recent.getParameterFromSeoUrl('display_group', sRegexDisplayNumberBySeoUrl), 10);
            var sProductName   = NEWPRODUCT_Recent.getCutProductName();

            var oNewStorageData = new Object();
            var iDelProductNum = 0;

            var aParam = {
                product_no   : iProductNo,
                cate_no      : iCateNum,
                display_group: iDisplayGroup
            };
            var sParam = '?' + $.param(aParam);
            var aNewStorageData = {
                    'iProductNo'    : iProductNo,
                    'sProductName'  : sProductName,
                    'sImgSrc'       : product_image_tiny,
                    'isAdultProduct': is_adult_product,
                    'link_product_detail': link_product_detail,
                    'sParam'        : sParam
                   };

            oNewStorageData[iObjectKeyCount] = aNewStorageData;
            if (oJsonData !== null) {
                var aStorageData = $.parseJSON(oJsonData);
                iProductNo = $.trim(iProductNo);
                for (var iKey in aStorageData) {
                    if (isFinite(iKey) === false) {
                        continue;
                    }
                    if ($.trim(aStorageData[iKey].iProductNo) !== iProductNo) {
                        iObjectKeyCount++;
                        oNewStorageData[iObjectKeyCount] = aStorageData[iKey];
                        iDelProductNum = aStorageData[iKey].iProductNo;
                    }
                }
            }
            this.setSessionStorageData(this.sStorageKey , oNewStorageData);

            if (iObjectKeyCount  >= this.iMaxLength) {
                this.setUpdateStorageData($.trim(iDelProductNum));
            }
            //}

        },
        /*
         * 삭제될 스토리지 범위가 벗어났을 경우 처리 필요해서
         */
        setUpdateStorageData : function (iProductNo) {
            var oJsonData = this.getSessionStorageData(this.sStorageKey);

            if (oJsonData === null) {
                return;
            }
            var iCount = 0;
            var oNewStorageData = new Object();
            var aStorageData = $.parseJSON(oJsonData);
            var iStorageLength = aStorageData.length;

            var sDeleteKey  = this.iMaxLength + '';
            // 마지막에 추가되어 있던 상품을 지운다.
            delete aStorageData[sDeleteKey];
            this.setSessionStorageData(this.sStorageKey , aStorageData);

        },
        /*
         * 중복된 상품번호가 있는가 확인 하는 메소드
         */

        isDulicateCheck : function (iProductNo , oJsonData) {
            var bDulicate = false;

            if (oJsonData === null) {
                return false;
            }
            iProductNo = $.trim(iProductNo);
            var aStorageData = $.parseJSON(oJsonData);
            for (var iKey in aStorageData) {
                if ($.trim(aStorageData[iKey].iProductNo) === iProductNo) {
                    bDulicate = true;
                    break;
                }
            }
            return bDulicate;
        },
        /**
         * get SessionStorage
         * @param sStorageKey SessionStorage에 저장되어 있는 key값
         */
        getSessionStorageData : function (sStorageKey)
        {
            return sessionStorage.getItem(sStorageKey);
        },
        /**
         * set SessionStorage
         * @param sStorageKey SessionStorage에 저장할 key값
         * @param sStorageValue SessionStorage에 저장할 value값
         */
        setSessionStorageData : function (sStorageKey , sStorageValue)
        {
            return sessionStorage.setItem(sStorageKey , $.toJSON(sStorageValue));
        },

        /**
         * 세션스토리지가 사용가능한지 확인
         */
        getIsLocalStorageAble : function() {
            var sTestKey = 'CAPP_TMP_KEY';
            try {
                window.localStorage.setItem(sTestKey, 1);
                window.localStorage.removeItem(sTestKey);
                return true;
            } catch(e) {
                return false
            }
        }
};

/**
 * 
 */

/**
 * 게시판 관련 JS
 */

$(document).ready(function(){
    BOARD.event_bind();
    // 게시판메뉴 이미지 롤오버
    BOARD.board_img_over();
});


var BOARD = {
    /**
     * 게시판 첨부 이미지 로드큐
     */
    aAttachImageLoadQueue : [],
    
    /**
     * 이벤트 바인딩을 합니다.
     */
    event_bind : function ()
    {
        $(".eReplyStatusChangeBtn, #eReplyStatusChangeBtn").click(function (event) {
            event.preventDefault(); // 기존 a 태그 href 동작 해제
            BOARD.setReplyStatus();
        });
        
        //상품분류 검색 셀렉터 이벤트 바인딩
        BOARD.setProductCategorySelector.setEvent();
    },

    /**
     * ECHOSTING-70918
     * 처리상태에 대한 값을 UPDATE 합니다.
     */
    setReplyStatus : function()
    {
        $.ajax({
            type : 'post',
            dataType : 'json',
            url : getMultiShopUrl("/exec/admin/board/ReplyStatusAjax"),
            data : {
                mode : 'UPDATE',
                board_no : $("#board_no").val(),
                no : $("#no").val(),
                reply_status : $("#eReplyStatusChangeTarget").val()
            },
            success : function(aOutputData) {
                if (aOutputData['result'] == 'T') {
                    BOARD.setSuccessResult(aOutputData);
                } else {
                    alert("잘못된 접근입니다.");
                }
            },
            error : function() {
                alert("네트워크 상태가 불안정 합니다. 잠시 후 다시 시도해주세요");
            }
        });
    },

    /**
     * ECHOSTING-70918
     * 성공 결과에 대한 피드백을 합니다.
     */
    setSuccessResult : function (aResult)
    {
        switch (aResult['status']) {
            case "N" :
                alert("처리중 상태가 해제되었습니다.");
                break;
            default :
                alert("처리중으로 변경되었습니다.");
                break;
        }

        // 새로운 상태로 갱신
        $("#eReplyStatusText, .eReplyStatusText").html(aResult['new_status_icon']); // 상태
        $("#eReplyStatusText, .eReplyStatusText").attr("class", aResult['new_status_style']); // 상태 스타일
        $("#eReplyStatusChangeBtn, .eReplyStatusChangeBtn").html(aResult['new_status_btn_icon']); // 버튼 텍스트
        $("#eReplyStatusChangeTarget").val(aResult['new_target_status']); // 변경될 값
    },

    /**
     * 공지글 보기
     */
    show_notice : function()
    {
        var bFlag = $('input:[type="checkbox"][name="showNotice"]')[0].checked;
        if (bFlag === true) {
            $('.mNoticeFlag').each(function(index, node){
                $(node).show();
            });
        } else {
            $('.mNoticeFlag').each(function(index, node){
                $(node).hide();
            });
        }
    },

    /**
     * 게시물 복사
     * @param link
     * @param board_no
     * @param listName
     */
    article_copy : function(link, board_no, listName, aNo, return_url)
    {
        if (!aNo) {
            var aNo = this.check_nos( listName );

            if ( aNo.length <= 0 ) {
                alert(__('복사할 글을 선택하여 주세요.'));
                return;
            }
        }

        var dest_board_no = $("#boardGroup option:selected").val();

        if ( confirm(__("복사하시겠습니까?"))) {
            location.href = link  + "?board_no=" + board_no + "&board_target=" + aNo + "&dest_board_no=" + dest_board_no + "&return_url=" + return_url;
        }
    },

    /**
     * 게시물 이동
     * @param link
     * @param board_no
     * @param listName
     */
    article_move : function(link, board_no, listName, aNo, return_url)
    {
        if (!aNo) {
            var aNo = this.check_nos( listName );

            if ( aNo.length <= 0 ) {
                alert(__('이동할 글을 선택하여 주세요.'));
                return;
            }
        }

        var dest_board_no = $("#boardGroup option:selected").val();

        if (board_no == dest_board_no) {
            alert(__('동일한 게시판으로 게시물을 이동 할 수 없습니다.'));
            return false;
        }

        location.href = link + "?board_no=" + board_no + "&board_target=" + aNo + "&dest_board_no=" + dest_board_no + "&return_url=" + return_url;
    },

    /**
     * 카테고리 이동
     * @param link
     * @param board_no
     * @param listName
     */
    category_move : function(link, board_no, listName, return_url)
    {
        var aNo = this.check_nos( listName );

        if ( aNo.length <= 0 ) {
            alert(__('이동할 글을 선택하여 주세요.'));
            return;
        }

        var dest_category = $("#board_category_move option:selected").val();

        location.href = link + "?board_no=" + board_no + "&board_target=" + aNo + "&dest_category=" + dest_category + "&return_url=" + return_url;
    },

    is_spam : function(mode, bbs_no, bbs_type, listName, return_url)
    {
        if (bbs_no == ''){
            var bbs_no = this.check_nos(listName);

            if (bbs_no.length <= 0) {
                alert(__('댓글을 선택하여 주세요.'));
                return;
            }
        }

        if (mode == 'move') {
            return_url = (return_url)? '&return_url='+return_url : '';
            this.OpenWindow('/admin/php/b/board_spam_regist.php?mode='+mode+'&bbs_type='+bbs_type+'&bbs_no='+bbs_no+return_url, 'spamRegist', '450', '350','no');
        } else {
            this.OpenWindow('/admin/php/b/board_spam_restore.php?mode='+mode+'&bbs_type='+bbs_type+'&bbs_no='+bbs_no, 'spamRestore', '470', '350','yes');
        }
    },

    /**
     * 관리자 설정에 따른 제목, 컨텐츠 고정하기
     */
    fix_subject_content : function(sAgent)
    {
        $("select[name='subject']").change(function(){
            if ($("#fix_content_" + this.selectedIndex).val() != undefined) {
                var content = $("#fix_content_" + this.selectedIndex).val() + $("#fix_add_content").val();
            } else {
                if ($("#fix_add_content").val() != undefined) {
                    var content = $("#fix_add_content").val();
                } else {
                    var content = '';
                }
            }

            // 답변, 수정 모드에서는 컨텐츠 영역이 수정되지 않도록 한다.
            if ($('#no').length == 0 && content != '') {
                if (sAgent == true) {
                    $("#content").val(content);
                } else {
                    $("#content_IFRAME").get(0).contentWindow.document.body.innerHTML =  content;
                    $("#content_TEXTAREA").val(content);
                }
            }

        });
    },

    /**
     * 항상 비밀글 사용하기
     */
    disable_secret : function()
    {
        $("#secure0").attr({
            "checked": "",
            "disabled" : "disabled"
        });

        $("#secure1").attr("checked", "checked");
    },

    /**
     * 게시판메뉴 이미지 롤오버
     */
    board_img_over : function()
    {
        $(".board_img_over").hover(function(){
            $(this).attr('src',$(this).attr('eImgOver'))
        }, function(){
            $(this).attr('src',$(this).attr('eImgout'))
        })
    },

    /**
     * 폼 submit
     * @param string sFormName 폼 name
     */
    form_submit : function(sFormName)
    {
        // 서밋 위치를 BOARD_WRITE로 변경
        $('#'+sFormName).submit();
    },

    /**
     * 리스트 정렬 submit
     * @param string sFormName 폼 name
     */
    change_sort : function(sFormName, obj)
    {
        $('#'+sFormName+' [id="board_sort"]').val(obj.value);

        $('#'+sFormName).submit();
    },

    /**
     * 답변여부 선택 select
     * @param element obj select element
     */
    change_reply_sort: function(obj)
    {
        var sQueryString = document.location.search.substr(1);
        var aParams = {};

        $.each(sQueryString.split('&'), function(i, str){
            var sKey = str.substr(0, str.indexOf('='));
            if ('page' !== sKey) {
                var sVal = str.substr(str.indexOf('=')+1);

                aParams[sKey] = sVal;
            }
        });

        aParams['is_reply_sort'] = $(obj).val();
        var aUrls = [];
        $.each(aParams, function(sKey, sVal){
            if ('' !== $.trim(sVal)) {
                aUrls.push(sKey+'='+$.trim(sVal));
            }
        });

        document.location.href = document.location.pathname+'?'+aUrls.join('&');
    },

    /**
     * 상품후기 리스트 펼침
     * @param int iNo 글번호
     * @param int iBoardNo 게시판번호
     * @param object obj
     */
    viewTarget : function(iNo, iBoardNo, obj) {
        var self = this;
        var elmTarget = $(obj);

        if (elmTarget.parents('tr').next().attr('id') == 'content_view') {
            elmTarget.find('img').attr('src', function() {
                return this.src.replace('_fold','_unfold');
            });

            self.changeFoldImg(obj);

            $('#content_view').remove();
            return;
        } else {
            $('#content_view').remove();

            var aData = {
                    'no' : iNo,
                    'board_no' : iBoardNo
            }
            $.get('/exec/front/board/Get/'+iBoardNo, aData, function(req) {
                if (req.failed == false) {
                    var rData = req.data;
                    elmTarget.find('img').attr('src', function() {
                        return this.src.replace('_unfold','_fold');
                    });

                    self.changeFoldImg(obj);

                    var aHtml = [];
                    aHtml.push('<tr id="content_view">');
                    aHtml.push('    <td colspan='+elmTarget.parents('tr').find('td:not(.displaynone)').length+'>');
                    if (rData.content_image != null) aHtml.push(''+rData.content_image+'<br />');
                    if (typeof(rData.content) != 'undefined') {
                        aHtml.push(rData.content); 
                    }
                    aHtml.push('    </td>');
                    aHtml.push('</tr>');

                    elmTarget.parents('tr').after(aHtml.join(''));
                } else {
                    BOARD.setBulletinSpreadFail(req.data);
                };
            }, 'json');
        }
    },
    setBulletinSpreadFail : function (sFailType)
    {
        switch(sFailType) {
            case 'S' :
                alert(__('비밀글은 미리보기가 불가 합니다.'));
                break;
            case 'M' :
                alert(__('회원에게만 읽기 권한이 있습니다'));
                break;
            case 'A' :
                alert(__('관리자에게만 읽기 권한이 있습니다'));
                break;
        }
    },

    /**
     * 폴딩 이미지 변환
     * 현재 클릭한 이미지 이외에는 모두 '닫힘' 이미지로 만들기 위함
     *
     * @param HtmlElement obj
     */
    changeFoldImg : function(obj) {
        var elmEventList = $('[onclick*="BOARD.viewTarget"]');

        elmEventList.each(function(){
            if (obj !== this) {
                $(this).find('img').attr('src', function() {
                    return this.src.replace('_fold','_unfold');
                });
            }
        });
    },

    /**
     * 관리자 댓글보기 (관리자전용)
     */
    pre_comment : function()
    {
        this.OpenWindow('/admin/php/b/board_admin_pre_comment_l.php?mode=popup', 'pre_comment', '800', '500','auto');
    },

    /**
     * 첨부이미지 미리보기
     * @param sId
     * @param sFlag
     */
    afile_display : function (sId, sFlag)
    {
        if (sFlag == 1) {
            $('#'+sId).css('display', '');
            $('#'+sId).css('position', 'absolute');
        } else {
            $('#'+sId).css('display', 'none');
        }
    },
    
    /**
     * 첨부이미지 로딩
     * @param sId 로드될 타겟 아이디
     * @param sFlag 노출여부
     * @param iBoardNo 게시판 번호
     */
    load_attached_image : function(sId, sFlag, iBoardNo)
    {
        /*
         * 게시물 번호 계산
         * sId는 항상 "afile_" 이 prefix 됨 
         */
        var iBulletinNo = sId.substr(6,sId.length);
        
        //큐에서 해당 게시물의 이미지가 로드중 또는 로드되었는지 체크
        var iPosition = $.inArray(iBulletinNo, this.aAttachImageLoadQueue);

        var oTarget = $('#'+sId);
        
        //큐 체크
        if (iPosition === -1) {
            this.aAttachImageLoadQueue.push(iBulletinNo);
            
            var sRequestUrl = '/exec/front/Board/Get?no='+ iBulletinNo +'&board_no='+iBoardNo;
            $.get(sRequestUrl, function(oResponse){
                //로드 성공
                if (oResponse.failed === false) {
                    oTarget.append(oResponse.data.thumbnail_image);
                    BOARD.afile_display(sId, sFlag);
                } 
                //로드 실패
                else {
                    //큐에서 제거처리하여, 다시 로드 가능하도록 변경
                    BOARD.aAttachImageLoadQueue.splice(iPosition,1);
                }
            },'json');
        }
        
        //이미지 존재 체크
        if (oTarget.children().is('img') === true) {
            BOARD.afile_display(sId, sFlag);
        }
    },

    /**
     * 게시판 목록 선택 갯수 체크
     * @param listName
     * @returns {Array}
     */
    check_nos : function(listName)
    {
        var aNo = [];

        $("." + listName).each(function(){
            if ( this.checked ) {
                aNo.push( this.value );
            }
        });

        return aNo;
    },

    /**
     * window.open
     * @param StrPage
     * @param StrName
     * @param w
     * @param h
     * @param scrolls
     */
    OpenWindow : function(StrPage, StrName, w, h,scrolls)
    {
        var win = null;
        var winl = (screen.width-w)/2;
        var wint = (screen.height-h)/3;
        settings = 'height='+h+',';
        settings += 'width='+w+',';
        settings += 'top='+wint+',';
        settings += 'left='+winl+',';
        settings += 'scrollbars='+scrolls+',';
        settings += 'resizable=no,';
        settings += 'status=no';

        // SSL 적용 (ECHOSTING-214739)
        if (StrPage.indexOf('http') != 0) {
            StrPage = window.location.protocol + '//' + window.location.host + StrPage;
        }

        win = window.open(StrPage, StrName, settings);
        if (parseInt(navigator.appVersion)>=4) {
            win.window.focus();
        }
    },
    
    /**
     * 상품 분류 검색 셀렉터
     */
    setProductCategorySelector : {
        /*
         * 중,소,세 분류 초기화
         */
        resetCategory : function(oSelectBox)
        {
            for (var i=oSelectBox.children().length - 1; i>0; i--) {
                oSelectBox.children().eq(i).remove();
            }
        },
        
        /*
         * 하위분류 가져오기
         */
        getChildCategory : function(iProductCategoryNumber, oSelectBox)
        {
            var regexp = /[0-9]+/;
            if (regexp.test(iProductCategoryNumber) === false || oSelectBox.length === 0) return ;
            
            var sUrl = "/exec/front/Product/SubCategory?parent_cate_no="+iProductCategoryNumber;
            $.get(sUrl, function(oResponse) {
                BOARD.setProductCategorySelector.setChildCategory(oSelectBox, oResponse);
            }, 'json');
        },
        
        /*
         * 하위분류 가져오기 Callback 함수
         * 하위분류 셀렉트박스 옵션추가
         */
        setChildCategory : function(oSelectBox, aChildCategory)
        {
            if (aChildCategory.length === 0 || oSelectBox.length === 0) return ;
            
            var sOption = '';
            for (var i=0; i<aChildCategory.length; i++) {
                sOption += "<option value='"+ aChildCategory[i]['category_no'] +"'>"+ aChildCategory[i]['category_name'] +"</option>";
            }
            oSelectBox.append(sOption);
        },
        
        /**
         * 이벤트 바인딩
         */
        setEvent : function()
        {
            var oSelector = BOARD.setProductCategorySelector;
            /*
             * 1뎁스 변경처리
             * - 중,소,세 분류 초기화
             * - 중분류 옵션 추가
             */
            $("#product_category_depth1").change(function(){
                if ($(this).val() !== $(this).attr("history")) {
                    oSelector.resetCategory($("#product_category_depth2"));
                    oSelector.resetCategory($("#product_category_depth3"));
                    oSelector.resetCategory($("#product_category_depth4"));
                    $(this).attr("history", $(this).val());
                }
                
                oSelector.getChildCategory($(this).val(), $("#product_category_depth2"));
            });
            
            /*
             * 2뎁스 변경처리
             * - 소,세분류 초기화
             * - 소분류 옵션 추가
             */
            $("#product_category_depth2").change(function(){
                if ($(this).val() !== $(this).attr("history")) {
                    oSelector.resetCategory($("#product_category_depth3"));
                    oSelector.resetCategory($("#product_category_depth4"));
                    $(this).attr("history", $(this).val());
                }
                
                oSelector.getChildCategory($(this).val(), $("#product_category_depth3"));
            });
            
            /*
             * 3뎁스 변경처리
             * - 세분류 초기화
             * - 세분류 옵션 추가
             */
            $("#product_category_depth3").change(function(){
                if ($(this).val() !== $(this).attr("history")) {
                    oSelector.resetCategory($("#product_category_depth4"));
                    $(this).attr("history", $(this).val());
                }
                
                oSelector.getChildCategory($(this).val(), $("#product_category_depth4"));
            });
        }
    },

    /**
     * 캡차 새로고침
     */
    refresh_captcha : function(sType, iNo)
    {
        var sCaptchaId = 'captcha_' + sType;
        if (iNo != '') sCaptchaId += '_' + iNo;

        $('#'+sCaptchaId).attr('src', '/exec/front/board/captcha?no='+iNo+'&type='+sType+'&'+new Date().getTime());
    },

    END : function() {}
};

/**
 * 접속통계 & 실시간접속통계
 */
$(document).ready(function(){
    // 이미 weblog.js 실행 되었을 경우 종료 
    if ($('#log_realtime').length > 0) {
        return;
    }
    /*
     * QueryString에서 디버그 표시 제거
     */
    function stripDebug(sLocation)
    {
        if (typeof sLocation != 'string') return '';

        sLocation = sLocation.replace(/^d[=]*[\d]*[&]*$/, '');
        sLocation = sLocation.replace(/^d[=]*[\d]*[&]/, '');
        sLocation = sLocation.replace(/(&d&|&d[=]*[\d]*[&]*)/, '&');

        return sLocation;
    }

    if (window.self == window.top) {
        var rloc = escape(document.location);
        var rref = escape(document.referrer);
    } else {
        var rloc = (document.location).pathname;
        var rref = '';
    }

    // realconn & Ad aggregation
    var _aPrs = new Array();
    _sUserQs = window.location.search.substring(1);
    _sUserQs = stripDebug(_sUserQs);
    _aPrs[0] = 'rloc='+rloc;
    _aPrs[1] = 'rref='+rref;
    _aPrs[2] = 'udim='+window.screen.width+'*'+window.screen.height;
    _aPrs[3] = 'rserv='+aLogData.log_server2;
    _aPrs[4] = 'cid='+eclog.getCid();
    _aPrs[5] = 'role_path=' + $('meta[name="path_role"]').attr('content');

    // 모바일웹일 경우 추가 파라미터 생성
    var _sMobilePrs = '';
    if (mobileWeb === true) _sMobilePrs = '&mobile=T&mobile_ver=new';

    _sUrlQs = _sUserQs + '&' + _aPrs.join('&') + _sMobilePrs;
    
    var _sUrlFull = '/exec/front/eclog/main/?'+_sUrlQs;
    
    var node = document.createElement('iframe');
    node.setAttribute('src', _sUrlFull);
    node.setAttribute('id', 'log_realtime');
    document.body.appendChild(node);
    
    $('#log_realtime').hide();
    
    // eclog2.0, eclog1.9
    var sTime = new Date().getTime();//ECHOSTING-54575

    // 접속통계 서버값이 있다면 weblog.js 호출 
    if (aLogData.log_server1 != null && aLogData.log_server1 != '') {
        var sScriptSrc = '//' + aLogData.log_server1 + '/weblog.js?uid=' + aLogData.mid + '&uname=' + aLogData.mid + '&r_ref=' + document.referrer;
        if (mobileWeb === true) sScriptSrc += '&cafe_ec=mobile';
        sScriptSrc += '&t=' + sTime;//ECHOSTING-54575
        var node = document.createElement('script');
        node.setAttribute('type', 'text/javascript');
        node.setAttribute('src', sScriptSrc);
        node.setAttribute('id', 'log_script');
        document.body.appendChild(node);
    }
});

/**
 * 비동기식 데이터
 */
var CAPP_ASYNC_METHODS = {
    DEBUG: false,
    IS_LOGIN: (document.cookie.match(/(?:^| |;)iscache=F/) ? true : false),
    EC_PATH_ROLE: $('meta[name="path_role"]').attr('content') || '',
    aDatasetList: [],
    $xansMyshopMain: $('.xans-myshop-main'),
    init : function()
    {
    	var bDebug = CAPP_ASYNC_METHODS.DEBUG;

        var aUseModules = [];
        var aNoCachedModules = [];

        $(CAPP_ASYNC_METHODS.aDatasetList).each(function(){
            var sKey = this;

            var oTarget = CAPP_ASYNC_METHODS[sKey];

            if (bDebug) {
                console.log(sKey);
            }
            var bIsUse = oTarget.isUse();
            if (bDebug) {
                console.log('   isUse() : ' + bIsUse);
            }

            if (bIsUse === true) {
                aUseModules.push(sKey);

                if (oTarget.restoreCache === undefined || oTarget.restoreCache() === false) {
                    if (bDebug) {
                        console.log('   restoreCache() : true');
                    }
                    aNoCachedModules.push(sKey);
                }
            }
        });

        if (aNoCachedModules.length > 0) {
            var sEditor = '';
            try {
                if (bEditor === true) {
                    // 에디터에서 접근했을 경우 임의의 상품 지정
                    sEditor = '&PREVIEW_SDE=1';
                }
            } catch(e) { }

            var sPathRole = '&path_role=' + CAPP_ASYNC_METHODS.EC_PATH_ROLE;

            $.ajax(
            {
                url : '/exec/front/manage/async?module=' + aNoCachedModules.join(',') + sEditor + sPathRole,
                dataType : 'json',
                success : function(aData)
                {
                	CAPP_ASYNC_METHODS.setData(aData, aUseModules);
                }
            });

        } else {
        	CAPP_ASYNC_METHODS.setData({}, aUseModules);

        }
    },
    setData : function(aData, aUseModules)
    {
        aData = aData || {};

        $(aUseModules).each(function(){
            var sKey = this;

            var oTarget = CAPP_ASYNC_METHODS[sKey];

            if (oTarget.setData !== undefined && aData.hasOwnProperty(sKey) === true) {
                oTarget.setData(aData[sKey]);
            }

            if (oTarget.execute !== undefined) {
                oTarget.execute();
            }
        });
    }
};
/**
 * 비동기식 데이터 - 최근 본 상품 - 보여줄 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('recentViewConfig');
CAPP_ASYNC_METHODS.recentViewConfig = {
    STORAGE_KEY: 'localRecentViewConfig' +  EC_SDE_SHOP_NUM,

    __iViewCount: null,
    __sAdult19Warning: 'F',
    __sAdult19BaseImage: null,

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.recent.isUse() === false) {
            return false;
        }

        if (window.sessionStorage === undefined) {
            return false;
        }

        return true;
    },

    restoreCache: function()
    {
        if (window.sessionStorage === undefined) {
            return false;
        }

        var sSessionStorageDataWrapedJson = window.sessionStorage.getItem(this.STORAGE_KEY);
        if (sSessionStorageDataWrapedJson === null) {
            return false;
        }
        this.__setConfigs(sSessionStorageDataWrapedJson);
        return true;
    },

    setData: function(sData)
    {
        var aData = new Array();
        aData.push('"adult19BaseTinyImage":"' + sData.adult19BaseTinyImage + '"');
        aData.push('"adult19Warning":"' + sData.adult19Warning + '"');
        aData.push('"viewCount":"' + sData.viewCount + '"');

        var sDataWrapedJson = '{' + aData.join(",") + '}'; //JSON.stringify(sData); IE7 NOT COMPATIBLE

        try {
            window.sessionStorage.setItem(this.STORAGE_KEY, sDataWrapedJson);
        } catch (error) {
        }
        this.__setConfigs(sDataWrapedJson);
    },

    getViewCount: function()
    {
        return this.__iViewCount;
    },

    getAdult19Warning: function()
    {
        return this.__sAdult19Warning;
    },

    getAdult19BaseImage: function()
    {
        return this.__sAdult19BaseImage;
    },


    __setConfigs: function(sDataJson)
    {
        var aRecentViewConfig = $.parseJSON(sDataJson);

        var sAdult19Warning = aRecentViewConfig['adult19Warning'];
        if (sAdult19Warning !== 'T') {
            sAdult19Warning = 'F'
        };
        this.__sAdult19Warning = sAdult19Warning;

        this.__sAdult19BaseImage = aRecentViewConfig['adult19BaseTinyImage'];
        this.__iViewCount = Number(aRecentViewConfig['viewCount']);

    }

};
/**
 * 비동기식 데이터 - 회원 정보
 */
CAPP_ASYNC_METHODS.aDatasetList.push('member');
CAPP_ASYNC_METHODS.member = {
    __sEncryptedString: null,
    __isAdult: 'F',

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if ($('.xans-layout-statelogon, .xans-layout-logon').length > 0) {
                return true;
            }

            if (CAPP_ASYNC_METHODS.recentViewConfig.getAdult19Warning() === 'T' && CAPP_ASYNC_METHODS.recent.isUse() === true) {
                return true;
            }
        }
        return false;
    },

    setData: function(oData)
    {
        this.__sEncryptedString = oData.memberData;
        this.__isAdult = oData.memberIsAdult;
    },

    execute: function()
    {
        AuthSSLManager.weave({
            'auth_mode'          : 'decryptClient',
            'auth_string'        : this.__sEncryptedString,
            'auth_callbackName'  : 'CAPP_ASYNC_METHODS.member.setDataCallback'
       });
    },

    setDataCallback: function(output)
    {
        try {
            var output = decodeURIComponent(output);

            if ( AuthSSLManager.isError(output) == true ) {
                alert(output);
                return;
            }

            var aData = AuthSSLManager.unserialize(output);
            
            // 친구초대
            if ($('.xans-myshop-asyncbenefit').size() > 0) {
                $('#reco_url').attr({value: $('#reco_url').val() + aData['id']});
            }

            for (var k in aData) {
                $('.xans-member-var-' + k).html(aData[k]);
            }
        } catch(e) {}
    },

    getMemberIsAdult: function()
    {
        return this.__isAdult;
    }
};

/**
 * 비동기식 데이터 - 예치금
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Ordercnt');
CAPP_ASYNC_METHODS.Ordercnt = {
    __iOrderShppiedBeforeCount: null,
    __iOrderShppiedStandbyCount: null,
    __iOrderShppiedBeginCount: null,
    __iOrderShppiedComplateCount: null,
    __iOrderShppiedCancelCount: null,
    __iOrderShppiedExchangeCount: null,
    __iOrderShppiedReturnCount: null,

    __$target: $('#xans_myshop_orderstate_shppied_before_count'),
    __$target2: $('#xans_myshop_orderstate_shppied_standby_count'),
    __$target3: $('#xans_myshop_orderstate_shppied_begin_count'),
    __$target4: $('#xans_myshop_orderstate_shppied_complate_count'),
    __$target5: $('#xans_myshop_orderstate_order_cancel_count'),
    __$target6: $('#xans_myshop_orderstate_order_exchange_count'),
    __$target7: $('#xans_myshop_orderstate_order_return_count'),

    isUse: function()
    {
        if ($('.xans-myshop-orderstate').length > 0) {
            return true; 
        }

        return false;
    },

    setData: function(aData)
    {
        this.__iOrderShppiedBeforeCount = aData['shipped_before_count'];
        this.__iOrderShppiedStandbyCount = aData['shipped_standby_count'];
        this.__iOrderShppiedBeginCount = aData['shipped_begin_count'];
        this.__iOrderShppiedComplateCount = aData['shipped_complate_count'];
        this.__iOrderShppiedCancelCount = aData['order_cancel_count'];
        this.__iOrderShppiedExchangeCount = aData['order_exchange_count'];
        this.__iOrderShppiedReturnCount = aData['order_return_count'];
    },

    execute: function()
    {
        this.__$target.html(this.__iOrderShppiedBeforeCount);
        this.__$target2.html(this.__iOrderShppiedStandbyCount);
        this.__$target3.html(this.__iOrderShppiedBeginCount);
        this.__$target4.html(this.__iOrderShppiedComplateCount);
        this.__$target5.html(this.__iOrderShppiedCancelCount);
        this.__$target6.html(this.__iOrderShppiedExchangeCount);
        this.__$target7.html(this.__iOrderShppiedReturnCount);
    }
};
/**
 * 비동기식 데이터 - 장바구니 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Basketcnt');
CAPP_ASYNC_METHODS.Basketcnt = {
    __iBasketCount: null,

    __$target: $('.xans-layout-orderbasketcount span a'),
    __$target2: $('#xans_myshop_basket_cnt'),
    __$target3: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_basket_cnt'),
    __$target4: $('.EC-Layout-Basket-count'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        if (this.__$target2.length > 0) {
            return true;
        }
        if (this.__$target3.length > 0) {
            return true;
        }
        
        if (this.__$target4.length > 0) {
            return true;
        }

        return false;
    },
    restoreCache: function()
    {
        var sCookieName = 'basketcount_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iBasketCount = parseInt(aCookieValue[1], 10);
            return true;
        }
        
        return false;
    },
    setData: function(sData)
    {
        this.__iBasketCount = Number(sData);
    },
    execute: function()
    {
        this.__$target.html(this.__iBasketCount);

        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target2.html(this.__iBasketCount + '개');
        } else {
            this.__$target2.html(this.__iBasketCount);
        }

        this.__$target3.html(this.__iBasketCount);
        
        this.__$target4.html(this.__iBasketCount);
        
        if (this.__iBasketCount > 0 && this.__$target4.length > 0) {
        	var $oCountDisplay = $('.EC-Layout_Basket-count-display');
        	
        	if ($oCountDisplay.length > 0) {
        		$oCountDisplay.removeClass('displaynone');
        	}
        	
        }
    }
};
/**
 * 비동기식 데이터 - 장바구니 금액
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Basketprice');
CAPP_ASYNC_METHODS.Basketprice = {
    __sBasketPrice: null,

    __$target: $('#xans_myshop_basket_price'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }

        return false;
    },
    restoreCache: function()
    {
        var sCookieName = 'basketprice_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__sBasketPrice = decodeURIComponent((aCookieValue[1]+ '').replace(/\+/g, '%20'));
            return true;
        }
        
        return false;
    },
    setData: function(sData)
    {
        this.__sBasketPrice = sData;
    },

    execute: function()
    {
        this.__$target.html(this.__sBasketPrice);
    }
};
/**
 * 비동기식 데이터 - 쿠폰 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Couponcnt');
CAPP_ASYNC_METHODS.Couponcnt = {
    __iCouponCount: null,

    __$target: $('.xans-layout-myshopcouponcount'),
    __$target2: $('#xans_myshop_coupon_cnt'),
    __$target3: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_coupon_cnt'),
    __$target4: $('#xans_myshop_bankbook_coupon_cnt'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
            
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }
            
            if (this.__$target4.length > 0) {
                return true;
            }            
        }

        return false;
    },
    
    restoreCache: function()
    {
        var sCookieName = 'couponcount_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iCouponCount = parseInt(aCookieValue[1], 10);
            return true;
        }
        
        return false;
    },
    setData: function(sData)
    {
        this.__iCouponCount = Number(sData);
    },

    execute: function()
    {
        this.__$target.html(this.__iCouponCount);

        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target2.html(this.__iCouponCount + '개');
        } else {
            this.__$target2.html(this.__iCouponCount);
        }

        this.__$target3.html(this.__iCouponCount);
        this.__$target4.html(this.__iCouponCount);
    }
};
/**
 * 비동기식 데이터 - 적립금
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Mileage');
CAPP_ASYNC_METHODS.Mileage = {
    __sMileage: null,
    __sUsedMileage: null,
    __sTotalMileage: null,
    __sUnavailMileage: null,
    __sReturnedMileage: null,

    __$target: $('#xans_myshop_mileage'),
    __$target2: $('#xans_myshop_bankbook_avail_mileage, #xans_myshop_summary_avail_mileage'),
    __$target3: $('#xans_myshop_bankbook_used_mileage, #xans_myshop_summary_used_mileage'),
    __$target4: $('#xans_myshop_bankbook_total_mileage, #xans_myshop_summary_total_mileage'),
    __$target5: $('#xans_myshop_summary_unavail_mileage'),
    __$target6: $('#xans_myshop_summary_returned_mileage'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
      
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }       
            
            if (this.__$target4.length > 0) {
                return true;
            }     
            
            if (this.__$target5.length > 0) {
                return true;
            }  
            
            if (this.__$target6.length > 0) {
                return true;
            }              
        }

        return false;
    },

    setData: function(aData)
    {
        this.__sMileage = aData['avail_mileage'];
        this.__sUsedMileage = aData['used_mileage'];
        this.__sTotalMileage = aData['total_mileage'];
        this.__sUnavailMileage = aData['unavail_mileage'];
        this.__sReturnedMileage = aData['returned_mileage'];
    },

    execute: function()
    {
        this.__$target.html(this.__sMileage);
        this.__$target2.html(this.__sMileage);
        this.__$target3.html(this.__sUsedMileage);
        this.__$target4.html(this.__sTotalMileage);
        this.__$target5.html(this.__sUnavailMileage);
        this.__$target6.html(this.__sReturnedMileage);
    }
};
/**
 * 비동기식 데이터 - 예치금
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Deposit');
CAPP_ASYNC_METHODS.Deposit = {
    __sDeposit: null,
    __sAllDeposit: null,
    __sUsedDeposit: null,
    __sRefundWaitDeposit: null,

    __$target: $('#xans_myshop_deposit'),
    __$target2: $('#xans_myshop_bankbook_deposit'),
    __$target3: $('#xans_myshop_summary_deposit'),
    __$target4: $('#xans_myshop_summary_all_deposit'),
    __$target5: $('#xans_myshop_summary_used_deposit'),
    __$target6: $('#xans_myshop_summary_refund_wait_deposit'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
            
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }  
            
            if (this.__$target4.length > 0) {
                return true;
            }  
            
            if (this.__$target5.length > 0) {
                return true;
            }  
            
            if (this.__$target6.length > 0) {
                return true;
            }  
        }

        return false;
    },

    setData: function(aData)
    {
        this.__sDeposit = aData['total_deposit'];
        this.__sAllDeposit = aData['all_deposit'];
        this.__sUsedDeposit = aData['used_deposit'];
        this.__sRefundWaitDeposit = aData['deposit_refund_wait'];
        this.__sDepositUnit = aData['deposit_unit'];
    },

    execute: function()
    {
        this.__$target.html(this.__sDeposit);
        this.__$target2.html(this.__sDeposit);
        this.__$target3.html(this.__sDeposit);
        this.__$target4.html(this.__sAllDeposit);
        this.__$target5.html(this.__sUsedDeposit);
        this.__$target6.html(this.__sRefundWaitDeposit);        
    }
};
/**
 * 비동기식 데이터 - 관심상품 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Wishcount');
CAPP_ASYNC_METHODS.Wishcount = {
    __iWishCount: null,

    __$target: $('#xans_myshop_interest_prd_cnt'),
    __$target2: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_interest_prd_cnt'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        if (this.__$target2.length > 0) {
            return true;
        }
        return false;
    },

    restoreCache: function()
    {
        var sCookieName = 'wishcount_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iWishCount = parseInt(aCookieValue[1], 10);
            return true;
        }

        return false;
    },

    setData: function(sData)
    {
        this.__iWishCount = Number(sData);
    },

    execute: function()
    {
        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target.html(this.__iWishCount + '개');
        } else {
            this.__$target.html(this.__iWishCount);
        }

        this.__$target2.html(this.__iWishCount);
    }
};
/**
 * 비동기식 데이터 - 최근 본 상품
 */
CAPP_ASYNC_METHODS.aDatasetList.push('recent');
CAPP_ASYNC_METHODS.recent = {
    STORAGE_KEY: 'localRecentProduct' +  EC_SDE_SHOP_NUM,

    __$target: $('.xans-layout-productrecent'),

    __aData: null,

    isUse: function()
    {
        this.__$target.hide();

        if (this.__$target.find('.xans-record-').length > 0) {
            return true;
        }

        return false;
    },

    restoreCache: function()
    {
        this.__aData = [];

        var iTotalCount = CAPP_ASYNC_METHODS.RecentTotalCount.getData();
        if (iTotalCount == 0) {
            // 총 갯수가 없는 경우 복구할 것이 없으므로 복구한 것으로 리턴
            return true;
        }

        var sAdultImage = '';

        if (window.sessionStorage === undefined) {
            return false;
        }

        var sSessionStorageData = window.sessionStorage.getItem(this.STORAGE_KEY);
        if (sSessionStorageData === null) {
            return false;
        }

        var iViewCount = CAPP_ASYNC_METHODS.recentViewConfig.getViewCount();

        this.__aData = [];
        var aStorageData = $.parseJSON(sSessionStorageData);
        var iCount = 1;
        var bDispRecent = true;
        for (var iKey in aStorageData) {
            var sProductImgSrc = aStorageData[iKey].sImgSrc;

            if (isFinite(iKey) === false) {
                continue;
            }

            var aDataTmp = [];
            aDataTmp.recent_img = getImageUrl(sProductImgSrc);
            aDataTmp.name = aStorageData[iKey].sProductName;
            aDataTmp.disp_recent = true;
            aDataTmp.is_adult_product = aStorageData[iKey].isAdultProduct;
            aDataTmp.link_product_detail = aStorageData[iKey].link_product_detail;

            //aDataTmp.param = '?product_no=' + aStorageData[iKey].iProductNo + '&cate_no=' + aStorageData[iKey].iCateNum + '&display_group=' + aStorageData[iKey].iDisplayGroup;
            aDataTmp.param = filterXssUrlParameter(aStorageData[iKey].sParam);
            if ( iViewCount < iCount ) {
                bDispRecent = false;
            }
            aDataTmp.disp_recent = bDispRecent;

            iCount++;
            this.__aData.push(aDataTmp);
        }

        return true;

        /**
         * get SessionStorage image url
         * @param sNewImgUrl DB에 저장되어 있는 tiny값
         */
        function getImageUrl(sImgUrl)
        {
            if ( typeof(sImgUrl) === 'undefined' || sImgUrl === null) {
                return;
            }
            var sNewImgUrl = '';

            if ( sImgUrl.indexOf('http://') >= 0 || sImgUrl.indexOf('https://')  >= 0 || sImgUrl.substr(0, 2) === '//') {
                sNewImgUrl = sImgUrl;
            } else {
                sNewImgUrl = '/web/product/tiny/' +  sImgUrl;
            }

            return sNewImgUrl;
        }

        /**
         * 파라미터 URL에서 XSS 공격 관련 파라미터를 필터링합니다. ECHOSTING-162977
         * @param string sParam 파라미터
         * @return string 필터링된 파라미터
         */
        function filterXssUrlParameter(sParam)
        {
            sParam = sParam || '';

            var sPrefix = '';
            if (sParam.substr(0, 1) === '?') {
                sPrefix = '?';
                sParam = sParam.substr(1);
            }

            var aParam = {};

            var aParamList = (sParam).split('&');
            $.each(aParamList, function() {
                var aMatch = this.match(/^([^=]+)=(.*)$/);
                if (aMatch) {
                    aParam[aMatch[1]] = aMatch[2];
                }
            });

            return sPrefix + $.param(aParam);
        }

    },

    setData: function(aData)
    {
        this.__aData = aData;

        // 쿠키엔 있지만 sessionStorage에 없는 데이터 복구
        if (window.sessionStorage) {

            var oNewStorageData = [];

            for ( var i = 0 ; i < aData.length ; i++) {
                if (aData[i].bNewProduct !== true) {
                    continue;
                }

                var aNewStorageData = {
                    'iProductNo': aData[i].product_no,
                    'sProductName': aData[i].name,
                    'sImgSrc': aData[i].recent_img,
                    'sParam': aData[i].param,
                    'link_product_detail': aData[i].link_product_detail
                };

                oNewStorageData.push(aNewStorageData);
            }

            if ( oNewStorageData.length > 0 ) {
                sessionStorage.setItem(this.STORAGE_KEY , $.toJSON(oNewStorageData));
            }
        }
    },

    execute: function()
    {
        var sAdult19Warning = CAPP_ASYNC_METHODS.recentViewConfig.getAdult19Warning();

        var aData = this.__aData;

        var aNodes = this.__$target.find('.xans-record-');
        var iRecordCnt = aNodes.length;
        var iAddedElementCount = 0;

        var aNodesParent = $(aNodes[0]).parent();
        for ( var i = 0 ; i < aData.length ; i++) {
            if (!aNodes[i]) {
                $(aNodes[iRecordCnt - 1]).clone().appendTo(aNodesParent);
                iAddedElementCount++;
            }
        }

        if (iAddedElementCount > 0) {
            aNodes = this.__$target.find('.xans-record-');
        }

        if (aData.length > 0) {
            this.__$target.show();
        }

        for ( var i = 0 ; i < aData.length ; i++) {
            assignVariables(aNodes[i], aData[i]);
        }

        // 종료 카운트 지정
        if (aData.length < aNodes.length) {
            iLength = aData.length;
            deleteNode();
        }

        recentBntInit(this.__$target);

        /**
         * 패치되지 않은 노드를 제거
         */
        function deleteNode()
        {
            for ( var i = iLength ; i < aNodes.length ; i++) {
                $(aNodes[i]).remove();
            }
        }

        /**
         * oTarget 엘레먼트에 aData의 변수를 어싸인합니다.
         * @param Element oTarget 변수를 어싸인할 엘레먼트
         * @param array aData 변수 데이터
         */
        function assignVariables(oTarget, aData)
        {
            var recentImage = aData.recent_img;

            if (sAdult19Warning === 'T' && CAPP_ASYNC_METHODS.member.getMemberIsAdult() === 'F' && aData.is_adult_product === 'T') {
                    recentImage = CAPP_ASYNC_METHODS.recentViewConfig.getAdult19BaseImage();
            };

            var $oTarget = $(oTarget);

            var sHtml = $oTarget.html();

            sHtml = sHtml.replace('about:blank', recentImage)
                         .replace('##param##', aData.param)
                         .replace('##name##',aData.name)
                         .replace('##link_product_detail##', aData.link_product_detail);
            $oTarget.html(sHtml);

            if (aData.disp_recent === true) {
                $oTarget.removeClass('displaynone');
            }
        }

        function recentBntInit($target)
        {
            // 화면에 뿌려진 갯수
            var iDisplayCount = 0;
            // 보여지는 style
            var sDisplay = '';
            var iIdx = 0;
            //
            var iDisplayNoneIdx = 0;

            var nodes = $target.find('.xans-record-').each(function()
            {
                sDisplay = $(this).css('display');
                if (sDisplay != 'none') {
                    iDisplayCount++;
                } else {
                    if (iDisplayNoneIdx == 0) {
                        iDisplayNoneIdx = iIdx;
                    }

                }
                iIdx++;
            });

            var iRecentCount = nodes.length;
            var bBtnActive = iDisplayCount > 0;
            $('.xans-layout-productrecent .prev').unbind('click').click(function()
            {
                if (bBtnActive !== true) return;
                var iFirstNode = iDisplayNoneIdx - iDisplayCount;
                if (iFirstNode == 0 || iDisplayCount == iRecentCount) {
                    alert(__('최근 본 첫번째 상품입니다.'));
                    return;
                } else {
                    iDisplayNoneIdx--;
                    $(nodes[iDisplayNoneIdx]).hide();
                    $(nodes[iFirstNode - 1]).removeClass('displaynone');
                    $(nodes[iFirstNode - 1]).fadeIn('fast');

                }
            }).css(
            {
                cursor : 'pointer'
            });

            $('.xans-layout-productrecent .next').unbind('click').click(function()
            {
                if (bBtnActive !== true) return;
                if ( (iRecentCount ) == iDisplayNoneIdx || iDisplayCount == iRecentCount) {
                    alert(__('최근 본 마지막 상품입니다.'));
                } else {
                    $(nodes[iDisplayNoneIdx]).fadeIn('fast');
                    $(nodes[iDisplayNoneIdx]).removeClass('displaynone');
                    $(nodes[ (iDisplayNoneIdx - iDisplayCount)]).hide();
                    iDisplayNoneIdx++;
                }
            }).css(
            {
                cursor : 'pointer'
            });

        }

    }
};

/**
 * 비동기식 데이터 - 최근본상품 총 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('RecentTotalCount');
CAPP_ASYNC_METHODS.RecentTotalCount = {
    __iRecentCount: null,

    __$target: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_recent_cnt'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }

        return false;
    },

    restoreCache: function()
    {
        var sCookieName = 'recent_plist';
        if (EC_SDE_SHOP_NUM > 1) {
            sCookieName = 'recent_plist' + EC_SDE_SHOP_NUM;
        }
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iRecentCount = decodeURI(aCookieValue[1]).split('|').length;
        } else {
            this.__iRecentCount = 0;
        }
    },

    execute: function()
    {
        this.__$target.html(this.__iRecentCount);
    },

    getData: function()
    {
        if (this.__iRecentCount === null) {
            // this.isUse값이 false라서 복구되지 않았는데 이 값이 필요한 경우 복구
            this.restoreCache();
        }

        return this.__iRecentCount;
    }
};
/**
 * 비동기식 데이터 - 주문정보
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Order');
CAPP_ASYNC_METHODS.Order = {
    __iOrderCount: null,
    __iOrderTotalPrice: null,
    __iGradeIncreaseValue: null,

    __$target: $('#xans_myshop_bankbook_order_count'),
    __$target2: $('#xans_myshop_bankbook_order_price'),
    __$target3: $('#xans_myshop_bankbook_grade_increase_value'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {        
            if (this.__$target.length > 0) {
                return true;
            }
            
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }            
        }
        
        return false;        
    },

    setData: function(aData)
    {
        this.__iOrderCount = aData['total_order_count'];
        this.__iOrderTotalPrice = aData['total_order_price'];
        this.__iGradeIncreaseValue = Number(aData['grade_increase_value']);
    },

    execute: function()
    {
        this.__$target.html(this.__iOrderCount);
        this.__$target2.html(this.__iOrderTotalPrice);
        this.__$target3.html(this.__iGradeIncreaseValue);
    }
};
/**
 * 비동기식 데이터 - Benefit
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Benefit');
CAPP_ASYNC_METHODS.Benefit = {
    __aBenefit: null,
    __$target: $('.xans-myshop-asyncbenefit'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
        }

        return false;
    },

    setData: function(aData)
    {
        this.__aBenefit = aData;
    },

    execute: function()
    {
        var aFilter = ['group_image_tag', 'group_icon_tag', 'display_no_benefit', 'display_with_all', 'display_mobile_use_dc', 'display_mobile_use_mileage'];
        var __aData = this.__aBenefit;
        
        // 그룹이미지
        $('.myshop_benefit_group_image_tag').attr({alt: __aData['group_name'], src: __aData['group_image']});

        // 그룹아이콘
        $('.myshop_benefit_group_icon_tag').attr({alt: __aData['group_name'], src: __aData['group_icon']});

        if (__aData['display_no_benefit'] === true) {
            $('.myshop_benefit_display_no_benefit').removeClass('displaynone').show();
        }
        
        if (__aData['display_with_all'] === true) {
            $('.myshop_benefit_display_with_all').removeClass('displaynone').show();
        }
        
        if (__aData['display_mobile_use_dc'] === true) {
            $('.myshop_benefit_display_mobile_use_dc').removeClass('displaynone').show();
        } 
        
        if (__aData['display_mobile_use_mileage'] === true) {
            $('.myshop_benefit_display_mobile_use_mileage').removeClass('displaynone').show();
        }

        $.each(__aData, function(key, val) {
            if ($.inArray(key, aFilter) === -1) {
                $('.myshop_benefit_' + key).html(val);
            }
        });
    }    
};
/**
 * 비동기식 데이터 - 비동기장바구니 레이어
 */
CAPP_ASYNC_METHODS.aDatasetList.push('BasketLayer');
CAPP_ASYNC_METHODS.BasketLayer = {
    __sBasketLayerHtml: null,
    __$target: $('#ec_async_basket_layer_container'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        return false;
    },

    execute: function()
    {
        $.ajax({
            url: '/order/async_basket_layer.html?__popupPage=T',
            async: false,
            success: function(data) {
                var sBasketLayerHtml = data;
                var sBasketLayerStyle = '';
                var sBasketLayerBody = '';

                sBasketLayerHtml = sBasketLayerHtml.replace(/<script([\s\S]*?)<\/script>/gi,''); // 스크립트 제거
                sBasketLayerHtml = sBasketLayerHtml.replace(/<link([\s\S]*?)\/>/gi,''); // 옵티마이져 제거

                var regexStyle = /<style([\s\S]*?)<\/style>/; // Style 추출
                if (regexStyle.exec(sBasketLayerHtml) != null) sBasketLayerStyle = regexStyle.exec(sBasketLayerHtml)[0];

                var regexBody = /<body[\s\S]*?>([\s\S]*?)<\/body>/; // Body 추출
                if (regexBody.exec(sBasketLayerHtml) != null) sBasketLayerBody = regexBody.exec(sBasketLayerHtml)[1];

                CAPP_ASYNC_METHODS.BasketLayer.__sBasketLayerHtml = sBasketLayerStyle + sBasketLayerBody;
            }
        });
        this.__$target.html(this.__sBasketLayerHtml);
    }
};
/**
 * 비동기식 데이터 - Benefit
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Grade');
CAPP_ASYNC_METHODS.Grade = {
    __aGrade: null,
    __$target: $('.xans-myshop-asyncbenefit'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
        }

        return false;
    },

    setData: function(aData)
    {
        this.__aGrade = aData;
    },

    execute: function()
    {
        var __aData = this.__aGrade;
        var aFilter = ['bChangeMaxTypePrice', 'bChangeMaxTypePriceAndCount', 'bChangeMaxTypePriceOrCount', 'bChangeMaxTypeCount'];

        var aMaxDisplayJson = {
            "bChangeMaxTypePrice": [
                {"sId": "sChangeMaxTypePriceArea"}
            ],
            "bChangeMaxTypePriceAndCount": [
                {"sId": "sChangeMaxTypePriceAndCountArea"}
            ],
            "bChangeMaxTypePriceOrCount": [
                {"sId": "sChangeMaxTypePriceOrCountArea"}
            ],
            "bChangeMaxTypeCount": [
                {"sId": "sChangeMaxTypeCountArea"}
            ]
        };

        if ($('.sNextGroupIconArea').length > 0) {
            if (__aData['bDisplayNextGroupIcon'] === true) {
                $('.sNextGroupIconArea').removeClass('displaynone').show();
                $('.myshop_benefit_next_group_icon_tag').attr({alt: __aData['sNextGrade'], src: __aData['sNextGroupIcon']});
            } else {
                $('.sNextGroupIconArea').addClass('displaynone');
            }
        }

        var sIsAutoGradeDisplay = "F";
        $.each(__aData, function(key, val) {
            if ($.inArray(key, aFilter) === -1) {
                return true;
            }
            if (val === true) {
                if ($('#'+aMaxDisplayJson[key][0].sId).length > 0) {
                    $('#' + aMaxDisplayJson[key][0].sId).removeClass('displaynone').show();
                }
                sIsAutoGradeDisplay = "T";
            }
        });
        if (sIsAutoGradeDisplay == "T" && $('#sGradeAutoDisplayArea .sAutoGradeDisplay').length > 0) {
            $('#sGradeAutoDisplayArea .sAutoGradeDisplay').addClass('displaynone');
        }

        $.each(__aData, function(key, val) {
            if ($.inArray(key, aFilter) === -1) {
                if ($('.xans-member-var-' + key).length > 0) {
                    $('.xans-member-var-' + key).html(val);
                }
            }
        });
    }    
};
/**
 * 비동기식 데이터 - 비동기장바구니 레이어
 */
CAPP_ASYNC_METHODS.aDatasetList.push('MobileMutiPopup');
CAPP_ASYNC_METHODS.MobileMutiPopup = {
    __$target: $('div[class^="ec-async-multi-popup-layer-container"]'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        return false;
    },

    execute: function()
    {
        for (var i=0; i < this.__$target.length ; i++) {
            $.ajax({
                url: '/exec/front/popup/AjaxMultiPopup?index='+i,
                data : EC_ASYNC_MULTI_POPUP_OPTION[i],
                dataType: "json",
                success : function (oResult) {
                    switch (oResult.code) {
                        case '0000' :
                            if (oResult.data.length < 1) {
                                break;
                            }
                            $('.ec-async-multi-popup-layer-container-' + oResult.data.html_index).html(oResult.data.html_text);
                            if (oResult.data.type == 'P') {
                                BANNER_POPUP_OPEN.setPopupSetting();
                                BANNER_POPUP_OPEN.setPopupWidth();
                                BANNER_POPUP_OPEN.setPopupClose();
                            } else {
                                /**
                                 * 이중 스크롤 방지 클래스 추가(비동기) 
                                 *
                                 */
                                $('body').addClass('eMobilePopup');
                                $('body').width('100%');

                                BANNER_POPUP_OPEN.setFullPopupSetting();
                                BANNER_POPUP_OPEN.setFullPopupClose();
                            }
                            break;
                        default :
                            break;
                    }
                },
                error : function () {
                }
            });
        }
    }
};
/**
 * 비동기식 데이터 - 좋아요 상품 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('MyLikeProductCount');
CAPP_ASYNC_METHODS.MyLikeProductCount = {
    __iMyLikeCount: null,

    __$target: $('#xans_myshop_like_prd_cnt'),

    isUse: function()
    {
        if (this.__$target.length > 0 && SHOP.getLanguage() === 'ko_KR') {
            return true;
        }

        return false;
    },

    setData: function(sData)
    {
        this.__iMyLikeCount = Number(sData);
    },

    execute: function()
    {
        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target.html(this.__iMyLikeCount + '개');
        }
    }
};
$(document).ready(function()
{
	CAPP_ASYNC_METHODS.init();
});
$(document).ready(function(){
    var prevClick = -1;
    var popupWin;
    
    /**
     * opens poup window
     * @param {String} url
     * @param {Integer} iWidth
     * @param {Integer} iHeight
     * @return {void}
     */
    function open_popup(url, iWidth, iHeight)
    {
        var sPopupName = 'PopupName';
        var sPopipOption = "scrollbars=1, resizable=1, width="+iWidth+" height="+iHeight;
        window.open(url, sPopupName, sPopipOption).focus();
    }
    
    $(".xans-bannermanage2 a").bind("click", function(e){
        e.preventDefault();
            var mode = $(this).parents('.xans-bannermanage2').attr('id');
            var $a = $(this),
                sHref = $a.attr('href'),
                sRel = $a.find('.banner_image').attr("rel"),
                imgSeq = sRel.split("-"),
                target = $a.attr("target"),
                sendArgs = {},
                aaa = null,
                openWindow = [];

            if ( sHref ) {
                sendArgs['seq'] =  imgSeq[0];
                sendArgs['dataSeq'] = imgSeq[1];
                
                if (target === "_blank") {
                    var iWidth = $a.find(".popup_size_width").val();
                    var iHeight = $a.find(".popup_size_height").val();
                    open_popup(sHref, iWidth, iHeight);
                }
                
                $.post( "/cstore-api/bannermanage2/Clickcount?mode=" +mode, sendArgs, function(req) {
                    if ( target === "_parent" ) {
                        parent.location.href = sHref;
                    } else if (target !== '_parent' && target !== '_blank') {
                        location.href = sHref;
                    }
                    return;
                });
            }

        return false;
    });
});

/**
 * Swiper 3.4.1
 * Most modern mobile touch slider and framework with hardware accelerated transitions
 * 
 * http://www.idangero.us/swiper/
 * 
 * Copyright 2016, Vladimir Kharlampidi
 * The iDangero.us
 * http://www.idangero.us/
 * 
 * Licensed under MIT
 * 
 * Released on: December 13, 2016
 */
!function(){"use strict";function e(e){e.fn.swiper=function(a){var s;return e(this).each(function(){var e=new t(this,a);s||(s=e)}),s}}var a,t=function(e,i){function r(e){return Math.floor(e)}function n(){var e=b.params.autoplay,a=b.slides.eq(b.activeIndex);a.attr("data-swiper-autoplay")&&(e=a.attr("data-swiper-autoplay")||b.params.autoplay),b.autoplayTimeoutId=setTimeout(function(){b.params.loop?(b.fixLoop(),b._slideNext(),b.emit("onAutoplay",b)):b.isEnd?i.autoplayStopOnLast?b.stopAutoplay():(b._slideTo(0),b.emit("onAutoplay",b)):(b._slideNext(),b.emit("onAutoplay",b))},e)}function o(e,t){var s=a(e.target);if(!s.is(t))if("string"==typeof t)s=s.parents(t);else if(t.nodeType){var i;return s.parents().each(function(e,a){a===t&&(i=t)}),i?t:void 0}if(0!==s.length)return s[0]}function l(e,a){a=a||{};var t=window.MutationObserver||window.WebkitMutationObserver,s=new t(function(e){e.forEach(function(e){b.onResize(!0),b.emit("onObserverUpdate",b,e)})});s.observe(e,{attributes:"undefined"==typeof a.attributes||a.attributes,childList:"undefined"==typeof a.childList||a.childList,characterData:"undefined"==typeof a.characterData||a.characterData}),b.observers.push(s)}function p(e){e.originalEvent&&(e=e.originalEvent);var a=e.keyCode||e.charCode;if(!b.params.allowSwipeToNext&&(b.isHorizontal()&&39===a||!b.isHorizontal()&&40===a))return!1;if(!b.params.allowSwipeToPrev&&(b.isHorizontal()&&37===a||!b.isHorizontal()&&38===a))return!1;if(!(e.shiftKey||e.altKey||e.ctrlKey||e.metaKey||document.activeElement&&document.activeElement.nodeName&&("input"===document.activeElement.nodeName.toLowerCase()||"textarea"===document.activeElement.nodeName.toLowerCase()))){if(37===a||39===a||38===a||40===a){var t=!1;if(b.container.parents("."+b.params.slideClass).length>0&&0===b.container.parents("."+b.params.slideActiveClass).length)return;var s={left:window.pageXOffset,top:window.pageYOffset},i=window.innerWidth,r=window.innerHeight,n=b.container.offset();b.rtl&&(n.left=n.left-b.container[0].scrollLeft);for(var o=[[n.left,n.top],[n.left+b.width,n.top],[n.left,n.top+b.height],[n.left+b.width,n.top+b.height]],l=0;l<o.length;l++){var p=o[l];p[0]>=s.left&&p[0]<=s.left+i&&p[1]>=s.top&&p[1]<=s.top+r&&(t=!0)}if(!t)return}b.isHorizontal()?(37!==a&&39!==a||(e.preventDefault?e.preventDefault():e.returnValue=!1),(39===a&&!b.rtl||37===a&&b.rtl)&&b.slideNext(),(37===a&&!b.rtl||39===a&&b.rtl)&&b.slidePrev()):(38!==a&&40!==a||(e.preventDefault?e.preventDefault():e.returnValue=!1),40===a&&b.slideNext(),38===a&&b.slidePrev())}}function d(){var e="onwheel",a=e in document;if(!a){var t=document.createElement("div");t.setAttribute(e,"return;"),a="function"==typeof t[e]}return!a&&document.implementation&&document.implementation.hasFeature&&document.implementation.hasFeature("","")!==!0&&(a=document.implementation.hasFeature("Events.wheel","3.0")),a}function u(e){e.originalEvent&&(e=e.originalEvent);var a=0,t=b.rtl?-1:1,s=c(e);if(b.params.mousewheelForceToAxis)if(b.isHorizontal()){if(!(Math.abs(s.pixelX)>Math.abs(s.pixelY)))return;a=s.pixelX*t}else{if(!(Math.abs(s.pixelY)>Math.abs(s.pixelX)))return;a=s.pixelY}else a=Math.abs(s.pixelX)>Math.abs(s.pixelY)?-s.pixelX*t:-s.pixelY;if(0!==a){if(b.params.mousewheelInvert&&(a=-a),b.params.freeMode){var i=b.getWrapperTranslate()+a*b.params.mousewheelSensitivity,r=b.isBeginning,n=b.isEnd;if(i>=b.minTranslate()&&(i=b.minTranslate()),i<=b.maxTranslate()&&(i=b.maxTranslate()),b.setWrapperTransition(0),b.setWrapperTranslate(i),b.updateProgress(),b.updateActiveIndex(),(!r&&b.isBeginning||!n&&b.isEnd)&&b.updateClasses(),b.params.freeModeSticky?(clearTimeout(b.mousewheel.timeout),b.mousewheel.timeout=setTimeout(function(){b.slideReset()},300)):b.params.lazyLoading&&b.lazy&&b.lazy.load(),b.emit("onScroll",b,e),b.params.autoplay&&b.params.autoplayDisableOnInteraction&&b.stopAutoplay(),0===i||i===b.maxTranslate())return}else{if((new window.Date).getTime()-b.mousewheel.lastScrollTime>60)if(a<0)if(b.isEnd&&!b.params.loop||b.animating){if(b.params.mousewheelReleaseOnEdges)return!0}else b.slideNext(),b.emit("onScroll",b,e);else if(b.isBeginning&&!b.params.loop||b.animating){if(b.params.mousewheelReleaseOnEdges)return!0}else b.slidePrev(),b.emit("onScroll",b,e);b.mousewheel.lastScrollTime=(new window.Date).getTime()}return e.preventDefault?e.preventDefault():e.returnValue=!1,!1}}function c(e){var a=10,t=40,s=800,i=0,r=0,n=0,o=0;return"detail"in e&&(r=e.detail),"wheelDelta"in e&&(r=-e.wheelDelta/120),"wheelDeltaY"in e&&(r=-e.wheelDeltaY/120),"wheelDeltaX"in e&&(i=-e.wheelDeltaX/120),"axis"in e&&e.axis===e.HORIZONTAL_AXIS&&(i=r,r=0),n=i*a,o=r*a,"deltaY"in e&&(o=e.deltaY),"deltaX"in e&&(n=e.deltaX),(n||o)&&e.deltaMode&&(1===e.deltaMode?(n*=t,o*=t):(n*=s,o*=s)),n&&!i&&(i=n<1?-1:1),o&&!r&&(r=o<1?-1:1),{spinX:i,spinY:r,pixelX:n,pixelY:o}}function m(e,t){e=a(e);var s,i,r,n=b.rtl?-1:1;s=e.attr("data-swiper-parallax")||"0",i=e.attr("data-swiper-parallax-x"),r=e.attr("data-swiper-parallax-y"),i||r?(i=i||"0",r=r||"0"):b.isHorizontal()?(i=s,r="0"):(r=s,i="0"),i=i.indexOf("%")>=0?parseInt(i,10)*t*n+"%":i*t*n+"px",r=r.indexOf("%")>=0?parseInt(r,10)*t+"%":r*t+"px",e.transform("translate3d("+i+", "+r+",0px)")}function h(e){return 0!==e.indexOf("on")&&(e=e[0]!==e[0].toUpperCase()?"on"+e[0].toUpperCase()+e.substring(1):"on"+e),e}if(!(this instanceof t))return new t(e,i);var g={direction:"horizontal",touchEventsTarget:"container",initialSlide:0,speed:300,autoplay:!1,autoplayDisableOnInteraction:!0,autoplayStopOnLast:!1,iOSEdgeSwipeDetection:!1,iOSEdgeSwipeThreshold:20,freeMode:!1,freeModeMomentum:!0,freeModeMomentumRatio:1,freeModeMomentumBounce:!0,freeModeMomentumBounceRatio:1,freeModeMomentumVelocityRatio:1,freeModeSticky:!1,freeModeMinimumVelocity:.02,autoHeight:!1,setWrapperSize:!1,virtualTranslate:!1,effect:"slide",coverflow:{rotate:50,stretch:0,depth:100,modifier:1,slideShadows:!0},flip:{slideShadows:!0,limitRotation:!0},cube:{slideShadows:!0,shadow:!0,shadowOffset:20,shadowScale:.94},fade:{crossFade:!1},parallax:!1,zoom:!1,zoomMax:3,zoomMin:1,zoomToggle:!0,scrollbar:null,scrollbarHide:!0,scrollbarDraggable:!1,scrollbarSnapOnRelease:!1,keyboardControl:!1,mousewheelControl:!1,mousewheelReleaseOnEdges:!1,mousewheelInvert:!1,mousewheelForceToAxis:!1,mousewheelSensitivity:1,mousewheelEventsTarged:"container",hashnav:!1,hashnavWatchState:!1,history:!1,replaceState:!1,breakpoints:void 0,spaceBetween:0,slidesPerView:1,slidesPerColumn:1,slidesPerColumnFill:"column",slidesPerGroup:1,centeredSlides:!1,slidesOffsetBefore:0,slidesOffsetAfter:0,roundLengths:!1,touchRatio:1,touchAngle:45,simulateTouch:!0,shortSwipes:!0,longSwipes:!0,longSwipesRatio:.5,longSwipesMs:300,followFinger:!0,onlyExternal:!1,threshold:0,touchMoveStopPropagation:!0,touchReleaseOnEdges:!1,uniqueNavElements:!0,pagination:null,paginationElement:"span",paginationClickable:!1,paginationHide:!1,paginationBulletRender:null,paginationProgressRender:null,paginationFractionRender:null,paginationCustomRender:null,paginationType:"bullets",resistance:!0,resistanceRatio:.85,nextButton:null,prevButton:null,watchSlidesProgress:!1,watchSlidesVisibility:!1,grabCursor:!1,preventClicks:!0,preventClicksPropagation:!0,slideToClickedSlide:!1,lazyLoading:!1,lazyLoadingInPrevNext:!1,lazyLoadingInPrevNextAmount:1,lazyLoadingOnTransitionStart:!1,preloadImages:!0,updateOnImagesReady:!0,loop:!1,loopAdditionalSlides:0,loopedSlides:null,control:void 0,controlInverse:!1,controlBy:"slide",normalizeSlideIndex:!0,allowSwipeToPrev:!0,allowSwipeToNext:!0,swipeHandler:null,noSwiping:!0,noSwipingClass:"swiper-no-swiping",passiveListeners:!0,containerModifierClass:"swiper-container-",slideClass:"swiper-slide",slideActiveClass:"swiper-slide-active",slideDuplicateActiveClass:"swiper-slide-duplicate-active",slideVisibleClass:"swiper-slide-visible",slideDuplicateClass:"swiper-slide-duplicate",slideNextClass:"swiper-slide-next",slideDuplicateNextClass:"swiper-slide-duplicate-next",slidePrevClass:"swiper-slide-prev",slideDuplicatePrevClass:"swiper-slide-duplicate-prev",wrapperClass:"swiper-wrapper",bulletClass:"swiper-pagination-bullet",bulletActiveClass:"swiper-pagination-bullet-active",buttonDisabledClass:"swiper-button-disabled",paginationCurrentClass:"swiper-pagination-current",paginationTotalClass:"swiper-pagination-total",paginationHiddenClass:"swiper-pagination-hidden",paginationProgressbarClass:"swiper-pagination-progressbar",paginationClickableClass:"swiper-pagination-clickable",paginationModifierClass:"swiper-pagination-",lazyLoadingClass:"swiper-lazy",lazyStatusLoadingClass:"swiper-lazy-loading",lazyStatusLoadedClass:"swiper-lazy-loaded",lazyPreloaderClass:"swiper-lazy-preloader",notificationClass:"swiper-notification",preloaderClass:"preloader",zoomContainerClass:"swiper-zoom-container",observer:!1,observeParents:!1,a11y:!1,prevSlideMessage:"Previous slide",nextSlideMessage:"Next slide",firstSlideMessage:"This is the first slide",lastSlideMessage:"This is the last slide",paginationBulletMessage:"Go to slide {{index}}",runCallbacksOnInit:!0},f=i&&i.virtualTranslate;i=i||{};var v={};for(var w in i)if("object"!=typeof i[w]||null===i[w]||(i[w].nodeType||i[w]===window||i[w]===document||"undefined"!=typeof s&&i[w]instanceof s||"undefined"!=typeof jQuery&&i[w]instanceof jQuery))v[w]=i[w];else{v[w]={};for(var y in i[w])v[w][y]=i[w][y]}for(var x in g)if("undefined"==typeof i[x])i[x]=g[x];else if("object"==typeof i[x])for(var T in g[x])"undefined"==typeof i[x][T]&&(i[x][T]=g[x][T]);var b=this;if(b.params=i,b.originalParams=v,b.classNames=[],"undefined"!=typeof a&&"undefined"!=typeof s&&(a=s),("undefined"!=typeof a||(a="undefined"==typeof s?window.Dom7||window.Zepto||window.jQuery:s))&&(b.$=a,b.currentBreakpoint=void 0,b.getActiveBreakpoint=function(){if(!b.params.breakpoints)return!1;var e,a=!1,t=[];for(e in b.params.breakpoints)b.params.breakpoints.hasOwnProperty(e)&&t.push(e);t.sort(function(e,a){return parseInt(e,10)>parseInt(a,10)});for(var s=0;s<t.length;s++)e=t[s],e>=window.innerWidth&&!a&&(a=e);return a||"max"},b.setBreakpoint=function(){var e=b.getActiveBreakpoint();if(e&&b.currentBreakpoint!==e){var a=e in b.params.breakpoints?b.params.breakpoints[e]:b.originalParams,t=b.params.loop&&a.slidesPerView!==b.params.slidesPerView;for(var s in a)b.params[s]=a[s];b.currentBreakpoint=e,t&&b.destroyLoop&&b.reLoop(!0)}},b.params.breakpoints&&b.setBreakpoint(),b.container=a(e),0!==b.container.length)){if(b.container.length>1){var S=[];return b.container.each(function(){S.push(new t(this,i))}),S}b.container[0].swiper=b,b.container.data("swiper",b),b.classNames.push(b.params.containerModifierClass+b.params.direction),b.params.freeMode&&b.classNames.push(b.params.containerModifierClass+"free-mode"),b.support.flexbox||(b.classNames.push(b.params.containerModifierClass+"no-flexbox"),b.params.slidesPerColumn=1),b.params.autoHeight&&b.classNames.push(b.params.containerModifierClass+"autoheight"),(b.params.parallax||b.params.watchSlidesVisibility)&&(b.params.watchSlidesProgress=!0),b.params.touchReleaseOnEdges&&(b.params.resistanceRatio=0),["cube","coverflow","flip"].indexOf(b.params.effect)>=0&&(b.support.transforms3d?(b.params.watchSlidesProgress=!0,b.classNames.push(b.params.containerModifierClass+"3d")):b.params.effect="slide"),"slide"!==b.params.effect&&b.classNames.push(b.params.containerModifierClass+b.params.effect),"cube"===b.params.effect&&(b.params.resistanceRatio=0,b.params.slidesPerView=1,b.params.slidesPerColumn=1,b.params.slidesPerGroup=1,b.params.centeredSlides=!1,b.params.spaceBetween=0,b.params.virtualTranslate=!0,b.params.setWrapperSize=!1),"fade"!==b.params.effect&&"flip"!==b.params.effect||(b.params.slidesPerView=1,b.params.slidesPerColumn=1,b.params.slidesPerGroup=1,b.params.watchSlidesProgress=!0,b.params.spaceBetween=0,b.params.setWrapperSize=!1,"undefined"==typeof f&&(b.params.virtualTranslate=!0)),b.params.grabCursor&&b.support.touch&&(b.params.grabCursor=!1),b.wrapper=b.container.children("."+b.params.wrapperClass),b.params.pagination&&(b.paginationContainer=a(b.params.pagination),b.params.uniqueNavElements&&"string"==typeof b.params.pagination&&b.paginationContainer.length>1&&1===b.container.find(b.params.pagination).length&&(b.paginationContainer=b.container.find(b.params.pagination)),"bullets"===b.params.paginationType&&b.params.paginationClickable?b.paginationContainer.addClass(b.params.paginationModifierClass+"clickable"):b.params.paginationClickable=!1,b.paginationContainer.addClass(b.params.paginationModifierClass+b.params.paginationType)),(b.params.nextButton||b.params.prevButton)&&(b.params.nextButton&&(b.nextButton=a(b.params.nextButton),b.params.uniqueNavElements&&"string"==typeof b.params.nextButton&&b.nextButton.length>1&&1===b.container.find(b.params.nextButton).length&&(b.nextButton=b.container.find(b.params.nextButton))),b.params.prevButton&&(b.prevButton=a(b.params.prevButton),b.params.uniqueNavElements&&"string"==typeof b.params.prevButton&&b.prevButton.length>1&&1===b.container.find(b.params.prevButton).length&&(b.prevButton=b.container.find(b.params.prevButton)))),b.isHorizontal=function(){return"horizontal"===b.params.direction},b.rtl=b.isHorizontal()&&("rtl"===b.container[0].dir.toLowerCase()||"rtl"===b.container.css("direction")),b.rtl&&b.classNames.push(b.params.containerModifierClass+"rtl"),b.rtl&&(b.wrongRTL="-webkit-box"===b.wrapper.css("display")),b.params.slidesPerColumn>1&&b.classNames.push(b.params.containerModifierClass+"multirow"),b.device.android&&b.classNames.push(b.params.containerModifierClass+"android"),b.container.addClass(b.classNames.join(" ")),b.translate=0,b.progress=0,b.velocity=0,b.lockSwipeToNext=function(){b.params.allowSwipeToNext=!1,b.params.allowSwipeToPrev===!1&&b.params.grabCursor&&b.unsetGrabCursor()},b.lockSwipeToPrev=function(){b.params.allowSwipeToPrev=!1,b.params.allowSwipeToNext===!1&&b.params.grabCursor&&b.unsetGrabCursor()},b.lockSwipes=function(){b.params.allowSwipeToNext=b.params.allowSwipeToPrev=!1,b.params.grabCursor&&b.unsetGrabCursor()},b.unlockSwipeToNext=function(){b.params.allowSwipeToNext=!0,b.params.allowSwipeToPrev===!0&&b.params.grabCursor&&b.setGrabCursor()},b.unlockSwipeToPrev=function(){b.params.allowSwipeToPrev=!0,b.params.allowSwipeToNext===!0&&b.params.grabCursor&&b.setGrabCursor()},b.unlockSwipes=function(){b.params.allowSwipeToNext=b.params.allowSwipeToPrev=!0,b.params.grabCursor&&b.setGrabCursor()},b.setGrabCursor=function(e){b.container[0].style.cursor="move",b.container[0].style.cursor=e?"-webkit-grabbing":"-webkit-grab",b.container[0].style.cursor=e?"-moz-grabbin":"-moz-grab",b.container[0].style.cursor=e?"grabbing":"grab"},b.unsetGrabCursor=function(){b.container[0].style.cursor=""},b.params.grabCursor&&b.setGrabCursor(),b.imagesToLoad=[],b.imagesLoaded=0,b.loadImage=function(e,a,t,s,i,r){function n(){r&&r()}var o;e.complete&&i?n():a?(o=new window.Image,o.onload=n,o.onerror=n,s&&(o.sizes=s),t&&(o.srcset=t),a&&(o.src=a)):n()},b.preloadImages=function(){function e(){"undefined"!=typeof b&&null!==b&&b&&(void 0!==b.imagesLoaded&&b.imagesLoaded++,b.imagesLoaded===b.imagesToLoad.length&&(b.params.updateOnImagesReady&&b.update(),b.emit("onImagesReady",b)))}b.imagesToLoad=b.container.find("img");for(var a=0;a<b.imagesToLoad.length;a++)b.loadImage(b.imagesToLoad[a],b.imagesToLoad[a].currentSrc||b.imagesToLoad[a].getAttribute("src"),b.imagesToLoad[a].srcset||b.imagesToLoad[a].getAttribute("srcset"),b.imagesToLoad[a].sizes||b.imagesToLoad[a].getAttribute("sizes"),!0,e)},b.autoplayTimeoutId=void 0,b.autoplaying=!1,b.autoplayPaused=!1,b.startAutoplay=function(){return"undefined"==typeof b.autoplayTimeoutId&&(!!b.params.autoplay&&(!b.autoplaying&&(b.autoplaying=!0,b.emit("onAutoplayStart",b),void n())))},b.stopAutoplay=function(e){b.autoplayTimeoutId&&(b.autoplayTimeoutId&&clearTimeout(b.autoplayTimeoutId),b.autoplaying=!1,b.autoplayTimeoutId=void 0,b.emit("onAutoplayStop",b))},b.pauseAutoplay=function(e){b.autoplayPaused||(b.autoplayTimeoutId&&clearTimeout(b.autoplayTimeoutId),b.autoplayPaused=!0,0===e?(b.autoplayPaused=!1,n()):b.wrapper.transitionEnd(function(){b&&(b.autoplayPaused=!1,b.autoplaying?n():b.stopAutoplay())}))},b.minTranslate=function(){return-b.snapGrid[0]},b.maxTranslate=function(){return-b.snapGrid[b.snapGrid.length-1]},b.updateAutoHeight=function(){var e,a=[],t=0;if("auto"!==b.params.slidesPerView&&b.params.slidesPerView>1)for(e=0;e<Math.ceil(b.params.slidesPerView);e++){var s=b.activeIndex+e;if(s>b.slides.length)break;a.push(b.slides.eq(s)[0])}else a.push(b.slides.eq(b.activeIndex)[0]);for(e=0;e<a.length;e++)if("undefined"!=typeof a[e]){var i=a[e].offsetHeight;t=i>t?i:t}t&&b.wrapper.css("height",t+"px")},b.updateContainerSize=function(){var e,a;e="undefined"!=typeof b.params.width?b.params.width:b.container[0].clientWidth,a="undefined"!=typeof b.params.height?b.params.height:b.container[0].clientHeight,0===e&&b.isHorizontal()||0===a&&!b.isHorizontal()||(e=e-parseInt(b.container.css("padding-left"),10)-parseInt(b.container.css("padding-right"),10),a=a-parseInt(b.container.css("padding-top"),10)-parseInt(b.container.css("padding-bottom"),10),b.width=e,b.height=a,b.size=b.isHorizontal()?b.width:b.height)},b.updateSlidesSize=function(){b.slides=b.wrapper.children("."+b.params.slideClass),b.snapGrid=[],b.slidesGrid=[],b.slidesSizesGrid=[];var e,a=b.params.spaceBetween,t=-b.params.slidesOffsetBefore,s=0,i=0;if("undefined"!=typeof b.size){"string"==typeof a&&a.indexOf("%")>=0&&(a=parseFloat(a.replace("%",""))/100*b.size),b.virtualSize=-a,b.rtl?b.slides.css({marginLeft:"",marginTop:""}):b.slides.css({marginRight:"",marginBottom:""});var n;b.params.slidesPerColumn>1&&(n=Math.floor(b.slides.length/b.params.slidesPerColumn)===b.slides.length/b.params.slidesPerColumn?b.slides.length:Math.ceil(b.slides.length/b.params.slidesPerColumn)*b.params.slidesPerColumn,"auto"!==b.params.slidesPerView&&"row"===b.params.slidesPerColumnFill&&(n=Math.max(n,b.params.slidesPerView*b.params.slidesPerColumn)));var o,l=b.params.slidesPerColumn,p=n/l,d=p-(b.params.slidesPerColumn*p-b.slides.length);for(e=0;e<b.slides.length;e++){o=0;var u=b.slides.eq(e);if(b.params.slidesPerColumn>1){var c,m,h;"column"===b.params.slidesPerColumnFill?(m=Math.floor(e/l),h=e-m*l,(m>d||m===d&&h===l-1)&&++h>=l&&(h=0,m++),c=m+h*n/l,u.css({"-webkit-box-ordinal-group":c,"-moz-box-ordinal-group":c,"-ms-flex-order":c,"-webkit-order":c,order:c})):(h=Math.floor(e/p),m=e-h*p),u.css("margin-"+(b.isHorizontal()?"top":"left"),0!==h&&b.params.spaceBetween&&b.params.spaceBetween+"px").attr("data-swiper-column",m).attr("data-swiper-row",h)}"none"!==u.css("display")&&("auto"===b.params.slidesPerView?(o=b.isHorizontal()?u.outerWidth(!0):u.outerHeight(!0),b.params.roundLengths&&(o=r(o))):(o=(b.size-(b.params.slidesPerView-1)*a)/b.params.slidesPerView,b.params.roundLengths&&(o=r(o)),b.isHorizontal()?b.slides[e].style.width=o+"px":b.slides[e].style.height=o+"px"),b.slides[e].swiperSlideSize=o,b.slidesSizesGrid.push(o),b.params.centeredSlides?(t=t+o/2+s/2+a,0===e&&(t=t-b.size/2-a),Math.abs(t)<.001&&(t=0),i%b.params.slidesPerGroup===0&&b.snapGrid.push(t),b.slidesGrid.push(t)):(i%b.params.slidesPerGroup===0&&b.snapGrid.push(t),b.slidesGrid.push(t),t=t+o+a),b.virtualSize+=o+a,s=o,i++)}b.virtualSize=Math.max(b.virtualSize,b.size)+b.params.slidesOffsetAfter;var g;if(b.rtl&&b.wrongRTL&&("slide"===b.params.effect||"coverflow"===b.params.effect)&&b.wrapper.css({width:b.virtualSize+b.params.spaceBetween+"px"}),b.support.flexbox&&!b.params.setWrapperSize||(b.isHorizontal()?b.wrapper.css({width:b.virtualSize+b.params.spaceBetween+"px"}):b.wrapper.css({height:b.virtualSize+b.params.spaceBetween+"px"})),b.params.slidesPerColumn>1&&(b.virtualSize=(o+b.params.spaceBetween)*n,b.virtualSize=Math.ceil(b.virtualSize/b.params.slidesPerColumn)-b.params.spaceBetween,b.isHorizontal()?b.wrapper.css({width:b.virtualSize+b.params.spaceBetween+"px"}):b.wrapper.css({height:b.virtualSize+b.params.spaceBetween+"px"}),b.params.centeredSlides)){for(g=[],e=0;e<b.snapGrid.length;e++)b.snapGrid[e]<b.virtualSize+b.snapGrid[0]&&g.push(b.snapGrid[e]);b.snapGrid=g}if(!b.params.centeredSlides){for(g=[],e=0;e<b.snapGrid.length;e++)b.snapGrid[e]<=b.virtualSize-b.size&&g.push(b.snapGrid[e]);b.snapGrid=g,Math.floor(b.virtualSize-b.size)-Math.floor(b.snapGrid[b.snapGrid.length-1])>1&&b.snapGrid.push(b.virtualSize-b.size)}0===b.snapGrid.length&&(b.snapGrid=[0]),0!==b.params.spaceBetween&&(b.isHorizontal()?b.rtl?b.slides.css({marginLeft:a+"px"}):b.slides.css({marginRight:a+"px"}):b.slides.css({marginBottom:a+"px"})),b.params.watchSlidesProgress&&b.updateSlidesOffset()}},b.updateSlidesOffset=function(){for(var e=0;e<b.slides.length;e++)b.slides[e].swiperSlideOffset=b.isHorizontal()?b.slides[e].offsetLeft:b.slides[e].offsetTop},b.currentSlidesPerView=function(){var e,a,t=1;if(b.params.centeredSlides){var s,i=b.slides[b.activeIndex].swiperSlideSize;for(e=b.activeIndex+1;e<b.slides.length;e++)b.slides[e]&&!s&&(i+=b.slides[e].swiperSlideSize,t++,i>b.size&&(s=!0));for(a=b.activeIndex-1;a>=0;a--)b.slides[a]&&!s&&(i+=b.slides[a].swiperSlideSize,t++,i>b.size&&(s=!0))}else for(e=b.activeIndex+1;e<b.slides.length;e++)b.slidesGrid[e]-b.slidesGrid[b.activeIndex]<b.size&&t++;return t},b.updateSlidesProgress=function(e){if("undefined"==typeof e&&(e=b.translate||0),0!==b.slides.length){"undefined"==typeof b.slides[0].swiperSlideOffset&&b.updateSlidesOffset();var a=-e;b.rtl&&(a=e),b.slides.removeClass(b.params.slideVisibleClass);for(var t=0;t<b.slides.length;t++){var s=b.slides[t],i=(a+(b.params.centeredSlides?b.minTranslate():0)-s.swiperSlideOffset)/(s.swiperSlideSize+b.params.spaceBetween);if(b.params.watchSlidesVisibility){var r=-(a-s.swiperSlideOffset),n=r+b.slidesSizesGrid[t],o=r>=0&&r<b.size||n>0&&n<=b.size||r<=0&&n>=b.size;o&&b.slides.eq(t).addClass(b.params.slideVisibleClass)}s.progress=b.rtl?-i:i}}},b.updateProgress=function(e){"undefined"==typeof e&&(e=b.translate||0);var a=b.maxTranslate()-b.minTranslate(),t=b.isBeginning,s=b.isEnd;0===a?(b.progress=0,b.isBeginning=b.isEnd=!0):(b.progress=(e-b.minTranslate())/a,b.isBeginning=b.progress<=0,b.isEnd=b.progress>=1),b.isBeginning&&!t&&b.emit("onReachBeginning",b),b.isEnd&&!s&&b.emit("onReachEnd",b),b.params.watchSlidesProgress&&b.updateSlidesProgress(e),b.emit("onProgress",b,b.progress)},b.updateActiveIndex=function(){var e,a,t,s=b.rtl?b.translate:-b.translate;for(a=0;a<b.slidesGrid.length;a++)"undefined"!=typeof b.slidesGrid[a+1]?s>=b.slidesGrid[a]&&s<b.slidesGrid[a+1]-(b.slidesGrid[a+1]-b.slidesGrid[a])/2?e=a:s>=b.slidesGrid[a]&&s<b.slidesGrid[a+1]&&(e=a+1):s>=b.slidesGrid[a]&&(e=a);b.params.normalizeSlideIndex&&(e<0||"undefined"==typeof e)&&(e=0),t=Math.floor(e/b.params.slidesPerGroup),t>=b.snapGrid.length&&(t=b.snapGrid.length-1),e!==b.activeIndex&&(b.snapIndex=t,b.previousIndex=b.activeIndex,b.activeIndex=e,b.updateClasses(),b.updateRealIndex())},b.updateRealIndex=function(){b.realIndex=parseInt(b.slides.eq(b.activeIndex).attr("data-swiper-slide-index")||b.activeIndex,10)},b.updateClasses=function(){b.slides.removeClass(b.params.slideActiveClass+" "+b.params.slideNextClass+" "+b.params.slidePrevClass+" "+b.params.slideDuplicateActiveClass+" "+b.params.slideDuplicateNextClass+" "+b.params.slideDuplicatePrevClass);var e=b.slides.eq(b.activeIndex);e.addClass(b.params.slideActiveClass),i.loop&&(e.hasClass(b.params.slideDuplicateClass)?b.wrapper.children("."+b.params.slideClass+":not(."+b.params.slideDuplicateClass+')[data-swiper-slide-index="'+b.realIndex+'"]').addClass(b.params.slideDuplicateActiveClass):b.wrapper.children("."+b.params.slideClass+"."+b.params.slideDuplicateClass+'[data-swiper-slide-index="'+b.realIndex+'"]').addClass(b.params.slideDuplicateActiveClass));var t=e.next("."+b.params.slideClass).addClass(b.params.slideNextClass);b.params.loop&&0===t.length&&(t=b.slides.eq(0),t.addClass(b.params.slideNextClass));var s=e.prev("."+b.params.slideClass).addClass(b.params.slidePrevClass);if(b.params.loop&&0===s.length&&(s=b.slides.eq(-1),s.addClass(b.params.slidePrevClass)),i.loop&&(t.hasClass(b.params.slideDuplicateClass)?b.wrapper.children("."+b.params.slideClass+":not(."+b.params.slideDuplicateClass+')[data-swiper-slide-index="'+t.attr("data-swiper-slide-index")+'"]').addClass(b.params.slideDuplicateNextClass):b.wrapper.children("."+b.params.slideClass+"."+b.params.slideDuplicateClass+'[data-swiper-slide-index="'+t.attr("data-swiper-slide-index")+'"]').addClass(b.params.slideDuplicateNextClass),s.hasClass(b.params.slideDuplicateClass)?b.wrapper.children("."+b.params.slideClass+":not(."+b.params.slideDuplicateClass+')[data-swiper-slide-index="'+s.attr("data-swiper-slide-index")+'"]').addClass(b.params.slideDuplicatePrevClass):b.wrapper.children("."+b.params.slideClass+"."+b.params.slideDuplicateClass+'[data-swiper-slide-index="'+s.attr("data-swiper-slide-index")+'"]').addClass(b.params.slideDuplicatePrevClass)),b.paginationContainer&&b.paginationContainer.length>0){var r,n=b.params.loop?Math.ceil((b.slides.length-2*b.loopedSlides)/b.params.slidesPerGroup):b.snapGrid.length;if(b.params.loop?(r=Math.ceil((b.activeIndex-b.loopedSlides)/b.params.slidesPerGroup),r>b.slides.length-1-2*b.loopedSlides&&(r-=b.slides.length-2*b.loopedSlides),r>n-1&&(r-=n),r<0&&"bullets"!==b.params.paginationType&&(r=n+r)):r="undefined"!=typeof b.snapIndex?b.snapIndex:b.activeIndex||0,"bullets"===b.params.paginationType&&b.bullets&&b.bullets.length>0&&(b.bullets.removeClass(b.params.bulletActiveClass),b.paginationContainer.length>1?b.bullets.each(function(){a(this).index()===r&&a(this).addClass(b.params.bulletActiveClass)}):b.bullets.eq(r).addClass(b.params.bulletActiveClass)),"fraction"===b.params.paginationType&&(b.paginationContainer.find("."+b.params.paginationCurrentClass).text(r+1),b.paginationContainer.find("."+b.params.paginationTotalClass).text(n)),"progress"===b.params.paginationType){var o=(r+1)/n,l=o,p=1;b.isHorizontal()||(p=o,l=1),b.paginationContainer.find("."+b.params.paginationProgressbarClass).transform("translate3d(0,0,0) scaleX("+l+") scaleY("+p+")").transition(b.params.speed)}"custom"===b.params.paginationType&&b.params.paginationCustomRender&&(b.paginationContainer.html(b.params.paginationCustomRender(b,r+1,n)),b.emit("onPaginationRendered",b,b.paginationContainer[0]))}b.params.loop||(b.params.prevButton&&b.prevButton&&b.prevButton.length>0&&(b.isBeginning?(b.prevButton.addClass(b.params.buttonDisabledClass),b.params.a11y&&b.a11y&&b.a11y.disable(b.prevButton)):(b.prevButton.removeClass(b.params.buttonDisabledClass),b.params.a11y&&b.a11y&&b.a11y.enable(b.prevButton))),b.params.nextButton&&b.nextButton&&b.nextButton.length>0&&(b.isEnd?(b.nextButton.addClass(b.params.buttonDisabledClass),b.params.a11y&&b.a11y&&b.a11y.disable(b.nextButton)):(b.nextButton.removeClass(b.params.buttonDisabledClass),b.params.a11y&&b.a11y&&b.a11y.enable(b.nextButton))))},b.updatePagination=function(){if(b.params.pagination&&b.paginationContainer&&b.paginationContainer.length>0){var e="";if("bullets"===b.params.paginationType){for(var a=b.params.loop?Math.ceil((b.slides.length-2*b.loopedSlides)/b.params.slidesPerGroup):b.snapGrid.length,t=0;t<a;t++)e+=b.params.paginationBulletRender?b.params.paginationBulletRender(b,t,b.params.bulletClass):"<"+b.params.paginationElement+' class="'+b.params.bulletClass+'"></'+b.params.paginationElement+">";b.paginationContainer.html(e),b.bullets=b.paginationContainer.find("."+b.params.bulletClass),b.params.paginationClickable&&b.params.a11y&&b.a11y&&b.a11y.initPagination()}"fraction"===b.params.paginationType&&(e=b.params.paginationFractionRender?b.params.paginationFractionRender(b,b.params.paginationCurrentClass,b.params.paginationTotalClass):'<span class="'+b.params.paginationCurrentClass+'"></span> / <span class="'+b.params.paginationTotalClass+'"></span>',b.paginationContainer.html(e)),"progress"===b.params.paginationType&&(e=b.params.paginationProgressRender?b.params.paginationProgressRender(b,b.params.paginationProgressbarClass):'<span class="'+b.params.paginationProgressbarClass+'"></span>',b.paginationContainer.html(e)),"custom"!==b.params.paginationType&&b.emit("onPaginationRendered",b,b.paginationContainer[0])}},b.update=function(e){function a(){b.rtl?-b.translate:b.translate;s=Math.min(Math.max(b.translate,b.maxTranslate()),b.minTranslate()),b.setWrapperTranslate(s),b.updateActiveIndex(),b.updateClasses()}if(b)if(b.updateContainerSize(),b.updateSlidesSize(),b.updateProgress(),b.updatePagination(),b.updateClasses(),b.params.scrollbar&&b.scrollbar&&b.scrollbar.set(),e){var t,s;b.controller&&b.controller.spline&&(b.controller.spline=void 0),b.params.freeMode?(a(),b.params.autoHeight&&b.updateAutoHeight()):(t=("auto"===b.params.slidesPerView||b.params.slidesPerView>1)&&b.isEnd&&!b.params.centeredSlides?b.slideTo(b.slides.length-1,0,!1,!0):b.slideTo(b.activeIndex,0,!1,!0),t||a())}else b.params.autoHeight&&b.updateAutoHeight()},b.onResize=function(e){b.params.breakpoints&&b.setBreakpoint();var a=b.params.allowSwipeToPrev,t=b.params.allowSwipeToNext;b.params.allowSwipeToPrev=b.params.allowSwipeToNext=!0,b.updateContainerSize(),b.updateSlidesSize(),("auto"===b.params.slidesPerView||b.params.freeMode||e)&&b.updatePagination(),b.params.scrollbar&&b.scrollbar&&b.scrollbar.set(),b.controller&&b.controller.spline&&(b.controller.spline=void 0);var s=!1;if(b.params.freeMode){var i=Math.min(Math.max(b.translate,b.maxTranslate()),b.minTranslate());b.setWrapperTranslate(i),b.updateActiveIndex(),b.updateClasses(),b.params.autoHeight&&b.updateAutoHeight()}else b.updateClasses(),s=("auto"===b.params.slidesPerView||b.params.slidesPerView>1)&&b.isEnd&&!b.params.centeredSlides?b.slideTo(b.slides.length-1,0,!1,!0):b.slideTo(b.activeIndex,0,!1,!0);b.params.lazyLoading&&!s&&b.lazy&&b.lazy.load(),b.params.allowSwipeToPrev=a,b.params.allowSwipeToNext=t},b.touchEventsDesktop={start:"mousedown",move:"mousemove",end:"mouseup"},window.navigator.pointerEnabled?b.touchEventsDesktop={start:"pointerdown",move:"pointermove",end:"pointerup"}:window.navigator.msPointerEnabled&&(b.touchEventsDesktop={start:"MSPointerDown",move:"MSPointerMove",end:"MSPointerUp"}),b.touchEvents={start:b.support.touch||!b.params.simulateTouch?"touchstart":b.touchEventsDesktop.start,move:b.support.touch||!b.params.simulateTouch?"touchmove":b.touchEventsDesktop.move,end:b.support.touch||!b.params.simulateTouch?"touchend":b.touchEventsDesktop.end},(window.navigator.pointerEnabled||window.navigator.msPointerEnabled)&&("container"===b.params.touchEventsTarget?b.container:b.wrapper).addClass("swiper-wp8-"+b.params.direction),b.initEvents=function(e){var a=e?"off":"on",t=e?"removeEventListener":"addEventListener",s="container"===b.params.touchEventsTarget?b.container[0]:b.wrapper[0],r=b.support.touch?s:document,n=!!b.params.nested;if(b.browser.ie)s[t](b.touchEvents.start,b.onTouchStart,!1),r[t](b.touchEvents.move,b.onTouchMove,n),r[t](b.touchEvents.end,b.onTouchEnd,!1);else{if(b.support.touch){var o=!("touchstart"!==b.touchEvents.start||!b.support.passiveListener||!b.params.passiveListeners)&&{passive:!0,capture:!1};s[t](b.touchEvents.start,b.onTouchStart,o),s[t](b.touchEvents.move,b.onTouchMove,n),s[t](b.touchEvents.end,b.onTouchEnd,o)}(i.simulateTouch&&!b.device.ios&&!b.device.android||i.simulateTouch&&!b.support.touch&&b.device.ios)&&(s[t]("mousedown",b.onTouchStart,!1),document[t]("mousemove",b.onTouchMove,n),document[t]("mouseup",b.onTouchEnd,!1))}window[t]("resize",b.onResize),b.params.nextButton&&b.nextButton&&b.nextButton.length>0&&(b.nextButton[a]("click",b.onClickNext),b.params.a11y&&b.a11y&&b.nextButton[a]("keydown",b.a11y.onEnterKey)),b.params.prevButton&&b.prevButton&&b.prevButton.length>0&&(b.prevButton[a]("click",b.onClickPrev),b.params.a11y&&b.a11y&&b.prevButton[a]("keydown",b.a11y.onEnterKey)),b.params.pagination&&b.params.paginationClickable&&(b.paginationContainer[a]("click","."+b.params.bulletClass,b.onClickIndex),b.params.a11y&&b.a11y&&b.paginationContainer[a]("keydown","."+b.params.bulletClass,b.a11y.onEnterKey)),(b.params.preventClicks||b.params.preventClicksPropagation)&&s[t]("click",b.preventClicks,!0);
},b.attachEvents=function(){b.initEvents()},b.detachEvents=function(){b.initEvents(!0)},b.allowClick=!0,b.preventClicks=function(e){b.allowClick||(b.params.preventClicks&&e.preventDefault(),b.params.preventClicksPropagation&&b.animating&&(e.stopPropagation(),e.stopImmediatePropagation()))},b.onClickNext=function(e){e.preventDefault(),b.isEnd&&!b.params.loop||b.slideNext()},b.onClickPrev=function(e){e.preventDefault(),b.isBeginning&&!b.params.loop||b.slidePrev()},b.onClickIndex=function(e){e.preventDefault();var t=a(this).index()*b.params.slidesPerGroup;b.params.loop&&(t+=b.loopedSlides),b.slideTo(t)},b.updateClickedSlide=function(e){var t=o(e,"."+b.params.slideClass),s=!1;if(t)for(var i=0;i<b.slides.length;i++)b.slides[i]===t&&(s=!0);if(!t||!s)return b.clickedSlide=void 0,void(b.clickedIndex=void 0);if(b.clickedSlide=t,b.clickedIndex=a(t).index(),b.params.slideToClickedSlide&&void 0!==b.clickedIndex&&b.clickedIndex!==b.activeIndex){var r,n=b.clickedIndex,l="auto"===b.params.slidesPerView?b.currentSlidesPerView():b.params.slidesPerView;if(b.params.loop){if(b.animating)return;r=parseInt(a(b.clickedSlide).attr("data-swiper-slide-index"),10),b.params.centeredSlides?n<b.loopedSlides-l/2||n>b.slides.length-b.loopedSlides+l/2?(b.fixLoop(),n=b.wrapper.children("."+b.params.slideClass+'[data-swiper-slide-index="'+r+'"]:not(.'+b.params.slideDuplicateClass+")").eq(0).index(),setTimeout(function(){b.slideTo(n)},0)):b.slideTo(n):n>b.slides.length-l?(b.fixLoop(),n=b.wrapper.children("."+b.params.slideClass+'[data-swiper-slide-index="'+r+'"]:not(.'+b.params.slideDuplicateClass+")").eq(0).index(),setTimeout(function(){b.slideTo(n)},0)):b.slideTo(n)}else b.slideTo(n)}};var C,z,M,E,P,I,k,L,D,B,H="input, select, textarea, button, video",G=Date.now(),X=[];b.animating=!1,b.touches={startX:0,startY:0,currentX:0,currentY:0,diff:0};var Y,A;b.onTouchStart=function(e){if(e.originalEvent&&(e=e.originalEvent),Y="touchstart"===e.type,Y||!("which"in e)||3!==e.which){if(b.params.noSwiping&&o(e,"."+b.params.noSwipingClass))return void(b.allowClick=!0);if(!b.params.swipeHandler||o(e,b.params.swipeHandler)){var t=b.touches.currentX="touchstart"===e.type?e.targetTouches[0].pageX:e.pageX,s=b.touches.currentY="touchstart"===e.type?e.targetTouches[0].pageY:e.pageY;if(!(b.device.ios&&b.params.iOSEdgeSwipeDetection&&t<=b.params.iOSEdgeSwipeThreshold)){if(C=!0,z=!1,M=!0,P=void 0,A=void 0,b.touches.startX=t,b.touches.startY=s,E=Date.now(),b.allowClick=!0,b.updateContainerSize(),b.swipeDirection=void 0,b.params.threshold>0&&(L=!1),"touchstart"!==e.type){var i=!0;a(e.target).is(H)&&(i=!1),document.activeElement&&a(document.activeElement).is(H)&&document.activeElement.blur(),i&&e.preventDefault()}b.emit("onTouchStart",b,e)}}}},b.onTouchMove=function(e){if(e.originalEvent&&(e=e.originalEvent),!Y||"mousemove"!==e.type){if(e.preventedByNestedSwiper)return b.touches.startX="touchmove"===e.type?e.targetTouches[0].pageX:e.pageX,void(b.touches.startY="touchmove"===e.type?e.targetTouches[0].pageY:e.pageY);if(b.params.onlyExternal)return b.allowClick=!1,void(C&&(b.touches.startX=b.touches.currentX="touchmove"===e.type?e.targetTouches[0].pageX:e.pageX,b.touches.startY=b.touches.currentY="touchmove"===e.type?e.targetTouches[0].pageY:e.pageY,E=Date.now()));if(Y&&b.params.touchReleaseOnEdges&&!b.params.loop)if(b.isHorizontal()){if(b.touches.currentX<b.touches.startX&&b.translate<=b.maxTranslate()||b.touches.currentX>b.touches.startX&&b.translate>=b.minTranslate())return}else if(b.touches.currentY<b.touches.startY&&b.translate<=b.maxTranslate()||b.touches.currentY>b.touches.startY&&b.translate>=b.minTranslate())return;if(Y&&document.activeElement&&e.target===document.activeElement&&a(e.target).is(H))return z=!0,void(b.allowClick=!1);if(M&&b.emit("onTouchMove",b,e),!(e.targetTouches&&e.targetTouches.length>1)){if(b.touches.currentX="touchmove"===e.type?e.targetTouches[0].pageX:e.pageX,b.touches.currentY="touchmove"===e.type?e.targetTouches[0].pageY:e.pageY,"undefined"==typeof P){var t;b.isHorizontal()&&b.touches.currentY===b.touches.startY||!b.isHorizontal()&&b.touches.currentX===b.touches.startX?P=!1:(t=180*Math.atan2(Math.abs(b.touches.currentY-b.touches.startY),Math.abs(b.touches.currentX-b.touches.startX))/Math.PI,P=b.isHorizontal()?t>b.params.touchAngle:90-t>b.params.touchAngle)}if(P&&b.emit("onTouchMoveOpposite",b,e),"undefined"==typeof A&&b.browser.ieTouch&&(b.touches.currentX===b.touches.startX&&b.touches.currentY===b.touches.startY||(A=!0)),C){if(P)return void(C=!1);if(A||!b.browser.ieTouch){b.allowClick=!1,b.emit("onSliderMove",b,e),e.preventDefault(),b.params.touchMoveStopPropagation&&!b.params.nested&&e.stopPropagation(),z||(i.loop&&b.fixLoop(),k=b.getWrapperTranslate(),b.setWrapperTransition(0),b.animating&&b.wrapper.trigger("webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd msTransitionEnd"),b.params.autoplay&&b.autoplaying&&(b.params.autoplayDisableOnInteraction?b.stopAutoplay():b.pauseAutoplay()),B=!1,!b.params.grabCursor||b.params.allowSwipeToNext!==!0&&b.params.allowSwipeToPrev!==!0||b.setGrabCursor(!0)),z=!0;var s=b.touches.diff=b.isHorizontal()?b.touches.currentX-b.touches.startX:b.touches.currentY-b.touches.startY;s*=b.params.touchRatio,b.rtl&&(s=-s),b.swipeDirection=s>0?"prev":"next",I=s+k;var r=!0;if(s>0&&I>b.minTranslate()?(r=!1,b.params.resistance&&(I=b.minTranslate()-1+Math.pow(-b.minTranslate()+k+s,b.params.resistanceRatio))):s<0&&I<b.maxTranslate()&&(r=!1,b.params.resistance&&(I=b.maxTranslate()+1-Math.pow(b.maxTranslate()-k-s,b.params.resistanceRatio))),r&&(e.preventedByNestedSwiper=!0),!b.params.allowSwipeToNext&&"next"===b.swipeDirection&&I<k&&(I=k),!b.params.allowSwipeToPrev&&"prev"===b.swipeDirection&&I>k&&(I=k),b.params.threshold>0){if(!(Math.abs(s)>b.params.threshold||L))return void(I=k);if(!L)return L=!0,b.touches.startX=b.touches.currentX,b.touches.startY=b.touches.currentY,I=k,void(b.touches.diff=b.isHorizontal()?b.touches.currentX-b.touches.startX:b.touches.currentY-b.touches.startY)}b.params.followFinger&&((b.params.freeMode||b.params.watchSlidesProgress)&&b.updateActiveIndex(),b.params.freeMode&&(0===X.length&&X.push({position:b.touches[b.isHorizontal()?"startX":"startY"],time:E}),X.push({position:b.touches[b.isHorizontal()?"currentX":"currentY"],time:(new window.Date).getTime()})),b.updateProgress(I),b.setWrapperTranslate(I))}}}}},b.onTouchEnd=function(e){if(e.originalEvent&&(e=e.originalEvent),M&&b.emit("onTouchEnd",b,e),M=!1,C){b.params.grabCursor&&z&&C&&(b.params.allowSwipeToNext===!0||b.params.allowSwipeToPrev===!0)&&b.setGrabCursor(!1);var t=Date.now(),s=t-E;if(b.allowClick&&(b.updateClickedSlide(e),b.emit("onTap",b,e),s<300&&t-G>300&&(D&&clearTimeout(D),D=setTimeout(function(){b&&(b.params.paginationHide&&b.paginationContainer.length>0&&!a(e.target).hasClass(b.params.bulletClass)&&b.paginationContainer.toggleClass(b.params.paginationHiddenClass),b.emit("onClick",b,e))},300)),s<300&&t-G<300&&(D&&clearTimeout(D),b.emit("onDoubleTap",b,e))),G=Date.now(),setTimeout(function(){b&&(b.allowClick=!0)},0),!C||!z||!b.swipeDirection||0===b.touches.diff||I===k)return void(C=z=!1);C=z=!1;var i;if(i=b.params.followFinger?b.rtl?b.translate:-b.translate:-I,b.params.freeMode){if(i<-b.minTranslate())return void b.slideTo(b.activeIndex);if(i>-b.maxTranslate())return void(b.slides.length<b.snapGrid.length?b.slideTo(b.snapGrid.length-1):b.slideTo(b.slides.length-1));if(b.params.freeModeMomentum){if(X.length>1){var r=X.pop(),n=X.pop(),o=r.position-n.position,l=r.time-n.time;b.velocity=o/l,b.velocity=b.velocity/2,Math.abs(b.velocity)<b.params.freeModeMinimumVelocity&&(b.velocity=0),(l>150||(new window.Date).getTime()-r.time>300)&&(b.velocity=0)}else b.velocity=0;b.velocity=b.velocity*b.params.freeModeMomentumVelocityRatio,X.length=0;var p=1e3*b.params.freeModeMomentumRatio,d=b.velocity*p,u=b.translate+d;b.rtl&&(u=-u);var c,m=!1,h=20*Math.abs(b.velocity)*b.params.freeModeMomentumBounceRatio;if(u<b.maxTranslate())b.params.freeModeMomentumBounce?(u+b.maxTranslate()<-h&&(u=b.maxTranslate()-h),c=b.maxTranslate(),m=!0,B=!0):u=b.maxTranslate();else if(u>b.minTranslate())b.params.freeModeMomentumBounce?(u-b.minTranslate()>h&&(u=b.minTranslate()+h),c=b.minTranslate(),m=!0,B=!0):u=b.minTranslate();else if(b.params.freeModeSticky){var g,f=0;for(f=0;f<b.snapGrid.length;f+=1)if(b.snapGrid[f]>-u){g=f;break}u=Math.abs(b.snapGrid[g]-u)<Math.abs(b.snapGrid[g-1]-u)||"next"===b.swipeDirection?b.snapGrid[g]:b.snapGrid[g-1],b.rtl||(u=-u)}if(0!==b.velocity)p=b.rtl?Math.abs((-u-b.translate)/b.velocity):Math.abs((u-b.translate)/b.velocity);else if(b.params.freeModeSticky)return void b.slideReset();b.params.freeModeMomentumBounce&&m?(b.updateProgress(c),b.setWrapperTransition(p),b.setWrapperTranslate(u),b.onTransitionStart(),b.animating=!0,b.wrapper.transitionEnd(function(){b&&B&&(b.emit("onMomentumBounce",b),b.setWrapperTransition(b.params.speed),b.setWrapperTranslate(c),b.wrapper.transitionEnd(function(){b&&b.onTransitionEnd()}))})):b.velocity?(b.updateProgress(u),b.setWrapperTransition(p),b.setWrapperTranslate(u),b.onTransitionStart(),b.animating||(b.animating=!0,b.wrapper.transitionEnd(function(){b&&b.onTransitionEnd()}))):b.updateProgress(u),b.updateActiveIndex()}return void((!b.params.freeModeMomentum||s>=b.params.longSwipesMs)&&(b.updateProgress(),b.updateActiveIndex()))}var v,w=0,y=b.slidesSizesGrid[0];for(v=0;v<b.slidesGrid.length;v+=b.params.slidesPerGroup)"undefined"!=typeof b.slidesGrid[v+b.params.slidesPerGroup]?i>=b.slidesGrid[v]&&i<b.slidesGrid[v+b.params.slidesPerGroup]&&(w=v,y=b.slidesGrid[v+b.params.slidesPerGroup]-b.slidesGrid[v]):i>=b.slidesGrid[v]&&(w=v,y=b.slidesGrid[b.slidesGrid.length-1]-b.slidesGrid[b.slidesGrid.length-2]);var x=(i-b.slidesGrid[w])/y;if(s>b.params.longSwipesMs){if(!b.params.longSwipes)return void b.slideTo(b.activeIndex);"next"===b.swipeDirection&&(x>=b.params.longSwipesRatio?b.slideTo(w+b.params.slidesPerGroup):b.slideTo(w)),"prev"===b.swipeDirection&&(x>1-b.params.longSwipesRatio?b.slideTo(w+b.params.slidesPerGroup):b.slideTo(w))}else{if(!b.params.shortSwipes)return void b.slideTo(b.activeIndex);"next"===b.swipeDirection&&b.slideTo(w+b.params.slidesPerGroup),"prev"===b.swipeDirection&&b.slideTo(w)}}},b._slideTo=function(e,a){return b.slideTo(e,a,!0,!0)},b.slideTo=function(e,a,t,s){"undefined"==typeof t&&(t=!0),"undefined"==typeof e&&(e=0),e<0&&(e=0),b.snapIndex=Math.floor(e/b.params.slidesPerGroup),b.snapIndex>=b.snapGrid.length&&(b.snapIndex=b.snapGrid.length-1);var i=-b.snapGrid[b.snapIndex];if(b.params.autoplay&&b.autoplaying&&(s||!b.params.autoplayDisableOnInteraction?b.pauseAutoplay(a):b.stopAutoplay()),b.updateProgress(i),b.params.normalizeSlideIndex)for(var r=0;r<b.slidesGrid.length;r++)-Math.floor(100*i)>=Math.floor(100*b.slidesGrid[r])&&(e=r);return!(!b.params.allowSwipeToNext&&i<b.translate&&i<b.minTranslate())&&(!(!b.params.allowSwipeToPrev&&i>b.translate&&i>b.maxTranslate()&&(b.activeIndex||0)!==e)&&("undefined"==typeof a&&(a=b.params.speed),b.previousIndex=b.activeIndex||0,b.activeIndex=e,b.updateRealIndex(),b.rtl&&-i===b.translate||!b.rtl&&i===b.translate?(b.params.autoHeight&&b.updateAutoHeight(),b.updateClasses(),"slide"!==b.params.effect&&b.setWrapperTranslate(i),!1):(b.updateClasses(),b.onTransitionStart(t),0===a||b.browser.lteIE9?(b.setWrapperTranslate(i),b.setWrapperTransition(0),b.onTransitionEnd(t)):(b.setWrapperTranslate(i),b.setWrapperTransition(a),b.animating||(b.animating=!0,b.wrapper.transitionEnd(function(){b&&b.onTransitionEnd(t)}))),!0)))},b.onTransitionStart=function(e){"undefined"==typeof e&&(e=!0),b.params.autoHeight&&b.updateAutoHeight(),b.lazy&&b.lazy.onTransitionStart(),e&&(b.emit("onTransitionStart",b),b.activeIndex!==b.previousIndex&&(b.emit("onSlideChangeStart",b),b.activeIndex>b.previousIndex?b.emit("onSlideNextStart",b):b.emit("onSlidePrevStart",b)))},b.onTransitionEnd=function(e){b.animating=!1,b.setWrapperTransition(0),"undefined"==typeof e&&(e=!0),b.lazy&&b.lazy.onTransitionEnd(),e&&(b.emit("onTransitionEnd",b),b.activeIndex!==b.previousIndex&&(b.emit("onSlideChangeEnd",b),b.activeIndex>b.previousIndex?b.emit("onSlideNextEnd",b):b.emit("onSlidePrevEnd",b))),b.params.history&&b.history&&b.history.setHistory(b.params.history,b.activeIndex),b.params.hashnav&&b.hashnav&&b.hashnav.setHash()},b.slideNext=function(e,a,t){if(b.params.loop){if(b.animating)return!1;b.fixLoop();b.container[0].clientLeft;return b.slideTo(b.activeIndex+b.params.slidesPerGroup,a,e,t)}return b.slideTo(b.activeIndex+b.params.slidesPerGroup,a,e,t)},b._slideNext=function(e){return b.slideNext(!0,e,!0)},b.slidePrev=function(e,a,t){if(b.params.loop){if(b.animating)return!1;b.fixLoop();b.container[0].clientLeft;return b.slideTo(b.activeIndex-1,a,e,t)}return b.slideTo(b.activeIndex-1,a,e,t)},b._slidePrev=function(e){return b.slidePrev(!0,e,!0)},b.slideReset=function(e,a,t){return b.slideTo(b.activeIndex,a,e)},b.disableTouchControl=function(){return b.params.onlyExternal=!0,!0},b.enableTouchControl=function(){return b.params.onlyExternal=!1,!0},b.setWrapperTransition=function(e,a){b.wrapper.transition(e),"slide"!==b.params.effect&&b.effects[b.params.effect]&&b.effects[b.params.effect].setTransition(e),b.params.parallax&&b.parallax&&b.parallax.setTransition(e),b.params.scrollbar&&b.scrollbar&&b.scrollbar.setTransition(e),b.params.control&&b.controller&&b.controller.setTransition(e,a),b.emit("onSetTransition",b,e)},b.setWrapperTranslate=function(e,a,t){var s=0,i=0,n=0;b.isHorizontal()?s=b.rtl?-e:e:i=e,b.params.roundLengths&&(s=r(s),i=r(i)),b.params.virtualTranslate||(b.support.transforms3d?b.wrapper.transform("translate3d("+s+"px, "+i+"px, "+n+"px)"):b.wrapper.transform("translate("+s+"px, "+i+"px)")),b.translate=b.isHorizontal()?s:i;var o,l=b.maxTranslate()-b.minTranslate();o=0===l?0:(e-b.minTranslate())/l,o!==b.progress&&b.updateProgress(e),a&&b.updateActiveIndex(),"slide"!==b.params.effect&&b.effects[b.params.effect]&&b.effects[b.params.effect].setTranslate(b.translate),b.params.parallax&&b.parallax&&b.parallax.setTranslate(b.translate),b.params.scrollbar&&b.scrollbar&&b.scrollbar.setTranslate(b.translate),b.params.control&&b.controller&&b.controller.setTranslate(b.translate,t),b.emit("onSetTranslate",b,b.translate)},b.getTranslate=function(e,a){var t,s,i,r;return"undefined"==typeof a&&(a="x"),b.params.virtualTranslate?b.rtl?-b.translate:b.translate:(i=window.getComputedStyle(e,null),window.WebKitCSSMatrix?(s=i.transform||i.webkitTransform,s.split(",").length>6&&(s=s.split(", ").map(function(e){return e.replace(",",".")}).join(", ")),r=new window.WebKitCSSMatrix("none"===s?"":s)):(r=i.MozTransform||i.OTransform||i.MsTransform||i.msTransform||i.transform||i.getPropertyValue("transform").replace("translate(","matrix(1, 0, 0, 1,"),t=r.toString().split(",")),"x"===a&&(s=window.WebKitCSSMatrix?r.m41:16===t.length?parseFloat(t[12]):parseFloat(t[4])),"y"===a&&(s=window.WebKitCSSMatrix?r.m42:16===t.length?parseFloat(t[13]):parseFloat(t[5])),b.rtl&&s&&(s=-s),s||0)},b.getWrapperTranslate=function(e){return"undefined"==typeof e&&(e=b.isHorizontal()?"x":"y"),b.getTranslate(b.wrapper[0],e)},b.observers=[],b.initObservers=function(){if(b.params.observeParents)for(var e=b.container.parents(),a=0;a<e.length;a++)l(e[a]);l(b.container[0],{childList:!1}),l(b.wrapper[0],{attributes:!1})},b.disconnectObservers=function(){for(var e=0;e<b.observers.length;e++)b.observers[e].disconnect();b.observers=[]},b.createLoop=function(){b.wrapper.children("."+b.params.slideClass+"."+b.params.slideDuplicateClass).remove();var e=b.wrapper.children("."+b.params.slideClass);"auto"!==b.params.slidesPerView||b.params.loopedSlides||(b.params.loopedSlides=e.length),b.loopedSlides=parseInt(b.params.loopedSlides||b.params.slidesPerView,10),b.loopedSlides=b.loopedSlides+b.params.loopAdditionalSlides,b.loopedSlides>e.length&&(b.loopedSlides=e.length);var t,s=[],i=[];for(e.each(function(t,r){var n=a(this);t<b.loopedSlides&&i.push(r),t<e.length&&t>=e.length-b.loopedSlides&&s.push(r),n.attr("data-swiper-slide-index",t)}),t=0;t<i.length;t++)b.wrapper.append(a(i[t].cloneNode(!0)).addClass(b.params.slideDuplicateClass));for(t=s.length-1;t>=0;t--)b.wrapper.prepend(a(s[t].cloneNode(!0)).addClass(b.params.slideDuplicateClass))},b.destroyLoop=function(){b.wrapper.children("."+b.params.slideClass+"."+b.params.slideDuplicateClass).remove(),b.slides.removeAttr("data-swiper-slide-index")},b.reLoop=function(e){var a=b.activeIndex-b.loopedSlides;b.destroyLoop(),b.createLoop(),b.updateSlidesSize(),e&&b.slideTo(a+b.loopedSlides,0,!1)},b.fixLoop=function(){var e;b.activeIndex<b.loopedSlides?(e=b.slides.length-3*b.loopedSlides+b.activeIndex,e+=b.loopedSlides,b.slideTo(e,0,!1,!0)):("auto"===b.params.slidesPerView&&b.activeIndex>=2*b.loopedSlides||b.activeIndex>b.slides.length-2*b.params.slidesPerView)&&(e=-b.slides.length+b.activeIndex+b.loopedSlides,e+=b.loopedSlides,b.slideTo(e,0,!1,!0))},b.appendSlide=function(e){if(b.params.loop&&b.destroyLoop(),"object"==typeof e&&e.length)for(var a=0;a<e.length;a++)e[a]&&b.wrapper.append(e[a]);else b.wrapper.append(e);b.params.loop&&b.createLoop(),b.params.observer&&b.support.observer||b.update(!0)},b.prependSlide=function(e){b.params.loop&&b.destroyLoop();var a=b.activeIndex+1;if("object"==typeof e&&e.length){for(var t=0;t<e.length;t++)e[t]&&b.wrapper.prepend(e[t]);a=b.activeIndex+e.length}else b.wrapper.prepend(e);b.params.loop&&b.createLoop(),b.params.observer&&b.support.observer||b.update(!0),b.slideTo(a,0,!1)},b.removeSlide=function(e){b.params.loop&&(b.destroyLoop(),b.slides=b.wrapper.children("."+b.params.slideClass));var a,t=b.activeIndex;if("object"==typeof e&&e.length){for(var s=0;s<e.length;s++)a=e[s],b.slides[a]&&b.slides.eq(a).remove(),a<t&&t--;t=Math.max(t,0)}else a=e,b.slides[a]&&b.slides.eq(a).remove(),a<t&&t--,t=Math.max(t,0);b.params.loop&&b.createLoop(),b.params.observer&&b.support.observer||b.update(!0),b.params.loop?b.slideTo(t+b.loopedSlides,0,!1):b.slideTo(t,0,!1)},b.removeAllSlides=function(){for(var e=[],a=0;a<b.slides.length;a++)e.push(a);b.removeSlide(e)},b.effects={fade:{setTranslate:function(){for(var e=0;e<b.slides.length;e++){var a=b.slides.eq(e),t=a[0].swiperSlideOffset,s=-t;b.params.virtualTranslate||(s-=b.translate);var i=0;b.isHorizontal()||(i=s,s=0);var r=b.params.fade.crossFade?Math.max(1-Math.abs(a[0].progress),0):1+Math.min(Math.max(a[0].progress,-1),0);a.css({opacity:r}).transform("translate3d("+s+"px, "+i+"px, 0px)")}},setTransition:function(e){if(b.slides.transition(e),b.params.virtualTranslate&&0!==e){var a=!1;b.slides.transitionEnd(function(){if(!a&&b){a=!0,b.animating=!1;for(var e=["webkitTransitionEnd","transitionend","oTransitionEnd","MSTransitionEnd","msTransitionEnd"],t=0;t<e.length;t++)b.wrapper.trigger(e[t])}})}}},flip:{setTranslate:function(){for(var e=0;e<b.slides.length;e++){var t=b.slides.eq(e),s=t[0].progress;b.params.flip.limitRotation&&(s=Math.max(Math.min(t[0].progress,1),-1));var i=t[0].swiperSlideOffset,r=-180*s,n=r,o=0,l=-i,p=0;if(b.isHorizontal()?b.rtl&&(n=-n):(p=l,l=0,o=-n,n=0),t[0].style.zIndex=-Math.abs(Math.round(s))+b.slides.length,b.params.flip.slideShadows){var d=b.isHorizontal()?t.find(".swiper-slide-shadow-left"):t.find(".swiper-slide-shadow-top"),u=b.isHorizontal()?t.find(".swiper-slide-shadow-right"):t.find(".swiper-slide-shadow-bottom");0===d.length&&(d=a('<div class="swiper-slide-shadow-'+(b.isHorizontal()?"left":"top")+'"></div>'),t.append(d)),0===u.length&&(u=a('<div class="swiper-slide-shadow-'+(b.isHorizontal()?"right":"bottom")+'"></div>'),t.append(u)),d.length&&(d[0].style.opacity=Math.max(-s,0)),u.length&&(u[0].style.opacity=Math.max(s,0))}t.transform("translate3d("+l+"px, "+p+"px, 0px) rotateX("+o+"deg) rotateY("+n+"deg)")}},setTransition:function(e){if(b.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e),b.params.virtualTranslate&&0!==e){var t=!1;b.slides.eq(b.activeIndex).transitionEnd(function(){if(!t&&b&&a(this).hasClass(b.params.slideActiveClass)){t=!0,b.animating=!1;for(var e=["webkitTransitionEnd","transitionend","oTransitionEnd","MSTransitionEnd","msTransitionEnd"],s=0;s<e.length;s++)b.wrapper.trigger(e[s])}})}}},cube:{setTranslate:function(){var e,t=0;b.params.cube.shadow&&(b.isHorizontal()?(e=b.wrapper.find(".swiper-cube-shadow"),0===e.length&&(e=a('<div class="swiper-cube-shadow"></div>'),b.wrapper.append(e)),e.css({height:b.width+"px"})):(e=b.container.find(".swiper-cube-shadow"),0===e.length&&(e=a('<div class="swiper-cube-shadow"></div>'),b.container.append(e))));for(var s=0;s<b.slides.length;s++){var i=b.slides.eq(s),r=90*s,n=Math.floor(r/360);b.rtl&&(r=-r,n=Math.floor(-r/360));var o=Math.max(Math.min(i[0].progress,1),-1),l=0,p=0,d=0;s%4===0?(l=4*-n*b.size,d=0):(s-1)%4===0?(l=0,d=4*-n*b.size):(s-2)%4===0?(l=b.size+4*n*b.size,d=b.size):(s-3)%4===0&&(l=-b.size,d=3*b.size+4*b.size*n),b.rtl&&(l=-l),b.isHorizontal()||(p=l,l=0);var u="rotateX("+(b.isHorizontal()?0:-r)+"deg) rotateY("+(b.isHorizontal()?r:0)+"deg) translate3d("+l+"px, "+p+"px, "+d+"px)";if(o<=1&&o>-1&&(t=90*s+90*o,b.rtl&&(t=90*-s-90*o)),i.transform(u),b.params.cube.slideShadows){var c=b.isHorizontal()?i.find(".swiper-slide-shadow-left"):i.find(".swiper-slide-shadow-top"),m=b.isHorizontal()?i.find(".swiper-slide-shadow-right"):i.find(".swiper-slide-shadow-bottom");0===c.length&&(c=a('<div class="swiper-slide-shadow-'+(b.isHorizontal()?"left":"top")+'"></div>'),i.append(c)),0===m.length&&(m=a('<div class="swiper-slide-shadow-'+(b.isHorizontal()?"right":"bottom")+'"></div>'),i.append(m)),c.length&&(c[0].style.opacity=Math.max(-o,0)),m.length&&(m[0].style.opacity=Math.max(o,0))}}if(b.wrapper.css({"-webkit-transform-origin":"50% 50% -"+b.size/2+"px","-moz-transform-origin":"50% 50% -"+b.size/2+"px","-ms-transform-origin":"50% 50% -"+b.size/2+"px","transform-origin":"50% 50% -"+b.size/2+"px"}),b.params.cube.shadow)if(b.isHorizontal())e.transform("translate3d(0px, "+(b.width/2+b.params.cube.shadowOffset)+"px, "+-b.width/2+"px) rotateX(90deg) rotateZ(0deg) scale("+b.params.cube.shadowScale+")");else{var h=Math.abs(t)-90*Math.floor(Math.abs(t)/90),g=1.5-(Math.sin(2*h*Math.PI/360)/2+Math.cos(2*h*Math.PI/360)/2),f=b.params.cube.shadowScale,v=b.params.cube.shadowScale/g,w=b.params.cube.shadowOffset;e.transform("scale3d("+f+", 1, "+v+") translate3d(0px, "+(b.height/2+w)+"px, "+-b.height/2/v+"px) rotateX(-90deg)")}var y=b.isSafari||b.isUiWebView?-b.size/2:0;b.wrapper.transform("translate3d(0px,0,"+y+"px) rotateX("+(b.isHorizontal()?0:t)+"deg) rotateY("+(b.isHorizontal()?-t:0)+"deg)")},setTransition:function(e){b.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e),b.params.cube.shadow&&!b.isHorizontal()&&b.container.find(".swiper-cube-shadow").transition(e)}},coverflow:{setTranslate:function(){for(var e=b.translate,t=b.isHorizontal()?-e+b.width/2:-e+b.height/2,s=b.isHorizontal()?b.params.coverflow.rotate:-b.params.coverflow.rotate,i=b.params.coverflow.depth,r=0,n=b.slides.length;r<n;r++){var o=b.slides.eq(r),l=b.slidesSizesGrid[r],p=o[0].swiperSlideOffset,d=(t-p-l/2)/l*b.params.coverflow.modifier,u=b.isHorizontal()?s*d:0,c=b.isHorizontal()?0:s*d,m=-i*Math.abs(d),h=b.isHorizontal()?0:b.params.coverflow.stretch*d,g=b.isHorizontal()?b.params.coverflow.stretch*d:0;Math.abs(g)<.001&&(g=0),Math.abs(h)<.001&&(h=0),Math.abs(m)<.001&&(m=0),Math.abs(u)<.001&&(u=0),Math.abs(c)<.001&&(c=0);var f="translate3d("+g+"px,"+h+"px,"+m+"px)  rotateX("+c+"deg) rotateY("+u+"deg)";if(o.transform(f),o[0].style.zIndex=-Math.abs(Math.round(d))+1,b.params.coverflow.slideShadows){var v=b.isHorizontal()?o.find(".swiper-slide-shadow-left"):o.find(".swiper-slide-shadow-top"),w=b.isHorizontal()?o.find(".swiper-slide-shadow-right"):o.find(".swiper-slide-shadow-bottom");0===v.length&&(v=a('<div class="swiper-slide-shadow-'+(b.isHorizontal()?"left":"top")+'"></div>'),o.append(v)),0===w.length&&(w=a('<div class="swiper-slide-shadow-'+(b.isHorizontal()?"right":"bottom")+'"></div>'),o.append(w)),v.length&&(v[0].style.opacity=d>0?d:0),w.length&&(w[0].style.opacity=-d>0?-d:0)}}if(b.browser.ie){var y=b.wrapper[0].style;y.perspectiveOrigin=t+"px 50%"}},setTransition:function(e){b.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e)}}},b.lazy={initialImageLoaded:!1,loadImageInSlide:function(e,t){if("undefined"!=typeof e&&("undefined"==typeof t&&(t=!0),0!==b.slides.length)){var s=b.slides.eq(e),i=s.find("."+b.params.lazyLoadingClass+":not(."+b.params.lazyStatusLoadedClass+"):not(."+b.params.lazyStatusLoadingClass+")");!s.hasClass(b.params.lazyLoadingClass)||s.hasClass(b.params.lazyStatusLoadedClass)||s.hasClass(b.params.lazyStatusLoadingClass)||(i=i.add(s[0])),0!==i.length&&i.each(function(){var e=a(this);e.addClass(b.params.lazyStatusLoadingClass);var i=e.attr("data-background"),r=e.attr("data-src"),n=e.attr("data-srcset"),o=e.attr("data-sizes");b.loadImage(e[0],r||i,n,o,!1,function(){if(i?(e.css("background-image",'url("'+i+'")'),e.removeAttr("data-background")):(n&&(e.attr("srcset",n),e.removeAttr("data-srcset")),o&&(e.attr("sizes",o),e.removeAttr("data-sizes")),r&&(e.attr("src",r),e.removeAttr("data-src"))),e.addClass(b.params.lazyStatusLoadedClass).removeClass(b.params.lazyStatusLoadingClass),s.find("."+b.params.lazyPreloaderClass+", ."+b.params.preloaderClass).remove(),b.params.loop&&t){var a=s.attr("data-swiper-slide-index");if(s.hasClass(b.params.slideDuplicateClass)){var l=b.wrapper.children('[data-swiper-slide-index="'+a+'"]:not(.'+b.params.slideDuplicateClass+")");b.lazy.loadImageInSlide(l.index(),!1)}else{var p=b.wrapper.children("."+b.params.slideDuplicateClass+'[data-swiper-slide-index="'+a+'"]');b.lazy.loadImageInSlide(p.index(),!1)}}b.emit("onLazyImageReady",b,s[0],e[0])}),b.emit("onLazyImageLoad",b,s[0],e[0])})}},load:function(){var e,t=b.params.slidesPerView;if("auto"===t&&(t=0),b.lazy.initialImageLoaded||(b.lazy.initialImageLoaded=!0),b.params.watchSlidesVisibility)b.wrapper.children("."+b.params.slideVisibleClass).each(function(){b.lazy.loadImageInSlide(a(this).index())});else if(t>1)for(e=b.activeIndex;e<b.activeIndex+t;e++)b.slides[e]&&b.lazy.loadImageInSlide(e);else b.lazy.loadImageInSlide(b.activeIndex);if(b.params.lazyLoadingInPrevNext)if(t>1||b.params.lazyLoadingInPrevNextAmount&&b.params.lazyLoadingInPrevNextAmount>1){var s=b.params.lazyLoadingInPrevNextAmount,i=t,r=Math.min(b.activeIndex+i+Math.max(s,i),b.slides.length),n=Math.max(b.activeIndex-Math.max(i,s),0);for(e=b.activeIndex+t;e<r;e++)b.slides[e]&&b.lazy.loadImageInSlide(e);for(e=n;e<b.activeIndex;e++)b.slides[e]&&b.lazy.loadImageInSlide(e)}else{var o=b.wrapper.children("."+b.params.slideNextClass);o.length>0&&b.lazy.loadImageInSlide(o.index());var l=b.wrapper.children("."+b.params.slidePrevClass);l.length>0&&b.lazy.loadImageInSlide(l.index())}},onTransitionStart:function(){b.params.lazyLoading&&(b.params.lazyLoadingOnTransitionStart||!b.params.lazyLoadingOnTransitionStart&&!b.lazy.initialImageLoaded)&&b.lazy.load()},onTransitionEnd:function(){b.params.lazyLoading&&!b.params.lazyLoadingOnTransitionStart&&b.lazy.load()}},b.scrollbar={isTouched:!1,setDragPosition:function(e){var a=b.scrollbar,t=b.isHorizontal()?"touchstart"===e.type||"touchmove"===e.type?e.targetTouches[0].pageX:e.pageX||e.clientX:"touchstart"===e.type||"touchmove"===e.type?e.targetTouches[0].pageY:e.pageY||e.clientY,s=t-a.track.offset()[b.isHorizontal()?"left":"top"]-a.dragSize/2,i=-b.minTranslate()*a.moveDivider,r=-b.maxTranslate()*a.moveDivider;s<i?s=i:s>r&&(s=r),s=-s/a.moveDivider,b.updateProgress(s),b.setWrapperTranslate(s,!0)},dragStart:function(e){var a=b.scrollbar;a.isTouched=!0,e.preventDefault(),e.stopPropagation(),a.setDragPosition(e),clearTimeout(a.dragTimeout),a.track.transition(0),b.params.scrollbarHide&&a.track.css("opacity",1),b.wrapper.transition(100),a.drag.transition(100),b.emit("onScrollbarDragStart",b)},dragMove:function(e){var a=b.scrollbar;a.isTouched&&(e.preventDefault?e.preventDefault():e.returnValue=!1,a.setDragPosition(e),b.wrapper.transition(0),a.track.transition(0),a.drag.transition(0),b.emit("onScrollbarDragMove",b))},dragEnd:function(e){var a=b.scrollbar;a.isTouched&&(a.isTouched=!1,b.params.scrollbarHide&&(clearTimeout(a.dragTimeout),a.dragTimeout=setTimeout(function(){a.track.css("opacity",0),a.track.transition(400)},1e3)),b.emit("onScrollbarDragEnd",b),b.params.scrollbarSnapOnRelease&&b.slideReset())},draggableEvents:function(){return b.params.simulateTouch!==!1||b.support.touch?b.touchEvents:b.touchEventsDesktop}(),enableDraggable:function(){var e=b.scrollbar,t=b.support.touch?e.track:document;a(e.track).on(e.draggableEvents.start,e.dragStart),a(t).on(e.draggableEvents.move,e.dragMove),a(t).on(e.draggableEvents.end,e.dragEnd)},disableDraggable:function(){var e=b.scrollbar,t=b.support.touch?e.track:document;a(e.track).off(e.draggableEvents.start,e.dragStart),a(t).off(e.draggableEvents.move,e.dragMove),a(t).off(e.draggableEvents.end,e.dragEnd)},set:function(){if(b.params.scrollbar){var e=b.scrollbar;e.track=a(b.params.scrollbar),b.params.uniqueNavElements&&"string"==typeof b.params.scrollbar&&e.track.length>1&&1===b.container.find(b.params.scrollbar).length&&(e.track=b.container.find(b.params.scrollbar)),e.drag=e.track.find(".swiper-scrollbar-drag"),0===e.drag.length&&(e.drag=a('<div class="swiper-scrollbar-drag"></div>'),e.track.append(e.drag)),e.drag[0].style.width="",e.drag[0].style.height="",e.trackSize=b.isHorizontal()?e.track[0].offsetWidth:e.track[0].offsetHeight,e.divider=b.size/b.virtualSize,e.moveDivider=e.divider*(e.trackSize/b.size),e.dragSize=e.trackSize*e.divider,b.isHorizontal()?e.drag[0].style.width=e.dragSize+"px":e.drag[0].style.height=e.dragSize+"px",e.divider>=1?e.track[0].style.display="none":e.track[0].style.display="",b.params.scrollbarHide&&(e.track[0].style.opacity=0)}},setTranslate:function(){if(b.params.scrollbar){var e,a=b.scrollbar,t=(b.translate||0,a.dragSize);e=(a.trackSize-a.dragSize)*b.progress,b.rtl&&b.isHorizontal()?(e=-e,e>0?(t=a.dragSize-e,e=0):-e+a.dragSize>a.trackSize&&(t=a.trackSize+e)):e<0?(t=a.dragSize+e,e=0):e+a.dragSize>a.trackSize&&(t=a.trackSize-e),b.isHorizontal()?(b.support.transforms3d?a.drag.transform("translate3d("+e+"px, 0, 0)"):a.drag.transform("translateX("+e+"px)"),a.drag[0].style.width=t+"px"):(b.support.transforms3d?a.drag.transform("translate3d(0px, "+e+"px, 0)"):a.drag.transform("translateY("+e+"px)"),a.drag[0].style.height=t+"px"),b.params.scrollbarHide&&(clearTimeout(a.timeout),a.track[0].style.opacity=1,a.timeout=setTimeout(function(){a.track[0].style.opacity=0,a.track.transition(400)},1e3))}},setTransition:function(e){b.params.scrollbar&&b.scrollbar.drag.transition(e)}},b.controller={LinearSpline:function(e,a){this.x=e,this.y=a,this.lastIndex=e.length-1;var t,s;this.x.length;this.interpolate=function(e){return e?(s=i(this.x,e),t=s-1,(e-this.x[t])*(this.y[s]-this.y[t])/(this.x[s]-this.x[t])+this.y[t]):0};var i=function(){var e,a,t;return function(s,i){for(a=-1,e=s.length;e-a>1;)s[t=e+a>>1]<=i?a=t:e=t;return e}}()},getInterpolateFunction:function(e){b.controller.spline||(b.controller.spline=b.params.loop?new b.controller.LinearSpline(b.slidesGrid,e.slidesGrid):new b.controller.LinearSpline(b.snapGrid,e.snapGrid))},setTranslate:function(e,a){function s(a){e=a.rtl&&"horizontal"===a.params.direction?-b.translate:b.translate,"slide"===b.params.controlBy&&(b.controller.getInterpolateFunction(a),r=-b.controller.spline.interpolate(-e)),r&&"container"!==b.params.controlBy||(i=(a.maxTranslate()-a.minTranslate())/(b.maxTranslate()-b.minTranslate()),r=(e-b.minTranslate())*i+a.minTranslate()),b.params.controlInverse&&(r=a.maxTranslate()-r),a.updateProgress(r),a.setWrapperTranslate(r,!1,b),a.updateActiveIndex()}var i,r,n=b.params.control;if(b.isArray(n))for(var o=0;o<n.length;o++)n[o]!==a&&n[o]instanceof t&&s(n[o]);else n instanceof t&&a!==n&&s(n)},setTransition:function(e,a){function s(a){
a.setWrapperTransition(e,b),0!==e&&(a.onTransitionStart(),a.wrapper.transitionEnd(function(){r&&(a.params.loop&&"slide"===b.params.controlBy&&a.fixLoop(),a.onTransitionEnd())}))}var i,r=b.params.control;if(b.isArray(r))for(i=0;i<r.length;i++)r[i]!==a&&r[i]instanceof t&&s(r[i]);else r instanceof t&&a!==r&&s(r)}},b.hashnav={onHashCange:function(e,a){var t=document.location.hash.replace("#",""),s=b.slides.eq(b.activeIndex).attr("data-hash");t!==s&&b.slideTo(b.wrapper.children("."+b.params.slideClass+'[data-hash="'+t+'"]').index())},attachEvents:function(e){var t=e?"off":"on";a(window)[t]("hashchange",b.hashnav.onHashCange)},setHash:function(){if(b.hashnav.initialized&&b.params.hashnav)if(b.params.replaceState&&window.history&&window.history.replaceState)window.history.replaceState(null,null,"#"+b.slides.eq(b.activeIndex).attr("data-hash")||"");else{var e=b.slides.eq(b.activeIndex),a=e.attr("data-hash")||e.attr("data-history");document.location.hash=a||""}},init:function(){if(b.params.hashnav&&!b.params.history){b.hashnav.initialized=!0;var e=document.location.hash.replace("#","");if(e)for(var a=0,t=0,s=b.slides.length;t<s;t++){var i=b.slides.eq(t),r=i.attr("data-hash")||i.attr("data-history");if(r===e&&!i.hasClass(b.params.slideDuplicateClass)){var n=i.index();b.slideTo(n,a,b.params.runCallbacksOnInit,!0)}}b.params.hashnavWatchState&&b.hashnav.attachEvents()}},destroy:function(){b.params.hashnavWatchState&&b.hashnav.attachEvents(!0)}},b.history={init:function(){if(b.params.history){if(!window.history||!window.history.pushState)return b.params.history=!1,void(b.params.hashnav=!0);b.history.initialized=!0,this.paths=this.getPathValues(),(this.paths.key||this.paths.value)&&(this.scrollToSlide(0,this.paths.value,b.params.runCallbacksOnInit),b.params.replaceState||window.addEventListener("popstate",this.setHistoryPopState))}},setHistoryPopState:function(){b.history.paths=b.history.getPathValues(),b.history.scrollToSlide(b.params.speed,b.history.paths.value,!1)},getPathValues:function(){var e=window.location.pathname.slice(1).split("/"),a=e.length,t=e[a-2],s=e[a-1];return{key:t,value:s}},setHistory:function(e,a){if(b.history.initialized&&b.params.history){var t=b.slides.eq(a),s=this.slugify(t.attr("data-history"));window.location.pathname.includes(e)||(s=e+"/"+s),b.params.replaceState?window.history.replaceState(null,null,s):window.history.pushState(null,null,s)}},slugify:function(e){return e.toString().toLowerCase().replace(/\s+/g,"-").replace(/[^\w\-]+/g,"").replace(/\-\-+/g,"-").replace(/^-+/,"").replace(/-+$/,"")},scrollToSlide:function(e,a,t){if(a)for(var s=0,i=b.slides.length;s<i;s++){var r=b.slides.eq(s),n=this.slugify(r.attr("data-history"));if(n===a&&!r.hasClass(b.params.slideDuplicateClass)){var o=r.index();b.slideTo(o,e,t)}}else b.slideTo(0,e,t)}},b.disableKeyboardControl=function(){b.params.keyboardControl=!1,a(document).off("keydown",p)},b.enableKeyboardControl=function(){b.params.keyboardControl=!0,a(document).on("keydown",p)},b.mousewheel={event:!1,lastScrollTime:(new window.Date).getTime()},b.params.mousewheelControl&&(b.mousewheel.event=navigator.userAgent.indexOf("firefox")>-1?"DOMMouseScroll":d()?"wheel":"mousewheel"),b.disableMousewheelControl=function(){if(!b.mousewheel.event)return!1;var e=b.container;return"container"!==b.params.mousewheelEventsTarged&&(e=a(b.params.mousewheelEventsTarged)),e.off(b.mousewheel.event,u),!0},b.enableMousewheelControl=function(){if(!b.mousewheel.event)return!1;var e=b.container;return"container"!==b.params.mousewheelEventsTarged&&(e=a(b.params.mousewheelEventsTarged)),e.on(b.mousewheel.event,u),!0},b.parallax={setTranslate:function(){b.container.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(){m(this,b.progress)}),b.slides.each(function(){var e=a(this);e.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(){var a=Math.min(Math.max(e[0].progress,-1),1);m(this,a)})})},setTransition:function(e){"undefined"==typeof e&&(e=b.params.speed),b.container.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(){var t=a(this),s=parseInt(t.attr("data-swiper-parallax-duration"),10)||e;0===e&&(s=0),t.transition(s)})}},b.zoom={scale:1,currentScale:1,isScaling:!1,gesture:{slide:void 0,slideWidth:void 0,slideHeight:void 0,image:void 0,imageWrap:void 0,zoomMax:b.params.zoomMax},image:{isTouched:void 0,isMoved:void 0,currentX:void 0,currentY:void 0,minX:void 0,minY:void 0,maxX:void 0,maxY:void 0,width:void 0,height:void 0,startX:void 0,startY:void 0,touchesStart:{},touchesCurrent:{}},velocity:{x:void 0,y:void 0,prevPositionX:void 0,prevPositionY:void 0,prevTime:void 0},getDistanceBetweenTouches:function(e){if(e.targetTouches.length<2)return 1;var a=e.targetTouches[0].pageX,t=e.targetTouches[0].pageY,s=e.targetTouches[1].pageX,i=e.targetTouches[1].pageY,r=Math.sqrt(Math.pow(s-a,2)+Math.pow(i-t,2));return r},onGestureStart:function(e){var t=b.zoom;if(!b.support.gestures){if("touchstart"!==e.type||"touchstart"===e.type&&e.targetTouches.length<2)return;t.gesture.scaleStart=t.getDistanceBetweenTouches(e)}return t.gesture.slide&&t.gesture.slide.length||(t.gesture.slide=a(this),0===t.gesture.slide.length&&(t.gesture.slide=b.slides.eq(b.activeIndex)),t.gesture.image=t.gesture.slide.find("img, svg, canvas"),t.gesture.imageWrap=t.gesture.image.parent("."+b.params.zoomContainerClass),t.gesture.zoomMax=t.gesture.imageWrap.attr("data-swiper-zoom")||b.params.zoomMax,0!==t.gesture.imageWrap.length)?(t.gesture.image.transition(0),void(t.isScaling=!0)):void(t.gesture.image=void 0)},onGestureChange:function(e){var a=b.zoom;if(!b.support.gestures){if("touchmove"!==e.type||"touchmove"===e.type&&e.targetTouches.length<2)return;a.gesture.scaleMove=a.getDistanceBetweenTouches(e)}a.gesture.image&&0!==a.gesture.image.length&&(b.support.gestures?a.scale=e.scale*a.currentScale:a.scale=a.gesture.scaleMove/a.gesture.scaleStart*a.currentScale,a.scale>a.gesture.zoomMax&&(a.scale=a.gesture.zoomMax-1+Math.pow(a.scale-a.gesture.zoomMax+1,.5)),a.scale<b.params.zoomMin&&(a.scale=b.params.zoomMin+1-Math.pow(b.params.zoomMin-a.scale+1,.5)),a.gesture.image.transform("translate3d(0,0,0) scale("+a.scale+")"))},onGestureEnd:function(e){var a=b.zoom;!b.support.gestures&&("touchend"!==e.type||"touchend"===e.type&&e.changedTouches.length<2)||a.gesture.image&&0!==a.gesture.image.length&&(a.scale=Math.max(Math.min(a.scale,a.gesture.zoomMax),b.params.zoomMin),a.gesture.image.transition(b.params.speed).transform("translate3d(0,0,0) scale("+a.scale+")"),a.currentScale=a.scale,a.isScaling=!1,1===a.scale&&(a.gesture.slide=void 0))},onTouchStart:function(e,a){var t=e.zoom;t.gesture.image&&0!==t.gesture.image.length&&(t.image.isTouched||("android"===e.device.os&&a.preventDefault(),t.image.isTouched=!0,t.image.touchesStart.x="touchstart"===a.type?a.targetTouches[0].pageX:a.pageX,t.image.touchesStart.y="touchstart"===a.type?a.targetTouches[0].pageY:a.pageY))},onTouchMove:function(e){var a=b.zoom;if(a.gesture.image&&0!==a.gesture.image.length&&(b.allowClick=!1,a.image.isTouched&&a.gesture.slide)){a.image.isMoved||(a.image.width=a.gesture.image[0].offsetWidth,a.image.height=a.gesture.image[0].offsetHeight,a.image.startX=b.getTranslate(a.gesture.imageWrap[0],"x")||0,a.image.startY=b.getTranslate(a.gesture.imageWrap[0],"y")||0,a.gesture.slideWidth=a.gesture.slide[0].offsetWidth,a.gesture.slideHeight=a.gesture.slide[0].offsetHeight,a.gesture.imageWrap.transition(0),b.rtl&&(a.image.startX=-a.image.startX),b.rtl&&(a.image.startY=-a.image.startY));var t=a.image.width*a.scale,s=a.image.height*a.scale;if(!(t<a.gesture.slideWidth&&s<a.gesture.slideHeight)){if(a.image.minX=Math.min(a.gesture.slideWidth/2-t/2,0),a.image.maxX=-a.image.minX,a.image.minY=Math.min(a.gesture.slideHeight/2-s/2,0),a.image.maxY=-a.image.minY,a.image.touchesCurrent.x="touchmove"===e.type?e.targetTouches[0].pageX:e.pageX,a.image.touchesCurrent.y="touchmove"===e.type?e.targetTouches[0].pageY:e.pageY,!a.image.isMoved&&!a.isScaling){if(b.isHorizontal()&&Math.floor(a.image.minX)===Math.floor(a.image.startX)&&a.image.touchesCurrent.x<a.image.touchesStart.x||Math.floor(a.image.maxX)===Math.floor(a.image.startX)&&a.image.touchesCurrent.x>a.image.touchesStart.x)return void(a.image.isTouched=!1);if(!b.isHorizontal()&&Math.floor(a.image.minY)===Math.floor(a.image.startY)&&a.image.touchesCurrent.y<a.image.touchesStart.y||Math.floor(a.image.maxY)===Math.floor(a.image.startY)&&a.image.touchesCurrent.y>a.image.touchesStart.y)return void(a.image.isTouched=!1)}e.preventDefault(),e.stopPropagation(),a.image.isMoved=!0,a.image.currentX=a.image.touchesCurrent.x-a.image.touchesStart.x+a.image.startX,a.image.currentY=a.image.touchesCurrent.y-a.image.touchesStart.y+a.image.startY,a.image.currentX<a.image.minX&&(a.image.currentX=a.image.minX+1-Math.pow(a.image.minX-a.image.currentX+1,.8)),a.image.currentX>a.image.maxX&&(a.image.currentX=a.image.maxX-1+Math.pow(a.image.currentX-a.image.maxX+1,.8)),a.image.currentY<a.image.minY&&(a.image.currentY=a.image.minY+1-Math.pow(a.image.minY-a.image.currentY+1,.8)),a.image.currentY>a.image.maxY&&(a.image.currentY=a.image.maxY-1+Math.pow(a.image.currentY-a.image.maxY+1,.8)),a.velocity.prevPositionX||(a.velocity.prevPositionX=a.image.touchesCurrent.x),a.velocity.prevPositionY||(a.velocity.prevPositionY=a.image.touchesCurrent.y),a.velocity.prevTime||(a.velocity.prevTime=Date.now()),a.velocity.x=(a.image.touchesCurrent.x-a.velocity.prevPositionX)/(Date.now()-a.velocity.prevTime)/2,a.velocity.y=(a.image.touchesCurrent.y-a.velocity.prevPositionY)/(Date.now()-a.velocity.prevTime)/2,Math.abs(a.image.touchesCurrent.x-a.velocity.prevPositionX)<2&&(a.velocity.x=0),Math.abs(a.image.touchesCurrent.y-a.velocity.prevPositionY)<2&&(a.velocity.y=0),a.velocity.prevPositionX=a.image.touchesCurrent.x,a.velocity.prevPositionY=a.image.touchesCurrent.y,a.velocity.prevTime=Date.now(),a.gesture.imageWrap.transform("translate3d("+a.image.currentX+"px, "+a.image.currentY+"px,0)")}}},onTouchEnd:function(e,a){var t=e.zoom;if(t.gesture.image&&0!==t.gesture.image.length){if(!t.image.isTouched||!t.image.isMoved)return t.image.isTouched=!1,void(t.image.isMoved=!1);t.image.isTouched=!1,t.image.isMoved=!1;var s=300,i=300,r=t.velocity.x*s,n=t.image.currentX+r,o=t.velocity.y*i,l=t.image.currentY+o;0!==t.velocity.x&&(s=Math.abs((n-t.image.currentX)/t.velocity.x)),0!==t.velocity.y&&(i=Math.abs((l-t.image.currentY)/t.velocity.y));var p=Math.max(s,i);t.image.currentX=n,t.image.currentY=l;var d=t.image.width*t.scale,u=t.image.height*t.scale;t.image.minX=Math.min(t.gesture.slideWidth/2-d/2,0),t.image.maxX=-t.image.minX,t.image.minY=Math.min(t.gesture.slideHeight/2-u/2,0),t.image.maxY=-t.image.minY,t.image.currentX=Math.max(Math.min(t.image.currentX,t.image.maxX),t.image.minX),t.image.currentY=Math.max(Math.min(t.image.currentY,t.image.maxY),t.image.minY),t.gesture.imageWrap.transition(p).transform("translate3d("+t.image.currentX+"px, "+t.image.currentY+"px,0)")}},onTransitionEnd:function(e){var a=e.zoom;a.gesture.slide&&e.previousIndex!==e.activeIndex&&(a.gesture.image.transform("translate3d(0,0,0) scale(1)"),a.gesture.imageWrap.transform("translate3d(0,0,0)"),a.gesture.slide=a.gesture.image=a.gesture.imageWrap=void 0,a.scale=a.currentScale=1)},toggleZoom:function(e,t){var s=e.zoom;if(s.gesture.slide||(s.gesture.slide=e.clickedSlide?a(e.clickedSlide):e.slides.eq(e.activeIndex),s.gesture.image=s.gesture.slide.find("img, svg, canvas"),s.gesture.imageWrap=s.gesture.image.parent("."+e.params.zoomContainerClass)),s.gesture.image&&0!==s.gesture.image.length){var i,r,n,o,l,p,d,u,c,m,h,g,f,v,w,y,x,T;"undefined"==typeof s.image.touchesStart.x&&t?(i="touchend"===t.type?t.changedTouches[0].pageX:t.pageX,r="touchend"===t.type?t.changedTouches[0].pageY:t.pageY):(i=s.image.touchesStart.x,r=s.image.touchesStart.y),s.scale&&1!==s.scale?(s.scale=s.currentScale=1,s.gesture.imageWrap.transition(300).transform("translate3d(0,0,0)"),s.gesture.image.transition(300).transform("translate3d(0,0,0) scale(1)"),s.gesture.slide=void 0):(s.scale=s.currentScale=s.gesture.imageWrap.attr("data-swiper-zoom")||e.params.zoomMax,t?(x=s.gesture.slide[0].offsetWidth,T=s.gesture.slide[0].offsetHeight,n=s.gesture.slide.offset().left,o=s.gesture.slide.offset().top,l=n+x/2-i,p=o+T/2-r,c=s.gesture.image[0].offsetWidth,m=s.gesture.image[0].offsetHeight,h=c*s.scale,g=m*s.scale,f=Math.min(x/2-h/2,0),v=Math.min(T/2-g/2,0),w=-f,y=-v,d=l*s.scale,u=p*s.scale,d<f&&(d=f),d>w&&(d=w),u<v&&(u=v),u>y&&(u=y)):(d=0,u=0),s.gesture.imageWrap.transition(300).transform("translate3d("+d+"px, "+u+"px,0)"),s.gesture.image.transition(300).transform("translate3d(0,0,0) scale("+s.scale+")"))}},attachEvents:function(e){var t=e?"off":"on";if(b.params.zoom){var s=(b.slides,!("touchstart"!==b.touchEvents.start||!b.support.passiveListener||!b.params.passiveListeners)&&{passive:!0,capture:!1});b.support.gestures?(b.slides[t]("gesturestart",b.zoom.onGestureStart,s),b.slides[t]("gesturechange",b.zoom.onGestureChange,s),b.slides[t]("gestureend",b.zoom.onGestureEnd,s)):"touchstart"===b.touchEvents.start&&(b.slides[t](b.touchEvents.start,b.zoom.onGestureStart,s),b.slides[t](b.touchEvents.move,b.zoom.onGestureChange,s),b.slides[t](b.touchEvents.end,b.zoom.onGestureEnd,s)),b[t]("touchStart",b.zoom.onTouchStart),b.slides.each(function(e,s){a(s).find("."+b.params.zoomContainerClass).length>0&&a(s)[t](b.touchEvents.move,b.zoom.onTouchMove)}),b[t]("touchEnd",b.zoom.onTouchEnd),b[t]("transitionEnd",b.zoom.onTransitionEnd),b.params.zoomToggle&&b.on("doubleTap",b.zoom.toggleZoom)}},init:function(){b.zoom.attachEvents()},destroy:function(){b.zoom.attachEvents(!0)}},b._plugins=[];for(var O in b.plugins){var N=b.plugins[O](b,b.params[O]);N&&b._plugins.push(N)}return b.callPlugins=function(e){for(var a=0;a<b._plugins.length;a++)e in b._plugins[a]&&b._plugins[a][e](arguments[1],arguments[2],arguments[3],arguments[4],arguments[5])},b.emitterEventListeners={},b.emit=function(e){b.params[e]&&b.params[e](arguments[1],arguments[2],arguments[3],arguments[4],arguments[5]);var a;if(b.emitterEventListeners[e])for(a=0;a<b.emitterEventListeners[e].length;a++)b.emitterEventListeners[e][a](arguments[1],arguments[2],arguments[3],arguments[4],arguments[5]);b.callPlugins&&b.callPlugins(e,arguments[1],arguments[2],arguments[3],arguments[4],arguments[5])},b.on=function(e,a){return e=h(e),b.emitterEventListeners[e]||(b.emitterEventListeners[e]=[]),b.emitterEventListeners[e].push(a),b},b.off=function(e,a){var t;if(e=h(e),"undefined"==typeof a)return b.emitterEventListeners[e]=[],b;if(b.emitterEventListeners[e]&&0!==b.emitterEventListeners[e].length){for(t=0;t<b.emitterEventListeners[e].length;t++)b.emitterEventListeners[e][t]===a&&b.emitterEventListeners[e].splice(t,1);return b}},b.once=function(e,a){e=h(e);var t=function(){a(arguments[0],arguments[1],arguments[2],arguments[3],arguments[4]),b.off(e,t)};return b.on(e,t),b},b.a11y={makeFocusable:function(e){return e.attr("tabIndex","0"),e},addRole:function(e,a){return e.attr("role",a),e},addLabel:function(e,a){return e.attr("aria-label",a),e},disable:function(e){return e.attr("aria-disabled",!0),e},enable:function(e){return e.attr("aria-disabled",!1),e},onEnterKey:function(e){13===e.keyCode&&(a(e.target).is(b.params.nextButton)?(b.onClickNext(e),b.isEnd?b.a11y.notify(b.params.lastSlideMessage):b.a11y.notify(b.params.nextSlideMessage)):a(e.target).is(b.params.prevButton)&&(b.onClickPrev(e),b.isBeginning?b.a11y.notify(b.params.firstSlideMessage):b.a11y.notify(b.params.prevSlideMessage)),a(e.target).is("."+b.params.bulletClass)&&a(e.target)[0].click())},liveRegion:a('<span class="'+b.params.notificationClass+'" aria-live="assertive" aria-atomic="true"></span>'),notify:function(e){var a=b.a11y.liveRegion;0!==a.length&&(a.html(""),a.html(e))},init:function(){b.params.nextButton&&b.nextButton&&b.nextButton.length>0&&(b.a11y.makeFocusable(b.nextButton),b.a11y.addRole(b.nextButton,"button"),b.a11y.addLabel(b.nextButton,b.params.nextSlideMessage)),b.params.prevButton&&b.prevButton&&b.prevButton.length>0&&(b.a11y.makeFocusable(b.prevButton),b.a11y.addRole(b.prevButton,"button"),b.a11y.addLabel(b.prevButton,b.params.prevSlideMessage)),a(b.container).append(b.a11y.liveRegion)},initPagination:function(){b.params.pagination&&b.params.paginationClickable&&b.bullets&&b.bullets.length&&b.bullets.each(function(){var e=a(this);b.a11y.makeFocusable(e),b.a11y.addRole(e,"button"),b.a11y.addLabel(e,b.params.paginationBulletMessage.replace(/{{index}}/,e.index()+1))})},destroy:function(){b.a11y.liveRegion&&b.a11y.liveRegion.length>0&&b.a11y.liveRegion.remove()}},b.init=function(){b.params.loop&&b.createLoop(),b.updateContainerSize(),b.updateSlidesSize(),b.updatePagination(),b.params.scrollbar&&b.scrollbar&&(b.scrollbar.set(),b.params.scrollbarDraggable&&b.scrollbar.enableDraggable()),"slide"!==b.params.effect&&b.effects[b.params.effect]&&(b.params.loop||b.updateProgress(),b.effects[b.params.effect].setTranslate()),b.params.loop?b.slideTo(b.params.initialSlide+b.loopedSlides,0,b.params.runCallbacksOnInit):(b.slideTo(b.params.initialSlide,0,b.params.runCallbacksOnInit),0===b.params.initialSlide&&(b.parallax&&b.params.parallax&&b.parallax.setTranslate(),b.lazy&&b.params.lazyLoading&&(b.lazy.load(),b.lazy.initialImageLoaded=!0))),b.attachEvents(),b.params.observer&&b.support.observer&&b.initObservers(),b.params.preloadImages&&!b.params.lazyLoading&&b.preloadImages(),b.params.zoom&&b.zoom&&b.zoom.init(),b.params.autoplay&&b.startAutoplay(),b.params.keyboardControl&&b.enableKeyboardControl&&b.enableKeyboardControl(),b.params.mousewheelControl&&b.enableMousewheelControl&&b.enableMousewheelControl(),b.params.hashnavReplaceState&&(b.params.replaceState=b.params.hashnavReplaceState),b.params.history&&b.history&&b.history.init(),b.params.hashnav&&b.hashnav&&b.hashnav.init(),b.params.a11y&&b.a11y&&b.a11y.init(),b.emit("onInit",b)},b.cleanupStyles=function(){b.container.removeClass(b.classNames.join(" ")).removeAttr("style"),b.wrapper.removeAttr("style"),b.slides&&b.slides.length&&b.slides.removeClass([b.params.slideVisibleClass,b.params.slideActiveClass,b.params.slideNextClass,b.params.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-column").removeAttr("data-swiper-row"),b.paginationContainer&&b.paginationContainer.length&&b.paginationContainer.removeClass(b.params.paginationHiddenClass),b.bullets&&b.bullets.length&&b.bullets.removeClass(b.params.bulletActiveClass),b.params.prevButton&&a(b.params.prevButton).removeClass(b.params.buttonDisabledClass),b.params.nextButton&&a(b.params.nextButton).removeClass(b.params.buttonDisabledClass),b.params.scrollbar&&b.scrollbar&&(b.scrollbar.track&&b.scrollbar.track.length&&b.scrollbar.track.removeAttr("style"),b.scrollbar.drag&&b.scrollbar.drag.length&&b.scrollbar.drag.removeAttr("style"))},b.destroy=function(e,a){b.detachEvents(),b.stopAutoplay(),b.params.scrollbar&&b.scrollbar&&b.params.scrollbarDraggable&&b.scrollbar.disableDraggable(),b.params.loop&&b.destroyLoop(),a&&b.cleanupStyles(),b.disconnectObservers(),b.params.zoom&&b.zoom&&b.zoom.destroy(),b.params.keyboardControl&&b.disableKeyboardControl&&b.disableKeyboardControl(),b.params.mousewheelControl&&b.disableMousewheelControl&&b.disableMousewheelControl(),b.params.a11y&&b.a11y&&b.a11y.destroy(),b.params.history&&!b.params.replaceState&&window.removeEventListener("popstate",b.history.setHistoryPopState),b.params.hashnav&&b.hashnav&&b.hashnav.destroy(),b.emit("onDestroy"),e!==!1&&(b=null)},b.init(),b}};t.prototype={isSafari:function(){var e=window.navigator.userAgent.toLowerCase();return e.indexOf("safari")>=0&&e.indexOf("chrome")<0&&e.indexOf("android")<0}(),isUiWebView:/(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(window.navigator.userAgent),isArray:function(e){return"[object Array]"===Object.prototype.toString.apply(e)},browser:{ie:window.navigator.pointerEnabled||window.navigator.msPointerEnabled,ieTouch:window.navigator.msPointerEnabled&&window.navigator.msMaxTouchPoints>1||window.navigator.pointerEnabled&&window.navigator.maxTouchPoints>1,lteIE9:function(){var e=document.createElement("div");return e.innerHTML="<!--[if lte IE 9]><i></i><![endif]-->",1===e.getElementsByTagName("i").length}()},device:function(){var e=window.navigator.userAgent,a=e.match(/(Android);?[\s\/]+([\d.]+)?/),t=e.match(/(iPad).*OS\s([\d_]+)/),s=e.match(/(iPod)(.*OS\s([\d_]+))?/),i=!t&&e.match(/(iPhone\sOS|iOS)\s([\d_]+)/);return{ios:t||i||s,android:a}}(),support:{touch:window.Modernizr&&Modernizr.touch===!0||function(){return!!("ontouchstart"in window||window.DocumentTouch&&document instanceof DocumentTouch)}(),transforms3d:window.Modernizr&&Modernizr.csstransforms3d===!0||function(){var e=document.createElement("div").style;return"webkitPerspective"in e||"MozPerspective"in e||"OPerspective"in e||"MsPerspective"in e||"perspective"in e}(),flexbox:function(){for(var e=document.createElement("div").style,a="alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "),t=0;t<a.length;t++)if(a[t]in e)return!0}(),observer:function(){return"MutationObserver"in window||"WebkitMutationObserver"in window}(),passiveListener:function(){var e=!1;try{var a=Object.defineProperty({},"passive",{get:function(){e=!0}});window.addEventListener("testPassiveListener",null,a)}catch(e){}return e}(),gestures:function(){return"ongesturestart"in window}()},plugins:{}};for(var s=(function(){var e=function(e){var a=this,t=0;for(t=0;t<e.length;t++)a[t]=e[t];return a.length=e.length,this},a=function(a,t){var s=[],i=0;if(a&&!t&&a instanceof e)return a;if(a)if("string"==typeof a){var r,n,o=a.trim();if(o.indexOf("<")>=0&&o.indexOf(">")>=0){var l="div";for(0===o.indexOf("<li")&&(l="ul"),0===o.indexOf("<tr")&&(l="tbody"),0!==o.indexOf("<td")&&0!==o.indexOf("<th")||(l="tr"),0===o.indexOf("<tbody")&&(l="table"),0===o.indexOf("<option")&&(l="select"),n=document.createElement(l),n.innerHTML=a,i=0;i<n.childNodes.length;i++)s.push(n.childNodes[i])}else for(r=t||"#"!==a[0]||a.match(/[ .<>:~]/)?(t||document).querySelectorAll(a):[document.getElementById(a.split("#")[1])],i=0;i<r.length;i++)r[i]&&s.push(r[i])}else if(a.nodeType||a===window||a===document)s.push(a);else if(a.length>0&&a[0].nodeType)for(i=0;i<a.length;i++)s.push(a[i]);return new e(s)};return e.prototype={addClass:function(e){if("undefined"==typeof e)return this;for(var a=e.split(" "),t=0;t<a.length;t++)for(var s=0;s<this.length;s++)this[s].classList.add(a[t]);return this},removeClass:function(e){for(var a=e.split(" "),t=0;t<a.length;t++)for(var s=0;s<this.length;s++)this[s].classList.remove(a[t]);return this},hasClass:function(e){return!!this[0]&&this[0].classList.contains(e)},toggleClass:function(e){for(var a=e.split(" "),t=0;t<a.length;t++)for(var s=0;s<this.length;s++)this[s].classList.toggle(a[t]);return this},attr:function(e,a){if(1===arguments.length&&"string"==typeof e)return this[0]?this[0].getAttribute(e):void 0;for(var t=0;t<this.length;t++)if(2===arguments.length)this[t].setAttribute(e,a);else for(var s in e)this[t][s]=e[s],this[t].setAttribute(s,e[s]);return this},removeAttr:function(e){for(var a=0;a<this.length;a++)this[a].removeAttribute(e);return this},data:function(e,a){if("undefined"!=typeof a){for(var t=0;t<this.length;t++){var s=this[t];s.dom7ElementDataStorage||(s.dom7ElementDataStorage={}),s.dom7ElementDataStorage[e]=a}return this}if(this[0]){var i=this[0].getAttribute("data-"+e);return i?i:this[0].dom7ElementDataStorage&&e in this[0].dom7ElementDataStorage?this[0].dom7ElementDataStorage[e]:void 0}},transform:function(e){for(var a=0;a<this.length;a++){var t=this[a].style;t.webkitTransform=t.MsTransform=t.msTransform=t.MozTransform=t.OTransform=t.transform=e}return this},transition:function(e){"string"!=typeof e&&(e+="ms");for(var a=0;a<this.length;a++){var t=this[a].style;t.webkitTransitionDuration=t.MsTransitionDuration=t.msTransitionDuration=t.MozTransitionDuration=t.OTransitionDuration=t.transitionDuration=e}return this},on:function(e,t,s,i){function r(e){var i=e.target;if(a(i).is(t))s.call(i,e);else for(var r=a(i).parents(),n=0;n<r.length;n++)a(r[n]).is(t)&&s.call(r[n],e)}var n,o,l=e.split(" ");for(n=0;n<this.length;n++)if("function"==typeof t||t===!1)for("function"==typeof t&&(s=arguments[1],i=arguments[2]||!1),o=0;o<l.length;o++)this[n].addEventListener(l[o],s,i);else for(o=0;o<l.length;o++)this[n].dom7LiveListeners||(this[n].dom7LiveListeners=[]),this[n].dom7LiveListeners.push({listener:s,liveListener:r}),this[n].addEventListener(l[o],r,i);return this},off:function(e,a,t,s){for(var i=e.split(" "),r=0;r<i.length;r++)for(var n=0;n<this.length;n++)if("function"==typeof a||a===!1)"function"==typeof a&&(t=arguments[1],s=arguments[2]||!1),this[n].removeEventListener(i[r],t,s);else if(this[n].dom7LiveListeners)for(var o=0;o<this[n].dom7LiveListeners.length;o++)this[n].dom7LiveListeners[o].listener===t&&this[n].removeEventListener(i[r],this[n].dom7LiveListeners[o].liveListener,s);return this},once:function(e,a,t,s){function i(n){t(n),r.off(e,a,i,s)}var r=this;"function"==typeof a&&(a=!1,t=arguments[1],s=arguments[2]),r.on(e,a,i,s)},trigger:function(e,a){for(var t=0;t<this.length;t++){var s;try{s=new window.CustomEvent(e,{detail:a,bubbles:!0,cancelable:!0})}catch(t){s=document.createEvent("Event"),s.initEvent(e,!0,!0),s.detail=a}this[t].dispatchEvent(s)}return this},transitionEnd:function(e){function a(r){if(r.target===this)for(e.call(this,r),t=0;t<s.length;t++)i.off(s[t],a)}var t,s=["webkitTransitionEnd","transitionend","oTransitionEnd","MSTransitionEnd","msTransitionEnd"],i=this;if(e)for(t=0;t<s.length;t++)i.on(s[t],a);return this},width:function(){return this[0]===window?window.innerWidth:this.length>0?parseFloat(this.css("width")):null},outerWidth:function(e){return this.length>0?e?this[0].offsetWidth+parseFloat(this.css("margin-right"))+parseFloat(this.css("margin-left")):this[0].offsetWidth:null},height:function(){return this[0]===window?window.innerHeight:this.length>0?parseFloat(this.css("height")):null},outerHeight:function(e){return this.length>0?e?this[0].offsetHeight+parseFloat(this.css("margin-top"))+parseFloat(this.css("margin-bottom")):this[0].offsetHeight:null},offset:function(){if(this.length>0){var e=this[0],a=e.getBoundingClientRect(),t=document.body,s=e.clientTop||t.clientTop||0,i=e.clientLeft||t.clientLeft||0,r=window.pageYOffset||e.scrollTop,n=window.pageXOffset||e.scrollLeft;return{top:a.top+r-s,left:a.left+n-i}}return null},css:function(e,a){var t;if(1===arguments.length){if("string"!=typeof e){for(t=0;t<this.length;t++)for(var s in e)this[t].style[s]=e[s];return this}if(this[0])return window.getComputedStyle(this[0],null).getPropertyValue(e)}if(2===arguments.length&&"string"==typeof e){for(t=0;t<this.length;t++)this[t].style[e]=a;return this}return this},each:function(e){for(var a=0;a<this.length;a++)e.call(this[a],a,this[a]);return this},html:function(e){if("undefined"==typeof e)return this[0]?this[0].innerHTML:void 0;for(var a=0;a<this.length;a++)this[a].innerHTML=e;return this},text:function(e){if("undefined"==typeof e)return this[0]?this[0].textContent.trim():null;for(var a=0;a<this.length;a++)this[a].textContent=e;return this},is:function(t){if(!this[0])return!1;var s,i;if("string"==typeof t){var r=this[0];if(r===document)return t===document;if(r===window)return t===window;if(r.matches)return r.matches(t);if(r.webkitMatchesSelector)return r.webkitMatchesSelector(t);if(r.mozMatchesSelector)return r.mozMatchesSelector(t);if(r.msMatchesSelector)return r.msMatchesSelector(t);for(s=a(t),i=0;i<s.length;i++)if(s[i]===this[0])return!0;return!1}if(t===document)return this[0]===document;if(t===window)return this[0]===window;if(t.nodeType||t instanceof e){for(s=t.nodeType?[t]:t,i=0;i<s.length;i++)if(s[i]===this[0])return!0;return!1}return!1},index:function(){if(this[0]){for(var e=this[0],a=0;null!==(e=e.previousSibling);)1===e.nodeType&&a++;return a}},eq:function(a){if("undefined"==typeof a)return this;var t,s=this.length;return a>s-1?new e([]):a<0?(t=s+a,new e(t<0?[]:[this[t]])):new e([this[a]])},append:function(a){var t,s;for(t=0;t<this.length;t++)if("string"==typeof a){var i=document.createElement("div");for(i.innerHTML=a;i.firstChild;)this[t].appendChild(i.firstChild)}else if(a instanceof e)for(s=0;s<a.length;s++)this[t].appendChild(a[s]);else this[t].appendChild(a);return this},prepend:function(a){var t,s;for(t=0;t<this.length;t++)if("string"==typeof a){var i=document.createElement("div");for(i.innerHTML=a,s=i.childNodes.length-1;s>=0;s--)this[t].insertBefore(i.childNodes[s],this[t].childNodes[0])}else if(a instanceof e)for(s=0;s<a.length;s++)this[t].insertBefore(a[s],this[t].childNodes[0]);else this[t].insertBefore(a,this[t].childNodes[0]);return this},insertBefore:function(e){for(var t=a(e),s=0;s<this.length;s++)if(1===t.length)t[0].parentNode.insertBefore(this[s],t[0]);else if(t.length>1)for(var i=0;i<t.length;i++)t[i].parentNode.insertBefore(this[s].cloneNode(!0),t[i])},insertAfter:function(e){for(var t=a(e),s=0;s<this.length;s++)if(1===t.length)t[0].parentNode.insertBefore(this[s],t[0].nextSibling);else if(t.length>1)for(var i=0;i<t.length;i++)t[i].parentNode.insertBefore(this[s].cloneNode(!0),t[i].nextSibling)},next:function(t){return new e(this.length>0?t?this[0].nextElementSibling&&a(this[0].nextElementSibling).is(t)?[this[0].nextElementSibling]:[]:this[0].nextElementSibling?[this[0].nextElementSibling]:[]:[])},nextAll:function(t){var s=[],i=this[0];if(!i)return new e([]);for(;i.nextElementSibling;){var r=i.nextElementSibling;t?a(r).is(t)&&s.push(r):s.push(r),i=r}return new e(s)},prev:function(t){return new e(this.length>0?t?this[0].previousElementSibling&&a(this[0].previousElementSibling).is(t)?[this[0].previousElementSibling]:[]:this[0].previousElementSibling?[this[0].previousElementSibling]:[]:[])},prevAll:function(t){var s=[],i=this[0];if(!i)return new e([]);for(;i.previousElementSibling;){var r=i.previousElementSibling;t?a(r).is(t)&&s.push(r):s.push(r),i=r}return new e(s)},parent:function(e){for(var t=[],s=0;s<this.length;s++)e?a(this[s].parentNode).is(e)&&t.push(this[s].parentNode):t.push(this[s].parentNode);return a(a.unique(t))},parents:function(e){for(var t=[],s=0;s<this.length;s++)for(var i=this[s].parentNode;i;)e?a(i).is(e)&&t.push(i):t.push(i),i=i.parentNode;return a(a.unique(t))},find:function(a){for(var t=[],s=0;s<this.length;s++)for(var i=this[s].querySelectorAll(a),r=0;r<i.length;r++)t.push(i[r]);return new e(t)},children:function(t){for(var s=[],i=0;i<this.length;i++)for(var r=this[i].childNodes,n=0;n<r.length;n++)t?1===r[n].nodeType&&a(r[n]).is(t)&&s.push(r[n]):1===r[n].nodeType&&s.push(r[n]);return new e(a.unique(s))},remove:function(){for(var e=0;e<this.length;e++)this[e].parentNode&&this[e].parentNode.removeChild(this[e]);return this},add:function(){var e,t,s=this;for(e=0;e<arguments.length;e++){var i=a(arguments[e]);for(t=0;t<i.length;t++)s[s.length]=i[t],s.length++}return s}},a.fn=e.prototype,a.unique=function(e){for(var a=[],t=0;t<e.length;t++)a.indexOf(e[t])===-1&&a.push(e[t]);return a},a}()),i=["jQuery","Zepto","Dom7"],r=0;r<i.length;r++)window[i[r]]&&e(window[i[r]]);var n;n="undefined"==typeof s?window.Dom7||window.Zepto||window.jQuery:s,n&&("transitionEnd"in n.fn||(n.fn.transitionEnd=function(e){function a(r){if(r.target===this)for(e.call(this,r),t=0;t<s.length;t++)i.off(s[t],a)}var t,s=["webkitTransitionEnd","transitionend","oTransitionEnd","MSTransitionEnd","msTransitionEnd"],i=this;if(e)for(t=0;t<s.length;t++)i.on(s[t],a);return this}),"transform"in n.fn||(n.fn.transform=function(e){for(var a=0;a<this.length;a++){var t=this[a].style;t.webkitTransform=t.MsTransform=t.msTransform=t.MozTransform=t.OTransform=t.transform=e}return this}),"transition"in n.fn||(n.fn.transition=function(e){"string"!=typeof e&&(e+="ms");for(var a=0;a<this.length;a++){var t=this[a].style;t.webkitTransitionDuration=t.MsTransitionDuration=t.msTransitionDuration=t.MozTransitionDuration=t.OTransitionDuration=t.transitionDuration=e;
}return this}),"outerWidth"in n.fn||(n.fn.outerWidth=function(e){return this.length>0?e?this[0].offsetWidth+parseFloat(this.css("margin-right"))+parseFloat(this.css("margin-left")):this[0].offsetWidth:null})),window.Swiper=t}(),"undefined"!=typeof module?module.exports=window.Swiper:"function"==typeof define&&define.amd&&define([],function(){"use strict";return window.Swiper});
//# sourceMappingURL=maps/swiper.min.js.map
$(function(){
    // Category Best
    var swiper3 = new Swiper('.relation_prd2 .swiper-container', {
        nextButton: '.relation_prd2 .swiper-next',
        prevButton: '.relation_prd2 .swiper-prev',
        slidesPerView: 4,
        spaceBetween: 30,
        loop: false,
        autoplay: false,
        autoplayDisableOnInteraction: false
    });
    
    // Detail Tab Move
    var $hdH = $(".headerTop").height()+2;
    var $gnbH = $(".gnb").height()+2;
    var $headerTopH = $hdH + $gnbH + 20;
    $(".detail_section").each(function(){
        var $detailNum = $(this).index();
        $(this).attr("id", "detail"+$detailNum);
    });
    $(".detail_tab li").click(function(){
        var $tabNum = $(this).index();
        $("html, body").animate({
            scrollTop : $("#detail"+$tabNum).offset().top - $headerTopH + 130
        }, 100);
    });
    
    //buy now button
    $(window).scroll(function(){
        var $winScroll = $(window).scrollTop();
        if($winScroll > 800){
            $(".show_infobt").fadeIn();
            $(".infoArea").addClass("order_layer");
        } else {
            $(".show_infobt").fadeOut();
            $(".infoArea").removeClass("order_layer");
            $(".infoArea").show();
        }
    });
    
    $(".show_infobt").click(function(){
        var $order_layer = $(".order_layer").css("display");
        if($order_layer == "none"){
            $(".order_layer").fadeIn();
            $(this).children(".txt").text("CLOSE");
        } else {
            $(".order_layer").fadeOut();
            $(this).children(".txt").text("BUY NOW");
        }
    });
    
    // xans-product-relationlist 
    var relation_length = $(".xans-product-relationlist > ul > li").length;
    var relation_w = $(".xans-product-relationlist > ul > li").width();
    var relation_resize = relation_w*relation_length+"px";
    var relation_show = $(".xans-product-relationlist").width() / relation_w;
    var relation_max = relation_length - relation_show;
    $(".xans-product-relationlist > ul").css("width", relation_resize);
    $(".xans-product-relationlist").css("overflow", "hidden");
    
    var relation_cnt = 1;
    if(relation_show < relation_length){
        $(".relation_next").click(function(){
            if(relation_cnt <= relation_max){
                relation_cnt++;
                $(".xans-product-relationlist > ul").stop().animate({
                    "margin-left" : "-="+(relation_w)+"px"
                }, 100);
            }
        });
        $(".relation_prev").click(function(){
            if(relation_cnt > 1){
                relation_cnt--;
                $(".xans-product-relationlist > ul").stop().animate({
                    "margin-left" : "+="+(relation_w)+"px"
                }, 100);
            }
        });
    }
    
    
    
});

/**
 * 상품상세 섬네일 롤링
 */
$(document).ready(function(){
    $.fn.prdImg = function(parm){
        var index = 0;
        var target = parm.target;
        var view = parm.view;
        var listWrap = target.find('.xans-product-addimage');
        var limit = listWrap.find('> ul > li').length;
        var ul = target.find('.xans-product-addimage > ul');
        var liFirst = target.find('.xans-product-addimage > ul > li:first-child');
        var liWidth = parseInt(liFirst.width());
        var liHeight = parseInt(liFirst.height());
        var blockWidth = liWidth + parseInt(liFirst.css('marginRight')) + parseInt(liFirst.css('marginLeft'));
        var columWidth = blockWidth * view;
        var colum = Math.ceil(limit / view);

        var roll = {
            init : function(){
                function struct(){
                    var ulWidth = limit * parseInt(blockWidth);
                    listWrap.append('<button type="button" class="prev">이전</button>');
                    listWrap.append('<button type="button" class="next">다음</button>');
                    ul.css({'position':'absolute', 'left':0, 'top':0, 'width':ulWidth});
                    listWrap.find('> ul > li').each(function(){
                        $(this).css({'float':'left'});
                    });
                    listWrap.css({'position':'relative', 'height':liHeight});

                    var prev = listWrap.find('.prev');
                    var next = listWrap.find('.next');

                    prev.click(function(){
                        if(index > 0){
                            index --;
                        }
                        roll.slide(index);
                    });
                    next.click(function(){
                        if(index < (colum-1) ){
                            index ++;
                        }
                        roll.slide(index);
                    });
                    if(index == 0){
                        prev.hide();
                    } else {
                        prev.show();
                    }
                    if(index >= (colum-1)){
                        next.hide();
                    } else {
                        next.show();
                    }
                }
                if(limit > view){
                    struct();
                }
            },
            slide : function(index){
                var left = '-' + (index * columWidth) +'px';
                var prev = listWrap.find('.prev');
                var next = listWrap.find('.next');
                if(index == 0){
                    prev.hide();
                } else {
                    prev.show();
                }
                if(index >= (colum-1)){
                    next.hide();
                } else {
                    next.show();
                }
                ul.stop().animate({'left':left},500);
            }
        }
        roll.init();
    };

    // 함수호출 : 상품상세 페이지
    $.fn.prdImg({
        target : $('.xans-product-image'),
        view : 5
    });

    // 함수호출 : 상품확대보기팝업
    $.fn.prdImg({
        target : $('.xans-product-zoom'),
        view : 5
    });

});
/**
 * 상품상세 사용후기
 */
$(document).ready(function(){
    $('.xans-product-review a').click(function(e) {
        e.preventDefault();

        var no = $(this).attr('href').replace(/(\S*)[?&]no=(\d+)(\S*)/g, '$2');
        var $obj = $('#product-review-read_'+no);

        //로드된 엘리먼트 존재 체크
        if ($obj.length > 0) {
            if ($obj.css('display') =='none') {
                $obj.show();
            } else {
                $obj.hide();
            }
            return;
        }

        REVIEW.getReadData($(this));
    });
});

var PARENT = '';

var OPEN_REVIEW = '';

var REVIEW = {
    getReadData : function(obj, eType)
    {
        if (obj != undefined) {
            PARENT = obj;
            var sHref = obj.attr('href');
            var pNode = obj.parents('tr');
            var pass_check = '&pass_check=F';
        } else {
            var sHref = PARENT.attr('href');
            var pNode = PARENT.parents('tr');
            var pass_check = '&pass_check=T';
        }

        var sQuery = sHref.split('?');

        var sQueryNo = sQuery[1].split('=');
        if (OPEN_REVIEW == sQueryNo[1]) {
            $('#product-review-read').remove();
            OPEN_REVIEW = '';
            return false;
        } else {
            OPEN_REVIEW = sQueryNo[1];
        }

        $.ajax({
            url : '/exec/front/board/product/4?'+sQuery[1]+pass_check,
            dataType: 'json',
            success: function(data) {
                $('#product-review-read').remove();

                var sPath = document.location.pathname;
                var sPattern = /^\/product\/(.+)\/([0-9]+)(\/.*)/;
                var aMatchResult = sPath.match(sPattern);

                if (aMatchResult) {
                    var iProductNo = aMatchResult[2];
                } else {
                    var iProductNo = getQueryString('product_no');
                }

                var aHtml = [];

                //읽기 권한 체크
                if (false === data.read_auth && eType == undefined) {
                    alert(decodeURIComponent(data.alertMSG));

                    //로그인페이지 이동
                    if (data.returnUrl != undefined) {
                        location.replace("/member/login.html?returnUrl=" + data.returnUrl);
                    }
                    return false;
                }

                if (data.is_secret == true) {
                    // 비밀글 비밀번호 입력 폼
                    aHtml.push('<form name="SecretForm_4" id="SecretForm_4">');
                    aHtml.push('<input type="text" name="a" style="display:none;">');
                    aHtml.push('<div class="view"><p>비밀번호 <input type="password" id="secure_password" name="secure_password" onkeydown="if (event.keyCode == 13) '+data.action_pass_submit+'"> <input type="button" value="확인" onclick="'+data.action_pass_submit+'"></p></div>');
                    aHtml.push('</form>');
                } else {
                    // 글 내용
                    if (data.read['content_image'] != null) {
                        var sImg = data.read['content_image'];
                    } else {
                        var sImg = '';
                    }

                    aHtml.push('<div class="view">');
                    aHtml.push('<p>'+data.read['content']+'</p>');
                    aHtml.push('<p>'+sImg+'</p>');
                    aHtml.push('<p class="ec-base-button"><span class="gLeft">');
                    if (data.write_auth == true) {
                        aHtml.push('<a href="/board/product/modify.html?board_act=edit&no='+data.no+'&board_no=4&link_product_no='+iProductNo+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/product/btn_board_modify.gif" alt="게시글 수정하기" /></a>');
                    }
                    aHtml.push('</span></p>');
                    aHtml.push('</div>');

                    // 댓글리스트
                    if (data.comment != undefined && data.comment.length != undefined) {
                        aHtml.push('<ul class="boardComment">');
                        for (var i=0; data.comment.length > i; i++) {
                            //댓글리스트
                            if (data.comment[i]['comment_reply_css'] == undefined) {
                                aHtml.push('<li>');
                                aHtml.push('<strong class="name">'+data.comment[i]['member_icon']+' '+data.comment[i]['comment_name']+'</strong>');
                                aHtml.push('<span class="date">'+data.comment[i]['comment_write_date']+'</span>');
                                aHtml.push('<span class="grade '+data.use_point+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/ico_point'+data.comment[i]['comment_point_count']+'.gif" alt="'+data.comment[i]['comment_point_count']+'점" /></span>');
                                if (data.comment[i]['comment_reply_display'] == true) {
                                    aHtml.push('<span class="button">'+'<a href="#none" onclick="'+data.comment[i]['action_comment_reply']+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/btn_ico_reply.gif" alt="댓글" /></a>'+'</span>');
                                }
                                aHtml.push('<p class="comment">'+data.comment[i]['comment_icon_lock']+' '+data.comment[i]['comment_content']+'</p>');
                                aHtml.push('</li>');
                            } else {
                                //댓글의 댓글리스트
                                aHtml.push('<li class="replyArea">');
                                aHtml.push('<strong class="name">'+data.comment[i]['member_icon']+' '+data.comment[i]['comment_name']+'</strong>');
                                aHtml.push('<span class="date">'+data.comment[i]['comment_write_date']+'</span>');
                                aHtml.push('<p class="comment">'+data.comment[i]['comment_icon_lock']+' '+data.comment[i]['comment_content']+'</p>');
                                aHtml.push('</li>');
                            }
                        }
                        aHtml.push('</ul>');
                    }

                    // 댓글쓰기
                    if (data.comment_write != undefined) {
                        aHtml.push('<form name="commentWriteForm_4'+data.key+'" id="commentWriteForm_4'+data.key+'">');
                        aHtml.push('<div class="memoCont">');
                        aHtml.push('<div class="writer">');
                        aHtml.push('<p class="user"><span class="nameArea">이름 '+data.comment_write['comment_name']+' 비밀번호 '+data.comment_write['comment_password']);
                        if (data.comment_write['comment_secret_display'] == true) {
                            aHtml.push('<label class="secret">'+data.comment_write['secure']+' 비밀댓글</label>');
                        }
                        aHtml.push('</span>');
                        aHtml.push(''+data.comment_write['comment']+'<a href="#none" onclick="'+data.comment_write['action_comment_insert']+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/btn_comment_submit.gif" alt="확인" /></a></p>');
                        aHtml.push('<p class="rating '+data.comment_write['use_point']+'">'+data.comment_write['comment_point']+'</p>');
                        aHtml.push('<p class="text '+data.comment_write['use_comment_size']+'">'+data.comment_write['comment_byte']+' / '+data.comment_write['comment_size']+' byte</p>');
                        aHtml.push('<p class="captcha '+data.comment_write['use_captcha']+'">'+data.comment_write['captcha_image']+data.comment_write['captcha_refresh']+data.comment_write['captcha']+'<img src="//img.echosting.cafe24.com/skin/base/common/ico_info.gif" alt="" /> 왼쪽의 문자를 공백없이 입력하세요.(대소문자구분)</p>');
                        aHtml.push('</div>');
                        aHtml.push('</div>');
                        aHtml.push('</form>');
                    }

                    // 댓글의 댓글쓰기
                    if (data.comment_reply != undefined) {
                        aHtml.push('<form name="commentReplyWriteForm_4'+data.key+'" id="commentReplyWriteForm_4'+data.key+'" style="display:none">');
                        aHtml.push('<div class="memoCont reply">');
                        aHtml.push('<div class="writer">');
                        aHtml.push('<p class="user"><span class="nameArea">이름 '+data.comment_reply['comment_name']+' 비밀번호 '+data.comment_reply['comment_password']);
                        if (data.comment_reply['comment_secret_display'] == true) {
                            aHtml.push('<label class="secret">'+data.comment_reply['secure']+' 비밀댓글</label>');
                        }
                        aHtml.push('</span>');
                        aHtml.push(''+data.comment_reply['comment']+'<a href="#none" onclick="'+data.comment_reply['action_comment_insert']+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/btn_comment_submit.gif" alt="확인" /></a></p>');
                        aHtml.push('<p class="text '+data.comment_reply['use_comment_size']+'">'+data.comment_reply['comment_byte']+' / '+data.comment_reply['comment_size']+' byte</p>');
                        aHtml.push('<p class="captcha '+data.comment_reply['use_captcha']+'">'+data.comment_reply['captcha_image']+data.comment_write['captcha_refresh']+data.comment_reply['captcha']+'<img src="//img.echosting.cafe24.com/skin/base/common/ico_info.gif" alt="" /> 왼쪽의 문자를 공백없이 입력하세요.(대소문자구분)</p>');
                        aHtml.push('</div>');
                        aHtml.push('</div>');
                        aHtml.push('</form>');
                    }
                    // 비밀댓글 확인
                    if (data.comment_secret != undefined) {
                        aHtml.push('<form name="commentSecretForm_4'+data.key+'" id="commentSecretForm_4'+data.key+'" style="display:none">');
                        aHtml.push('<div class="commentSecret">');
                        aHtml.push('<p>비밀번호 : '+data.comment_secret['secure_password']);
                        aHtml.push(' <a href="#none" onclick="'+data.comment_secret['action_secret_submit']+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/btn_ico_submit.gif" alt="확인" /></a>');
                        aHtml.push(' <a href="#none" onclick="'+data.comment_secret['action_secret_cancel']+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/btn_ico_cancel.gif" alt="취소" /></a></p>');
                        aHtml.push('</div>');
                        aHtml.push('</form>');
                    }
                }

                $(pNode).after('<tr id="product-review-read'+data.key+'"><td colspan="6">'+aHtml.join('')+'</td></tr>');

                // 평점기능 사용안함일 경우 보여지는 td를 조절하기 위한 함수
                PRODUCT_COMMENT.comment_colspan(pNode);

                if (data.comment_write != undefined && data.comment_write['use_comment_size'] == '') PRODUCT_COMMENT.comment_byte(4, data.key);
                if (data.comment_reply != undefined && data.comment_write['use_comment_size'] == '') PRODUCT_COMMENT.comment_byte(4, data.key, 'commentReplyWriteForm');
            }
        });
    },

    END : function() {}
};
/**
 * 상품상세 Q&A
 */
$(document).ready(function(){
    $('.xans-product-qna a').click(function(e) {
        e.preventDefault();

        var no = $(this).attr('href').replace(/(\S*)[?&]no=(\d+)(\S*)/g, '$2');
        var $obj = $('#product-qna-read_'+no);

        //로드된 엘리먼트 존재 체크
        if ($obj.length > 0) {
            if ($obj.css('display') =='none') {
                $obj.show();
            } else {
                $obj.hide();
            }
            return;
        }

        QNA.getReadData($(this));

    });
});

var PARENT = '';

var OPEN_QNA = '';

var QNA = {
    getReadData : function(obj, eType)
    {
        if (obj != undefined) {
            PARENT = obj;
            var sHref = obj.attr('href');
            var pNode = obj.parents('tr');
            var pass_check = '&pass_check=F';
        } else {
            var sHref = PARENT.attr('href');
            var pNode = PARENT.parents('tr');
            var pass_check = '&pass_check=T';
        }

        var sQuery = sHref.split('?');

        var sQueryNo = sQuery[1].split('=');
        if (OPEN_QNA == sQueryNo[1]) {
            $('#product-qna-read').remove();
            OPEN_QNA = '';
            return false;
        } else {
            OPEN_QNA = sQueryNo[1];
        }

        $.ajax({
            url : '/exec/front/board/product/6?'+sQuery[1]+pass_check,
            dataType: 'json',
            success: function(data) {
                $('#product-qna-read').remove();

                var sPath = document.location.pathname;
                var sPattern = /^\/product\/(.+)\/([0-9]+)(\/.*)/;
                var aMatchResult = sPath.match(sPattern);

                if (aMatchResult) {
                    var iProductNo = aMatchResult[2];
                } else {
                    var iProductNo = getQueryString('product_no');
                }

                var aHtml = [];

                //읽기 권한 체크
                if (false === data.read_auth && eType == undefined) {
                    alert(decodeURIComponent(data.alertMSG));

                    //로그인페이지 이동
                    if (data.returnUrl != undefined) {
                        location.replace("/member/login.html?returnUrl=" + data.returnUrl);
                    }
                    return false;
                }

                if (data.is_secret == true) {
                    // 비밀글 비밀번호 입력 폼
                    aHtml.push('<form name="SecretForm_6" id="SecretForm_6">');
                    aHtml.push('<input type="text" name="a" style="display:none;">');
                    aHtml.push('<div class="view"><p>비밀번호 <input type="password" id="secure_password" name="secure_password" onkeydown="if (event.keyCode == 13) '+data.action_pass_submit+'"> <input type="button" value="확인" onclick="'+data.action_pass_submit+'"></p></div>');
                    aHtml.push('</form>');
                } else {
                    // 글 내용
                    if (data.read['content_image'] != null) {
                        var sImg = data.read['content_image'];
                    } else {
                        var sImg = '';
                    }

                    aHtml.push('<div class="view">');
                    aHtml.push('<p>'+data.read['content']+'</p>');
                    aHtml.push('<p>'+sImg+'</p>');
                    aHtml.push('<p class="ec-base-button"><span class="gLeft">');
                    if (data.write_auth == true) {
                        aHtml.push('<a href="/board/product/modify.html?board_act=edit&no='+data.no+'&board_no=6&link_product_no='+iProductNo+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/product/btn_board_modify.gif" alt="게시글 수정하기" /></a>');
                    }
                    aHtml.push('</span></p>');
                    aHtml.push('</div>');

                    // 댓글리스트
                    if (data.comment != undefined && data.comment.length != undefined) {
                        aHtml.push('<ul class="boardComment">');
                        for (var i=0; data.comment.length > i; i++) {
                            //댓글리스트
                            if (data.comment[i]['comment_reply_css'] == undefined) {
                                aHtml.push('<li>');
                                aHtml.push('<strong class="name">'+data.comment[i]['member_icon']+' '+data.comment[i]['comment_name']+'</strong>');
                                aHtml.push('<span class="date">'+data.comment[i]['comment_write_date']+'</span>');
                                aHtml.push('<span class="grade '+data.use_point+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/ico_point'+data.comment[i]['comment_point_count']+'.gif" alt="'+data.comment[i]['comment_point_count']+'점" /></span>');
                                if (data.comment[i]['comment_reply_display'] == true) {
                                    aHtml.push('<span class="button">'+'<a href="#none" onclick="'+data.comment[i]['action_comment_reply']+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/btn_ico_reply.gif" alt="댓글" /></a>'+'</span>');
                                }
                                aHtml.push('<p class="comment">'+data.comment[i]['comment_icon_lock']+' '+data.comment[i]['comment_content']+'</p>');
                                aHtml.push('</li>');
                            } else {
                                //댓글의 댓글리스트
                                aHtml.push('<li class="replyArea">');
                                aHtml.push('<strong class="name">'+data.comment[i]['member_icon']+' '+data.comment[i]['comment_name']+'</strong>');
                                aHtml.push('<span class="date">'+data.comment[i]['comment_write_date']+'</span>');
                                aHtml.push('<p class="comment">'+data.comment[i]['comment_icon_lock']+' '+data.comment[i]['comment_content']+'</p>');
                                aHtml.push('</li>');
                            }
                        }
                        aHtml.push('</ul>');
                    }

                    // 댓글쓰기
                    if (data.comment_write != undefined) {
                        aHtml.push('<form name="commentWriteForm_6'+data.key+'" id="commentWriteForm_6'+data.key+'">');
                        aHtml.push('<div class="memoCont">');
                        aHtml.push('<div class="writer">');
                        aHtml.push('<p class="user"><span class="nameArea">이름 '+data.comment_write['comment_name']+' 비밀번호 '+data.comment_write['comment_password']);
                        if (data.comment_write['comment_secret_display'] == true) {
                            aHtml.push('<label class="secret">'+data.comment_write['secure']+' 비밀댓글</label>');
                        }
                        aHtml.push('</span>');
                        aHtml.push(''+data.comment_write['comment']+'<a href="#none" onclick="'+data.comment_write['action_comment_insert']+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/btn_comment_submit.gif" alt="확인" /></a></p>');
                        aHtml.push('<p class="rating '+data.comment_write['use_point']+'">'+data.comment_write['comment_point']+'</p>');
                        aHtml.push('<p class="text '+data.comment_write['use_comment_size']+'">'+data.comment_write['comment_byte']+' / '+data.comment_write['comment_size']+' byte</p>');
                        aHtml.push('<p class="captcha '+data.comment_write['use_captcha']+'">'+data.comment_write['captcha_image']+data.comment_write['captcha_refresh']+data.comment_write['captcha']+'<img src="//img.echosting.cafe24.com/skin/base/common/ico_info.gif" alt="" /> 왼쪽의 문자를 공백없이 입력하세요.(대소문자구분)</p>');
                        aHtml.push('</div>');
                        aHtml.push('</div>');
                        aHtml.push('</form>');
                    }

                    // 댓글의 댓글쓰기
                    if (data.comment_reply != undefined) {
                        aHtml.push('<form name="commentReplyWriteForm_6'+data.key+'" id="commentReplyWriteForm_6'+data.key+'" style="display:none">');
                        aHtml.push('<div class="memoCont reply">');
                        aHtml.push('<div class="writer">');
                        aHtml.push('<p class="user"><span class="nameArea">이름 '+data.comment_reply['comment_name']+' 비밀번호 '+data.comment_reply['comment_password']);
                        if (data.comment_reply['comment_secret_display'] == true) {
                            aHtml.push('<label class="secret">'+data.comment_reply['secure']+' 비밀댓글</label>');
                        }
                        aHtml.push('</span>');
                        aHtml.push(''+data.comment_reply['comment']+'<a href="#none" onclick="'+data.comment_reply['action_comment_insert']+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/btn_comment_submit.gif" alt="확인" /></a></p>');
                        aHtml.push('<p class="text '+data.comment_reply['use_comment_size']+'">'+data.comment_reply['comment_byte']+' / '+data.comment_reply['comment_size']+' byte</p>');
                        aHtml.push('<p class="captcha '+data.comment_reply['use_captcha']+'">'+data.comment_reply['captcha_image']+data.comment_reply['captcha_refresh']+data.comment_reply['captcha']+'<img src="//img.echosting.cafe24.com/skin/base/common/ico_info.gif" alt="" /> 왼쪽의 문자를 공백없이 입력하세요.(대소문자구분)</p>');
                        aHtml.push('</div>');
                        aHtml.push('</div>');
                        aHtml.push('</form>');
                    }
                    // 비밀댓글 확인
                    if (data.comment_secret != undefined) {
                        aHtml.push('<form name="commentSecretForm_6'+data.key+'" id="commentSecretForm_6'+data.key+'" style="display:none">');
                        aHtml.push('<div class="commentSecret">');
                        aHtml.push('<p>비밀번호 : '+data.comment_secret['secure_password']);
                        aHtml.push(' <a href="#none" onclick="'+data.comment_secret['action_secret_submit']+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/btn_ico_submit.gif" alt="확인" /></a>');
                        aHtml.push(' <a href="#none" onclick="'+data.comment_secret['action_secret_cancel']+'"><img src="//img.echosting.cafe24.com/skin/base_ko_KR/board/btn_ico_cancel.gif" alt="취소" /></a></p>');
                        aHtml.push('</div>');
                        aHtml.push('</form>');
                    }
                }

                $(pNode).after('<tr id="product-qna-read'+data.key+'"><td colspan="6">'+aHtml.join('')+'</td></tr>');

                // 평점기능 사용안함일 경우 보여지는 td를 조절하기 위한 함수
                PRODUCT_COMMENT.comment_colspan(pNode);

                if (data.comment_write != undefined && data.comment_write['use_comment_size'] == '') PRODUCT_COMMENT.comment_byte(6, data.key);
                if (data.comment_reply != undefined && data.comment_write['use_comment_size'] == '') PRODUCT_COMMENT.comment_byte(6, data.key, 'commentReplyWriteForm');
            }
        });
    },

    END : function() {}
};
/**
 * 움직이는 배너 Jquery Plug-in
 * @author  cafe24
 */

(function($){

    $.fn.floatBanner = function(options) {
        options = $.extend({}, $.fn.floatBanner.defaults , options);

        return this.each(function() {
            var aPosition = $(this).position();
            var jbOffset = $(this).offset();
            var node = this;

            $(window).scroll(function() {
                var _top = $(document).scrollTop();
                _top = (aPosition.top < _top) ? _top : aPosition.top;

                setTimeout(function () {
                    var newinit = $(document).scrollTop();

                    if ( newinit > jbOffset.top ) {
                        _top -= jbOffset.top;
                        var container_height = $("#wrap").height();
                        var quick_height = $(node).height();
                        var cul = container_height - quick_height;
                        if(_top > cul){
                            _top = cul;
                        }
                    }else {
                        _top = 0;
                    }

                    $(node).stop().animate({top: _top}, options.animate);
                }, options.delay);
            });
        });
    };

    $.fn.floatBanner.defaults = {
        'animate'  : 500,
        'delay'    : 500
    };

})(jQuery);

/**
 * 문서 구동후 시작
 */
$(document).ready(function(){
    $('#banner:visible, #quick:visible').floatBanner();

    //placeholder
    $(".ePlaceholder input, .ePlaceholder textarea").each(function(i){
        var placeholderName = $(this).parents().attr('title');
        $(this).attr("placeholder", placeholderName);
    });
    /* placeholder ie8, ie9 */
    $.fn.extend({
        placeholder : function() {
            //IE 8 버전에는 hasPlaceholderSupport() 값이 false를 리턴
           if (hasPlaceholderSupport() === true) {
                return this;
            }
            //hasPlaceholderSupport() 값이 false 일 경우 아래 코드를 실행
            return this.each(function(){
                var findThis = $(this);
                var sPlaceholder = findThis.attr('placeholder');
                if ( ! sPlaceholder) {
                   return;
                }
                findThis.wrap('<label class="ePlaceholder" />');
                var sDisplayPlaceHolder = $(this).val() ? ' style="display:none;"' : '';
                findThis.before('<span' + sDisplayPlaceHolder + '>' + sPlaceholder + '</span>');
                this.onpropertychange = function(e){
                    e = event || e;
                    if (e.propertyName == 'value') {
                        $(this).trigger('focusout');
                    }
                };
                //공통 class
                var agent = navigator.userAgent.toLowerCase();
                if (agent.indexOf("msie") != -1) {
                    $(".ePlaceholder").css({"position":"relative"});
                    $(".ePlaceholder span").css({"position":"absolute", "padding":"0 4px", "color":"#878787"});
                    $(".ePlaceholder label").css({"padding":"0"});
                }
            });
        }
    });

    $(':input[placeholder]').placeholder(); //placeholder() 함수를 호출

    //클릭하면 placeholder 숨김
    $('body').delegate('.ePlaceholder span', 'click', function(){
        $(this).hide();
    });

    //input창 포커스 인 일때 placeholder 숨김
    $('body').delegate('.ePlaceholder :input', 'focusin', function(){
        $(this).prev('span').hide();
    });

    //input창 포커스 아웃 일때 value 가 true 이면 숨김, false 이면 보여짐
    $('body').delegate('.ePlaceholder :input', 'focusout', function(){
        if (this.value) {
            $(this).prev('span').hide();
        } else {
            $(this).prev('span').show();
        }
    });

    //input에 placeholder가 지원이 되면 true를 안되면 false를 리턴값으로 던져줌
    function hasPlaceholderSupport() {
        if ('placeholder' in document.createElement('input')) {
            return true;
        } else {
            return false;
        }
    }
});

/**
 *  썸네일 이미지 엑박일경우 기본값 설정
 */
$(window).load(function() {
    $("img.thumb,img.ThumbImage,img.BigImage").each(function($i,$item){
        var $img = new Image();
        $img.onerror = function () {
                $item.src="//img.echosting.cafe24.com/thumb/img_product_big.gif";
        }
        $img.src = this.src;
    });
});
//window popup script
function winPop(url) {
    window.open(url, "popup", "width=300,height=300,left=10,top=10,resizable=no,scrollbars=no");
}
/**
 * document.location.href split
 * return array Param
 */
function getQueryString(sKey)
{
    var sQueryString = document.location.search.substring(1);
    var aParam       = {};

    if (sQueryString) {
        var aFields = sQueryString.split("&");
        var aField  = [];
        for (var i=0; i<aFields.length; i++) {
            aField = aFields[i].split('=');
            aParam[aField[0]] = aField[1];
        }
    }

    aParam.page = aParam.page ? aParam.page : 1;
    return sKey ? aParam[sKey] : aParam;
};

$(document).ready(function(){
    // tab
    $.eTab = function(ul){
        $(ul).find('a').click(function(){
            var _li = $(this).parent('li').addClass('selected').siblings().removeClass('selected'),
                _target = $(this).attr('href'),
                _siblings = '.' + $(_target).attr('class');
            $(_target).show().siblings(_siblings).hide();
            return false
        });
    }
    if ( window.call_eTab ) {
        call_eTab();
    };
});
(function($){
$.fn.extend({
    center: function() {
        this.each(function() {
            var
                $this = $(this),
                $w = $(window);
            $this.css({
                position: "absolute",
                top: ~~(($w.height() - $this.outerHeight()) / 2) + $w.scrollTop() + "px",
                left: ~~(($w.width() - $this.outerWidth()) / 2) + $w.scrollLeft() + "px"
            });
        });
        return this;
    }
});
$(function() {
    var $container = function(){/*
<div id="modalContainer">
    <iframe id="modalContent" scroll="0" scrolling="no" frameBorder="0"></iframe>
</div>');
*/}.toString().slice(14,-3);
    $('body')
    .append($('<div id="modalBackpanel"></div>'))
    .append($($container));
    function closeModal () {
        $('#modalContainer').hide();
        $('#modalBackpanel').hide();
    }
    $('#modalBackpanel').click(closeModal);
    zoom = function ($piProductNo, $piCategoryNo, $piDisplayGroup) {
        var $url = '/product/image_zoom.html?product_no=' + $piProductNo + '&cate_no=' + $piCategoryNo + '&display_group=' + $piDisplayGroup;
        $('#modalContent').attr('src', $url);
        $('#modalContent').bind("load",function(){
            $(".header .close",this.contentWindow.document.body).bind("click", closeModal);
        });
        $('#modalBackpanel').css({width:$("body").width(),height:$("body").height(),opacity:.4}).show();
        $('#modalContainer').center().show();
    }
});
})(jQuery);
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Â© 2001 Robert Penner
 * All rights reserved.
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Â© 2008 George McGinley Smith
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/
jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,f,a,h,g){return jQuery.easing[jQuery.easing.def](e,f,a,h,g)},easeInQuad:function(e,f,a,h,g){return h*(f/=g)*f+a},easeOutQuad:function(e,f,a,h,g){return -h*(f/=g)*(f-2)+a},easeInOutQuad:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f+a}return -h/2*((--f)*(f-2)-1)+a},easeInCubic:function(e,f,a,h,g){return h*(f/=g)*f*f+a},easeOutCubic:function(e,f,a,h,g){return h*((f=f/g-1)*f*f+1)+a},easeInOutCubic:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f+a}return h/2*((f-=2)*f*f+2)+a},easeInQuart:function(e,f,a,h,g){return h*(f/=g)*f*f*f+a},easeOutQuart:function(e,f,a,h,g){return -h*((f=f/g-1)*f*f*f-1)+a},easeInOutQuart:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f+a}return -h/2*((f-=2)*f*f*f-2)+a},easeInQuint:function(e,f,a,h,g){return h*(f/=g)*f*f*f*f+a},easeOutQuint:function(e,f,a,h,g){return h*((f=f/g-1)*f*f*f*f+1)+a},easeInOutQuint:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f*f+a}return h/2*((f-=2)*f*f*f*f+2)+a},easeInSine:function(e,f,a,h,g){return -h*Math.cos(f/g*(Math.PI/2))+h+a},easeOutSine:function(e,f,a,h,g){return h*Math.sin(f/g*(Math.PI/2))+a},easeInOutSine:function(e,f,a,h,g){return -h/2*(Math.cos(Math.PI*f/g)-1)+a},easeInExpo:function(e,f,a,h,g){return(f==0)?a:h*Math.pow(2,10*(f/g-1))+a},easeOutExpo:function(e,f,a,h,g){return(f==g)?a+h:h*(-Math.pow(2,-10*f/g)+1)+a},easeInOutExpo:function(e,f,a,h,g){if(f==0){return a}if(f==g){return a+h}if((f/=g/2)<1){return h/2*Math.pow(2,10*(f-1))+a}return h/2*(-Math.pow(2,-10*--f)+2)+a},easeInCirc:function(e,f,a,h,g){return -h*(Math.sqrt(1-(f/=g)*f)-1)+a},easeOutCirc:function(e,f,a,h,g){return h*Math.sqrt(1-(f=f/g-1)*f)+a},easeInOutCirc:function(e,f,a,h,g){if((f/=g/2)<1){return -h/2*(Math.sqrt(1-f*f)-1)+a}return h/2*(Math.sqrt(1-(f-=2)*f)+1)+a},easeInElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return -(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e},easeOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return g*Math.pow(2,-10*h)*Math.sin((h*k-i)*(2*Math.PI)/j)+l+e},easeInOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k/2)==2){return e+l}if(!j){j=k*(0.3*1.5)}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}if(h<1){return -0.5*(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e}return g*Math.pow(2,-10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j)*0.5+l+e},easeInBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*(f/=h)*f*((g+1)*f-g)+a},easeOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*((f=f/h-1)*f*((g+1)*f+g)+1)+a},easeInOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}if((f/=h/2)<1){return i/2*(f*f*(((g*=(1.525))+1)*f-g))+a}return i/2*((f-=2)*f*(((g*=(1.525))+1)*f+g)+2)+a},easeInBounce:function(e,f,a,h,g){return h-jQuery.easing.easeOutBounce(e,g-f,0,h,g)+a},easeOutBounce:function(e,f,a,h,g){if((f/=g)<(1/2.75)){return h*(7.5625*f*f)+a}else{if(f<(2/2.75)){return h*(7.5625*(f-=(1.5/2.75))*f+0.75)+a}else{if(f<(2.5/2.75)){return h*(7.5625*(f-=(2.25/2.75))*f+0.9375)+a}else{return h*(7.5625*(f-=(2.625/2.75))*f+0.984375)+a}}}},easeInOutBounce:function(e,f,a,h,g){if(f<g/2){return jQuery.easing.easeInBounce(e,f*2,0,h,g)*0.5+a}return jQuery.easing.easeOutBounce(e,f*2-g,0,h,g)*0.5+h*0.5+a}});
$(function(){
    $("#JD-Right .btn_right_open").removeClass("on");
    
});
$(function(){

    // header
    function joinP_ani(){
        $(".join_p").animate({left: "-3px"}, function(){
            $(this).animate({left: "0"});
        })
    }
    z = setInterval(joinP_ani, 1000);
    
    // header fixed
    var $topH = $(".headerTop").height()+1;
    var $logoH = $("div.logo").height()+1;
    var $gnbH = $(".gnb").height()+1;
    var $gnbTop = $(".gnb").offset().top;
    $(window).scroll(function(){
        var $scroll = $(window).scrollTop();
        if($gnbTop <= $scroll){
            $("#JD-Header .gnb").addClass("fixed");
            $("#JD-Header").css("padding-bottom", $gnbH + "px");
        } else {
            $("#JD-Header .gnb").removeClass("fixed");
            $("#JD-Header").css("padding-bottom", 0);
        }
    });
    
    $(".headerTop .member .language a img").click(function(){
        var $allpad = $(".headerTop .member .language_list").css("display");
        if($allpad == "none"){
            $(".headerTop .member .language_list").slideDown();    
        } else {
            $(".headerTop .member .language_list").slideUp();
        }
    });
    
    //장바구니 replace
    function cart_replace(){
        var cart_txt = $(".cartBlock span").text();
        $(".cartBlock span").text(cart_txt.replace("개", ""));
    }
    setTimeout(cart_replace, 100);
    
    // right panel
    var $right_panel = 180;
    $(".btn_right_open").click(function(){
        var $panel_w = $("#JD-Right .panel").width();
        if($panel_w == "0"){
            $("#JD-Right .panel").stop().animate({width : $right_panel+"px"}, 150);
            $(this).children("img.on").animate({opacity: 1});
            $(this).children("img:first-child").animate({opacity: 0});
        } else {
            $("#JD-Right .panel").stop().animate({width : 0}, 150);
            $(this).children("img.on").animate({opacity: 0});
            $(this).children("img:first-child").animate({opacity: 1});
        }
    });
    
    
    // list top best
    $(".list_over.best li").hover(function(){
        var $bestNum = $(this).index()+1;
        var $bestTxt = $(this).find(".best_icon").text()+" "+$bestNum;
        $(this).find(".best_icon").text($bestTxt);
    }, function(){
        $(this).find(".best_icon").text("BEST");
    });
    
    // list top new
    $(".list_over.new li").hover(function(){
        var $newNum = $(this).index()+1;
        var $newTxt = $(this).find(".new_icon").text()+" "+$newNum;
        $(this).find(".new_icon").text($newTxt);
    }, function(){
        $(this).find(".new_icon").text("NEW");
    });

    
    // cateAll
    $(".gnb .siteMenu img").click(function(){
        var $allpad = $(".cateWrap").css("display");
        if($allpad == "none"){
            $(".cateWrap").slideDown();    
            $(".siteMenu img.on").fadeIn();
            $(".siteMenu img.off").fadeOut();
        } else {
            $(".cateWrap").slideUp();
            $(".siteMenu img.on").fadeOut();
            $(".siteMenu img.off").fadeIn();
        }
    });
    
    // option wrap span
    var option_icon_length = $(".iconBox .thumb").next("a").length;
    if(option_icon_length > 0){
        $(".iconBox .thumb").next("a").wrap("<span></span>");
        $(".icon_txt").each(function(){
            $(this).appendTo($(this).prev("span"));
        });
    }
    
	//메인 리뷰 리스트 노출시
	$('.review_item').each(function() {
		$(this).find('> a').each(function() {
			var $review_img = $(this).find('img').first();
			var review_item_img = $(this).find('img');

			//파일 확장자 확인
			var reviewFileNm = $(this).find('img').attr('src');
			if (reviewFileNm != "") {
				var ext = reviewFileNm.slice(reviewFileNm.lastIndexOf(".") + 1).toLowerCase();
				if (!(ext == "gif" || ext == "jpg" || ext == "jpeg" || ext == "Jpg" || ext == "Jpeg" || ext == "png" || ext == "bmp")) {
					$review_img.siblings().addClass('default_img');
					$('.default_img').prev().remove();
					$('.default_img').css('margin-top', '-'+$('.default_img').outerHeight()/2+'px');
					$('.default_img').css('margin-left', '-'+$('.default_img').outerWidth()/2+'px');
				} else {
					$review_img.addClass('review_img');
					$review_img.parent('a').addClass('photo');
					review_item_img.css('margin-top', '-'+review_item_img.outerHeight()/2+'px');
					review_item_img.css('margin-left', '-'+review_item_img.outerWidth()/2+'px');
				}
			}
		});
	});

	$('.mv_img *').hide();
	$('.mv_img img').show();
	$('.mv_board_list').each(function() {
		var mv_change = $(this).find("iframe").attr("src").split("/");
		$(this).find(".mv_img .mv_thumb").attr("src", "http://img.youtube.com/vi/" + mv_change[4]+"/0.jpg");
	});    
    

    //할인율 표시
    function comm_discount_rate() {
        $('.discount_rate').each(function() {
            var el = $(this);
    
            var price = el.attr('data-price'); el.removeAttr('data-price');
            var sale = el.attr('data-sale'); el.removeAttr('data-sale');
        
            price = parseInt(price.replace(/,/g, ''));
            sale = parseInt(sale.replace(/,/g, ''));
        
            var rate = 0;
            if (!isNaN(price) && !isNaN(sale) && 0 < price) {
                rate = Math.round((price - sale) / price * 100);
            }
            el.html(rate+'<span>%</span>');
        
            rate = Math.ceil(rate / 10) * 10;
            
            el.addClass('rate' + rate);
            if(rate>0){
                el.show();
            } else {
                el.hide();
            }
        });
    }
    comm_discount_rate();

	//메인 리뷰 리스트 노출시
	$('.review_item').each(function() {
		$(this).find('> a').each(function() {
			var $review_img = $(this).find('img').first();
			var review_item_img = $(this).find('img');

			//파일 확장자 확인
			var reviewFileNm = $(this).find('img').attr('src');
			if (reviewFileNm != "") {
				var ext = reviewFileNm.slice(reviewFileNm.lastIndexOf(".") + 1).toLowerCase();
				if (!(ext == "gif" || ext == "jpg" || ext == "jpeg" || ext == "Jpg" || ext == "Jpeg" || ext == "png" || ext == "bmp")) {
					$review_img.siblings().addClass('default_img');
					$('.default_img').prev().remove();
					$('.default_img').css('margin-top', '-'+$('.default_img').outerHeight()/2+'px');
					$('.default_img').css('margin-left', '-'+$('.default_img').outerWidth()/2+'px');
				} else {
					$review_img.addClass('review_img');
					$review_img.parent('a').addClass('photo');
					review_item_img.css('margin-top', '-'+review_item_img.outerHeight()/2+'px');
					review_item_img.css('margin-left', '-'+review_item_img.outerWidth()/2+'px');
				}
			}
		});
	});

});

$(function(){
    var header_bnn = new Swiper('.header_bnn .swiper-container', {
        //direction: 'vertical',
        effect: 'fade',
        pagination: '.header_bnn .swiper-pagination',
        nextButton: '.header_bnn .swiper-button-next',
        prevButton: '.header_bnn .swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 30,
        loop: true,
        autoplay: 4000,
        autoplayDisableOnInteraction: false
    });
});
$(function(){
    var methods = {
        aCategory    : [],
        aSubCategory : {},

        get: function()
        {
             $.ajax({
                url : '/exec/front/Product/SubCategory',
                dataType: 'json',
                success: function(aData) {

                    if (aData == null || aData == 'undefined') return;
                    for (var i=0; i<aData.length; i++)
                    {
                        var sParentCateNo = aData[i].parent_cate_no;

                        if (!methods.aSubCategory[sParentCateNo]) {
                            methods.aSubCategory[sParentCateNo] = [];
                        }

                        methods.aSubCategory[sParentCateNo].push( aData[i] );
                    }
                }
            });
        },

        getParam: function(sUrl, sKey) {

            var aUrl         = sUrl.split('?');
            var sQueryString = aUrl[1];
            var aParam       = {};

            if (sQueryString) {
                var aFields = sQueryString.split("&");
                var aField  = [];
                for (var i=0; i<aFields.length; i++) {
                    aField = aFields[i].split('=');
                    aParam[aField[0]] = aField[1];
                }
            }
            return sKey ? aParam[sKey] : aParam;
        },

        getParamSeo: function(sUrl) {
            var aUrl         = sUrl.split('/');
            return aUrl[3] ? aUrl[3] : null;
        },

        show: function(overNode, iCateNo) {

            /*
            if (methods.aSubCategory[iCateNo].length == 0) {
                return;
            }
            */
            var aHtml = [];
            aHtml.push('<ul>');
            $(methods.aSubCategory[iCateNo]).each(function() {
                aHtml.push('<li><a href="'+this.link_product_list+'">'+this.name+'</a></li>');
            });
            aHtml.push('</ul>');
            var offset = $(overNode).offset();
            $("<div class='sub-category'></div>")
            .appendTo(overNode)
            .html(aHtml.join(''))
            /*
            .find('li').mouseover(function(e) {
                $(this).addClass('over');
            }).mouseout(function(e) {
                $(this).removeClass('over');
            })*/;
        },
        close: function() {
            $('.sub-category').remove();
        }
    };
    methods.get();

    $('.xans-layout-category li').mouseenter(function(e) {
        var $this = $(this).addClass('on'),
        iCateNo = Number(methods.getParam($this.find('a').attr('href'), 'cate_no'));

        if (!iCateNo) {
            iCateNo = Number(methods.getParamSeo($this.find('a').attr('href')));
        }

        if (!iCateNo) {
           return;
        }

        methods.show($this, iCateNo);
     }).mouseleave(function(e) {
        $(this).removeClass('on');

          methods.close();
     });

    $(".gnb li").hover(function(){
        var $div = $(this).children("div");
        var $subLeng = $div.children("ul").children("li").length;
        var $this_index = $(this).index();
        if($subLeng == "0"){
            $(".gnb > li").removeClass("none");
            $div.addClass("none");
            $(this).addClass("none");
        } else {
            $(this).removeClass("none");
        }
        var $sub_eq = $(".sub-cate-img p").eq($this_index);
        var $sub_img = $sub_eq.html();
        $($sub_img).appendTo($div).wrap("<span class='cate-bnn'></span>");
    });

    
});
$(function(){
    
    var swiper1 = new Swiper('.panelBnn .swiper-container', {
        pagination: '.panelBnn .swiper-pagination',
        nextButton: '.panelBnn .swiper-button-next',
        prevButton: '.panelBnn .swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 30,
        loop: true,
        autoplay: 4000,
        autoplayDisableOnInteraction: false
    });
    // right auto rolling
    var rightBnn_cnt = 1;
    var bnnLength = $(".todayView li").length;
    $(".todayView li").each(function(){
        var $rightBnn = $(this).index()+1;
        $(this).addClass("bnn"+$rightBnn);
    });
    function right_next(){
        $(".todayView li.bnn" + rightBnn_cnt).stop().fadeOut();
        rightBnn_cnt ++;
        if(bnnLength < rightBnn_cnt){
            rightBnn_cnt = 1;
        }
        $(".todayView li.bnn" + rightBnn_cnt).stop().fadeIn();
    }
    function right_prev(){
        $(".todayView li.bnn" + rightBnn_cnt).stop().fadeOut();
        rightBnn_cnt --;
        if(1 > rightBnn_cnt){
            rightBnn_cnt = bnnLength;
        }
        $(".todayView li.bnn" + rightBnn_cnt).stop().fadeIn();
    }
    
    z = setInterval(right_next, 3000);
    $(".todayView").hover(function(){
        clearInterval(z);
    }, function(){
        clearInterval(z);
        setInterval(right_next, 3000);
    });
    $(".btn_prev").click(function(){
        clearInterval(z);
        right_prev();
    });
    $(".btn_next").click(function(){
        clearInterval(z);
        right_next();
    });
    
});
/**
 * 카테고리 마우스 오버 이미지
 * 카테고리 서브 메뉴 출력
 */

$(document).ready(function(){

    var methods = {
        aCategory    : [],
        aSubCategory : {},

        get: function()
        {
             $.ajax({
                url : '/exec/front/Product/SubCategory',
                dataType: 'json',
                success: function(aData) {

                    if (aData == null || aData == 'undefined') return;
                    for (var i=0; i<aData.length; i++)
                    {
                        var sParentCateNo = aData[i].parent_cate_no;

                        if (!methods.aSubCategory[sParentCateNo]) {
                            methods.aSubCategory[sParentCateNo] = [];
                        }

                        methods.aSubCategory[sParentCateNo].push( aData[i] );
                    }
					methods.print_cate();
					methods.print_cateAll();
                }
            });
        },

        getParam: function(sUrl, sKey) {

            var aUrl         = sUrl.split('?');
            var sQueryString = aUrl[1];
            var aParam       = {};

            if (sQueryString) {
                var aFields = sQueryString.split("&");
                var aField  = [];
                for (var i=0; i<aFields.length; i++) {
                    aField = aFields[i].split('=');
                    aParam[aField[0]] = aField[1];
                }
            }
            return sKey ? aParam[sKey] : aParam;
        },

        show: function(overNode, iCateNo) {
            if (methods.aSubCategory[iCateNo].length == 0) {
                return;
            }

            var aHtml = [];
            aHtml.push('<ul>');
            $(methods.aSubCategory[iCateNo]).each(function() {
                aHtml.push('<li><a href="/'+this.design_page_url+this.param+'">'+this.name+'</a></li>');
            });
            aHtml.push('</ul>');

            var offset = $(overNode).offset();
            $('<div class="sub-category"></div>')
                .appendTo(overNode)
                .html(aHtml.join(''))
                .find('li').mouseover(function(e) {
                    $(this).addClass('over');
                }).mouseout(function(e) {
                    $(this).removeClass('over');
                });
        },
        close: function() {
            $('.sub-category').remove();
        },
		
        print_cate: function() {

			$('#Category_Menu li').each(function() {

				var iCateNo = Number(methods.getParam($(this).find('a').attr('href'), 'cate_no'));
				var iCount = $(methods.aSubCategory[iCateNo]).length;
				if (iCount == 0) { return; }

				var aHtml = [];
				aHtml.push('<ul class="Category_Submenu">');
				$(methods.aSubCategory[iCateNo]).each(function() {
					aHtml.push('<li><a href="/'+this.design_page_url+this.param+'">'+this.name+'</a></li>');
				});
				aHtml.push('</ul>');
				$(aHtml.join('')).appendTo(this);

			});

        },
        print_cateAll: function() {

			$('#category_all li').each(function() {
				
				var aHtml = [];
				var dep = 2;
				var iCateNo = Number(methods.getParam($(this).find('a').attr('href'), 'cate_no'));
				var iCount = $(methods.aSubCategory[iCateNo]).length;
				$(this).addClass("cateMenu_1");
				if (iCount > 0) {
					aHtml = methods.Category_All_Call(aHtml,dep,iCateNo);
					$(aHtml.join('')).appendTo(this);
				} else {
					return;
				}

			});
        },
        Category_All_Call: function(aHtml,dep,iCateNo) {
			var nowClass = "cateDep_" + dep;
			var nowClassSub = "cateMenu_" + dep;
			aHtml.push('<ul class="'+nowClass+'">');

			$(methods.aSubCategory[iCateNo]).each(function() {
				
				var jCateNo = this.cate_no;
				var iCount = $(methods.aSubCategory[jCateNo]).length;

				aHtml.push('<li class="'+nowClassSub+'"><a href="/'+this.design_page_url+this.param+'">'+this.name+'</a>');
				
				/* 2뎁스까지만 처리 */
				if (iCount > 0 && dep < 2) {
					dep = dep + 1;
					aHtml = methods.Category_All_Call(aHtml,dep,jCateNo);
					dep = dep - 1;
				}

				aHtml.push('</li>');

			});
			
			aHtml.push('</ul>');

			return aHtml;

        }
    };

    methods.get();

	/*
    $('.xans-layout-category ul.Category_List li').mouseenter(function(e) {

		var $this = $(this).addClass('on'),
		iCateNo = Number(methods.getParam($this.find('a').attr('href'), 'cate_no'));
		if (!iCateNo) { return; }
		methods.show($this, iCateNo);

	}).mouseleave(function(e) {

		$(this).removeClass('on');
		methods.close();

	});*/

});
