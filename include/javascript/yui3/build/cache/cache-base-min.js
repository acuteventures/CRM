/*
 Copyright (c) 2010, Yahoo! Inc. All rights reserved.
 Code licensed under the BSD License:
 http://developer.yahoo.com/yui/license.html
 version: 3.3.0
 build: 3167
 */
YUI.add("cache-base",function(D){var A=D.Lang,B=D.Lang.isDate,C=function(){C.superclass.constructor.apply(this,arguments);};D.mix(C,{NAME:"cache",ATTRS:{max:{value:0,setter:"_setMax"},size:{readOnly:true,getter:"_getSize"},uniqueKeys:{value:false},expires:{value:0,validator:function(E){return D.Lang.isDate(E)||(D.Lang.isNumber(E)&&E>=0);}},entries:{readOnly:true,getter:"_getEntries"}}});D.extend(C,D.Base,{_entries:null,initializer:function(E){this.publish("add",{defaultFn:this._defAddFn});this.publish("flush",{defaultFn:this._defFlushFn});this._entries=[];},destructor:function(){this._entries=[];},_setMax:function(F){var E=this._entries;if(F>0){if(E){while(E.length>F){E.shift();}}}else{F=0;this._entries=[];}return F;},_getSize:function(){return this._entries.length;},_getEntries:function(){return this._entries;},_defAddFn:function(H){var F=this._entries,E=this.get("max"),G=H.entry;if(this.get("uniqueKeys")&&(this.retrieve(H.entry.request))){F.shift();}while(E&&F.length>=E){F.shift();}F[F.length]=G;},_defFlushFn:function(E){this._entries=[];},_isMatch:function(F,E){if(!E.expires||new Date()<E.expires){return(F===E.request);}return false;},add:function(G,F){var E=this.get("expires");if(this.get("initialized")&&((this.get("max")===null)||this.get("max")>0)&&(A.isValue(G)||A.isNull(G)||A.isUndefined(G))){this.fire("add",{entry:{request:G,response:F,cached:new Date(),expires:B(E)?E:(E?new Date(new Date().getTime()+this.get("expires")):null)}});}else{}},flush:function(){this.fire("flush");},retrieve:function(I){var E=this._entries,H=E.length,G=null,F=H-1;if((H>0)&&((this.get("max")===null)||(this.get("max")>0))){this.fire("request",{request:I});for(;F>=0;F--){G=E[F];if(this._isMatch(I,G)){this.fire("retrieve",{entry:G});if(F<H-1){E.splice(F,1);E[E.length]=G;}return G;}}}return null;}});D.Cache=C;},"3.3.0",{requires:["base"]});
