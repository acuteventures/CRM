/*
 Copyright (c) 2010, Yahoo! Inc. All rights reserved.
 Code licensed under the BSD License:
 http://developer.yahoo.com/yui/license.html
 version: 3.3.0
 build: 3167
 */
YUI.add('widget-parent',function(Y){var Lang=Y.Lang;function Parent(config){this.publish("addChild",{defaultTargetOnly:true,defaultFn:this._defAddChildFn});this.publish("removeChild",{defaultTargetOnly:true,defaultFn:this._defRemoveChildFn});this._items=[];var children,handle;if(config&&config.children){children=config.children;handle=this.after("initializedChange",function(e){this._add(children);handle.detach();});}
Y.after(this._renderChildren,this,"renderUI");Y.after(this._bindUIParent,this,"bindUI");Y.before(this._destroyChildren,this,"destructor");this.after("selectionChange",this._afterSelectionChange);this.after("selectedChange",this._afterParentSelectedChange);this.after("activeDescendantChange",this._afterActiveDescendantChange);this._hDestroyChild=this.after("*:destroy",this._afterDestroyChild);this.after("*:focusedChange",this._updateActiveDescendant);}
Parent.ATTRS={defaultChildType:{setter:function(val){var returnVal=Y.Attribute.INVALID_VALUE,FnConstructor=Lang.isString(val)?Y[val]:val;if(Lang.isFunction(FnConstructor)){returnVal=FnConstructor;}
return returnVal;}},activeDescendant:{readOnly:true},multiple:{value:false,validator:Lang.isBoolean,writeOnce:true,getter:function(value){var root=this.get("root");return(root&&root!=this)?root.get("multiple"):value;}},selection:{readOnly:true,setter:"_setSelection",getter:function(value){var selection=Lang.isArray(value)?(new Y.ArrayList(value)):value;return selection;}},selected:{setter:function(value){var returnVal=value;if(value===1&&!this.get("multiple")){returnVal=Y.Attribute.INVALID_VALUE;}
return returnVal;}}};Parent.prototype={_afterDestroyChild:function(event){var child=event.target;if(child.get("parent")==this){child.remove();}},_afterSelectionChange:function(event){if(event.target==this&&event.src!=this){var selection=event.newVal,selectedVal=0;if(selection){selectedVal=2;if(Y.instanceOf(selection,Y.ArrayList)&&(selection.size()===this.size())){selectedVal=1;}}
this.set("selected",selectedVal,{src:this});}},_afterActiveDescendantChange:function(event){var parent=this.get("parent");if(parent){parent._set("activeDescendant",event.newVal);}},_afterParentSelectedChange:function(event){var value=event.newVal;if(this==event.target&&event.src!=this&&(value===0||value===1)){this.each(function(child){child.set("selected",value,{src:this});},this);}},_setSelection:function(child){var selection=null,selected;if(this.get("multiple")&&!this.isEmpty()){selected=[];this.each(function(v){if(v.get("selected")>0){selected.push(v);}});if(selected.length>0){selection=selected;}}
else{if(child.get("selected")>0){selection=child;}}
return selection;},_updateSelection:function(event){var child=event.target,selection;if(child.get("parent")==this){if(event.src!="_updateSelection"){selection=this.get("selection");if(!this.get("multiple")&&selection&&event.newVal>0){selection.set("selected",0,{src:"_updateSelection"});}
this._set("selection",child);}
if(event.src==this){this._set("selection",child,{src:this});}}},_updateActiveDescendant:function(event){var activeDescendant=(event.newVal===true)?event.target:null;this._set("activeDescendant",activeDescendant);},_createChild:function(config){var defaultType=this.get("defaultChildType"),altType=config.childType||config.type,child,Fn,FnConstructor;if(altType){Fn=Lang.isString(altType)?Y[altType]:altType;}
if(Lang.isFunction(Fn)){FnConstructor=Fn;}else if(defaultType){FnConstructor=defaultType;}
if(FnConstructor){child=new FnConstructor(config);}else{Y.error("Could not create a child instance because its constructor is either undefined or invalid.");}
return child;},_defAddChildFn:function(event){var child=event.child,index=event.index,children=this._items;if(child.get("parent")){child.remove();}
if(Lang.isNumber(index)){children.splice(index,0,child);}
else{children.push(child);}
child._set("parent",this);child.addTarget(this);event.index=child.get("index");child.after("selectedChange",Y.bind(this._updateSelection,this));},_defRemoveChildFn:function(event){var child=event.child,index=event.index,children=this._items;if(child.get("focused")){child.set("focused",false);}
if(child.get("selected")){child.set("selected",0);}
children.splice(index,1);child.removeTarget(this);child._oldParent=child.get("parent");child._set("parent",null);},_add:function(child,index){var children,oChild,returnVal;if(Lang.isArray(child)){children=[];Y.each(child,function(v,k){oChild=this._add(v,(index+k));if(oChild){children.push(oChild);}},this);if(children.length>0){returnVal=children;}}
else{if(Y.instanceOf(child,Y.Widget)){oChild=child;}
else{oChild=this._createChild(child);}
if(oChild&&this.fire("addChild",{child:oChild,index:index})){returnVal=oChild;}}
return returnVal;},add:function(){var added=this._add.apply(this,arguments),children=added?(Lang.isArray(added)?added:[added]):[];return(new Y.ArrayList(children));},remove:function(index){var child=this._items[index],returnVal;if(child&&this.fire("removeChild",{child:child,index:index})){returnVal=child;}
return returnVal;},removeAll:function(){var removed=[],child;Y.each(this._items.concat(),function(){child=this.remove(0);if(child){removed.push(child);}},this);return(new Y.ArrayList(removed));},selectChild:function(i){this.item(i).set('selected',1);},selectAll:function(){this.set("selected",1);},deselectAll:function(){this.set("selected",0);},_uiAddChild:function(child,parentNode){child.render(parentNode);var childBB=child.get("boundingBox"),siblingBB,nextSibling=child.next(false),prevSibling;if(nextSibling){siblingBB=nextSibling.get("boundingBox");siblingBB.insert(childBB,"before");}else{prevSibling=child.previous(false);if(prevSibling){siblingBB=prevSibling.get("boundingBox");siblingBB.insert(childBB,"after");}}},_uiRemoveChild:function(child){child.get("boundingBox").remove();},_afterAddChild:function(event){var child=event.child;if(child.get("parent")==this){this._uiAddChild(child,this._childrenContainer);}},_afterRemoveChild:function(event){var child=event.child;if(child._oldParent==this){this._uiRemoveChild(child);}},_bindUIParent:function(){this.after("addChild",this._afterAddChild);this.after("removeChild",this._afterRemoveChild);},_renderChildren:function(){var renderTo=this._childrenContainer||this.get("contentBox");this._childrenContainer=renderTo;this.each(function(child){child.render(renderTo);});},_destroyChildren:function(){this._hDestroyChild.detach();this.each(function(child){child.destroy();});}};Y.augment(Parent,Y.ArrayList);Y.WidgetParent=Parent;},'3.3.0',{requires:['base-build','arraylist','widget']});
