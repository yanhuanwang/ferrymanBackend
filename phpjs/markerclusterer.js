/**
 * @license
 * Copyright 2010 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
function MarkerClusterer(e,t,r){this.extend(MarkerClusterer,google.maps.OverlayView);this.map_=e;this.markers_=[];this.clusters_=[];this.sizes=[53,56,66,78,90];this.styles_=[];this.ready_=false;var s=r||{};this.gridSize_=s["gridSize"]||60;this.minClusterSize_=s["minimumClusterSize"]||2;this.maxZoom_=s["maxZoom"]||null;this.styles_=s["styles"]||[];this.imagePath_=s["imagePath"]||this.MARKER_CLUSTER_IMAGE_PATH_;this.imageExtension_=s["imageExtension"]||this.MARKER_CLUSTER_IMAGE_EXTENSION_;this.zoomOnClick_=true;if(s["zoomOnClick"]!=undefined){this.zoomOnClick_=s["zoomOnClick"]}this.averageCenter_=false;if(s["averageCenter"]!=undefined){this.averageCenter_=s["averageCenter"]}this.setupStyles_();this.setMap(e);this.prevZoom_=this.map_.getZoom();var i=this;google.maps.event.addListener(this.map_,"zoom_changed",function(){var e=i.map_.getZoom();if(i.prevZoom_!=e){i.prevZoom_=e;i.resetViewport()}});google.maps.event.addListener(this.map_,"idle",function(){i.redraw()});if(t&&t.length){this.addMarkers(t,false)}}MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_PATH_="../images/m";MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_EXTENSION_="png";MarkerClusterer.prototype.extend=function(e,t){return function(e){for(var t in e.prototype){this.prototype[t]=e.prototype[t]}return this}.apply(e,[t])};MarkerClusterer.prototype.onAdd=function(){this.setReady_(true)};MarkerClusterer.prototype.draw=function(){};MarkerClusterer.prototype.setupStyles_=function(){if(this.styles_.length){return}for(var e=0,t;t=this.sizes[e];e++){this.styles_.push({url:this.imagePath_+(e+1)+"."+this.imageExtension_,height:t,width:t})}};MarkerClusterer.prototype.fitMapToMarkers=function(){var e=this.getMarkers();var t=new google.maps.LatLngBounds;for(var r=0,s;s=e[r];r++){t.extend(s.getPosition())}this.map_.fitBounds(t)};MarkerClusterer.prototype.setStyles=function(e){this.styles_=e};MarkerClusterer.prototype.getStyles=function(){return this.styles_};MarkerClusterer.prototype.isZoomOnClick=function(){return this.zoomOnClick_};MarkerClusterer.prototype.isAverageCenter=function(){return this.averageCenter_};MarkerClusterer.prototype.getMarkers=function(){return this.markers_};MarkerClusterer.prototype.getTotalMarkers=function(){return this.markers_.length};MarkerClusterer.prototype.setMaxZoom=function(e){this.maxZoom_=e};MarkerClusterer.prototype.getMaxZoom=function(){return this.maxZoom_};MarkerClusterer.prototype.calculator_=function(e,t){var r=0;var s=e.length;var i=s;while(i!==0){i=parseInt(i/10,10);r++}r=Math.min(r,t);return{text:s,index:r}};MarkerClusterer.prototype.setCalculator=function(e){this.calculator_=e};MarkerClusterer.prototype.getCalculator=function(){return this.calculator_};MarkerClusterer.prototype.addMarkers=function(e,t){for(var r=0,s;s=e[r];r++){this.pushMarkerTo_(s)}if(!t){this.redraw()}};MarkerClusterer.prototype.pushMarkerTo_=function(e){e.isAdded=false;if(e["draggable"]){var t=this;google.maps.event.addListener(e,"dragend",function(){e.isAdded=false;t.repaint()})}this.markers_.push(e)};MarkerClusterer.prototype.addMarker=function(e,t){this.pushMarkerTo_(e);if(!t){this.redraw()}};MarkerClusterer.prototype.removeMarker_=function(e){var t=-1;if(this.markers_.indexOf){t=this.markers_.indexOf(e)}else{for(var r=0,s;s=this.markers_[r];r++){if(s==e){t=r;break}}}if(t==-1){return false}e.setMap(null);this.markers_.splice(t,1);return true};MarkerClusterer.prototype.removeMarker=function(e,t){var r=this.removeMarker_(e);if(!t&&r){this.resetViewport();this.redraw();return true}else{return false}};MarkerClusterer.prototype.removeMarkers=function(e,t){var r=false;for(var s=0,i;i=e[s];s++){var o=this.removeMarker_(i);r=r||o}if(!t&&r){this.resetViewport();this.redraw();return true}};MarkerClusterer.prototype.setReady_=function(e){if(!this.ready_){this.ready_=e;this.createClusters_()}};MarkerClusterer.prototype.getTotalClusters=function(){return this.clusters_.length};MarkerClusterer.prototype.getMap=function(){return this.map_};MarkerClusterer.prototype.setMap=function(e){this.map_=e};MarkerClusterer.prototype.getGridSize=function(){return this.gridSize_};MarkerClusterer.prototype.setGridSize=function(e){this.gridSize_=e};MarkerClusterer.prototype.getMinClusterSize=function(){return this.minClusterSize_};MarkerClusterer.prototype.setMinClusterSize=function(e){this.minClusterSize_=e};MarkerClusterer.prototype.getExtendedBounds=function(e){var t=this.getProjection();var r=new google.maps.LatLng(e.getNorthEast().lat(),e.getNorthEast().lng());var s=new google.maps.LatLng(e.getSouthWest().lat(),e.getSouthWest().lng());var i=t.fromLatLngToDivPixel(r);i.x+=this.gridSize_;i.y-=this.gridSize_;var o=t.fromLatLngToDivPixel(s);o.x-=this.gridSize_;o.y+=this.gridSize_;var a=t.fromDivPixelToLatLng(i);var n=t.fromDivPixelToLatLng(o);e.extend(a);e.extend(n);return e};MarkerClusterer.prototype.isMarkerInBounds_=function(e,t){return t.contains(e.getPosition())};MarkerClusterer.prototype.clearMarkers=function(){this.resetViewport(true);this.markers_=[]};MarkerClusterer.prototype.resetViewport=function(e){for(var t=0,r;r=this.clusters_[t];t++){r.remove()}for(var t=0,s;s=this.markers_[t];t++){s.isAdded=false;if(e){s.setMap(null)}}this.clusters_=[]};MarkerClusterer.prototype.repaint=function(){var e=this.clusters_.slice();this.clusters_.length=0;this.resetViewport();this.redraw();window.setTimeout(function(){for(var t=0,r;r=e[t];t++){r.remove()}},0)};MarkerClusterer.prototype.redraw=function(){this.createClusters_()};MarkerClusterer.prototype.distanceBetweenPoints_=function(e,t){if(!e||!t){return 0}var r=6371;var s=(t.lat()-e.lat())*Math.PI/180;var i=(t.lng()-e.lng())*Math.PI/180;var o=Math.sin(s/2)*Math.sin(s/2)+Math.cos(e.lat()*Math.PI/180)*Math.cos(t.lat()*Math.PI/180)*Math.sin(i/2)*Math.sin(i/2);var a=2*Math.atan2(Math.sqrt(o),Math.sqrt(1-o));var n=r*a;return n};MarkerClusterer.prototype.addToClosestCluster_=function(e){var t=4e4;var r=null;var s=e.getPosition();for(var i=0,o;o=this.clusters_[i];i++){var a=o.getCenter();if(a){var n=this.distanceBetweenPoints_(a,e.getPosition());if(n<t){t=n;r=o}}}if(r&&r.isMarkerInClusterBounds(e)){r.addMarker(e)}else{var o=new Cluster(this);o.addMarker(e);this.clusters_.push(o)}};MarkerClusterer.prototype.createClusters_=function(){if(!this.ready_){return}var e=new google.maps.LatLngBounds(this.map_.getBounds().getSouthWest(),this.map_.getBounds().getNorthEast());var t=this.getExtendedBounds(e);for(var r=0,s;s=this.markers_[r];r++){if(!s.isAdded&&this.isMarkerInBounds_(s,t)){this.addToClosestCluster_(s)}}};function Cluster(e){this.markerClusterer_=e;this.map_=e.getMap();this.gridSize_=e.getGridSize();this.minClusterSize_=e.getMinClusterSize();this.averageCenter_=e.isAverageCenter();this.center_=null;this.markers_=[];this.bounds_=null;this.clusterIcon_=new ClusterIcon(this,e.getStyles(),e.getGridSize())}Cluster.prototype.isMarkerAlreadyAdded=function(e){if(this.markers_.indexOf){return this.markers_.indexOf(e)!=-1}else{for(var t=0,r;r=this.markers_[t];t++){if(r==e){return true}}}return false};Cluster.prototype.addMarker=function(e){if(this.isMarkerAlreadyAdded(e)){return false}if(!this.center_){this.center_=e.getPosition();this.calculateBounds_()}else{if(this.averageCenter_){var t=this.markers_.length+1;var r=(this.center_.lat()*(t-1)+e.getPosition().lat())/t;var s=(this.center_.lng()*(t-1)+e.getPosition().lng())/t;this.center_=new google.maps.LatLng(r,s);this.calculateBounds_()}}e.isAdded=true;this.markers_.push(e);var i=this.markers_.length;if(i<this.minClusterSize_&&e.getMap()!=this.map_){e.setMap(this.map_)}if(i==this.minClusterSize_){for(var o=0;o<i;o++){this.markers_[o].setMap(null)}}if(i>=this.minClusterSize_){e.setMap(null)}this.updateIcon();return true};Cluster.prototype.getMarkerClusterer=function(){return this.markerClusterer_};Cluster.prototype.getBounds=function(){var e=new google.maps.LatLngBounds(this.center_,this.center_);var t=this.getMarkers();for(var r=0,s;s=t[r];r++){e.extend(s.getPosition())}return e};Cluster.prototype.remove=function(){this.clusterIcon_.remove();this.markers_.length=0;delete this.markers_};Cluster.prototype.getSize=function(){return this.markers_.length};Cluster.prototype.getMarkers=function(){return this.markers_};Cluster.prototype.getCenter=function(){return this.center_};Cluster.prototype.calculateBounds_=function(){var e=new google.maps.LatLngBounds(this.center_,this.center_);this.bounds_=this.markerClusterer_.getExtendedBounds(e)};Cluster.prototype.isMarkerInClusterBounds=function(e){return this.bounds_.contains(e.getPosition())};Cluster.prototype.getMap=function(){return this.map_};Cluster.prototype.updateIcon=function(){var e=this.map_.getZoom();var t=this.markerClusterer_.getMaxZoom();if(t&&e>t){for(var r=0,s;s=this.markers_[r];r++){s.setMap(this.map_)}return}if(this.markers_.length<this.minClusterSize_){this.clusterIcon_.hide();return}var i=this.markerClusterer_.getStyles().length;var o=this.markerClusterer_.getCalculator()(this.markers_,i);this.clusterIcon_.setCenter(this.center_);this.clusterIcon_.setSums(o);this.clusterIcon_.show()};function ClusterIcon(e,t,r){e.getMarkerClusterer().extend(ClusterIcon,google.maps.OverlayView);this.styles_=t;this.padding_=r||0;this.cluster_=e;this.center_=null;this.map_=e.getMap();this.div_=null;this.sums_=null;this.visible_=false;this.setMap(this.map_)}ClusterIcon.prototype.triggerClusterClick=function(e){var t=this.cluster_.getMarkerClusterer();google.maps.event.trigger(t,"clusterclick",this.cluster_,e);if(t.isZoomOnClick()){this.map_.fitBounds(this.cluster_.getBounds())}};ClusterIcon.prototype.onAdd=function(){this.div_=document.createElement("DIV");if(this.visible_){var e=this.getPosFromLatLng_(this.center_);this.div_.style.cssText=this.createCss(e);this.div_.innerHTML=this.sums_.text}var t=this.getPanes();t.overlayMouseTarget.appendChild(this.div_);var r=this;var s=false;google.maps.event.addDomListener(this.div_,"click",function(e){if(!s){r.triggerClusterClick(e)}});google.maps.event.addDomListener(this.div_,"mousedown",function(){s=false});google.maps.event.addDomListener(this.div_,"mousemove",function(){s=true})};ClusterIcon.prototype.getPosFromLatLng_=function(e){var t=this.getProjection().fromLatLngToDivPixel(e);if(typeof this.iconAnchor_==="object"&&this.iconAnchor_.length===2){t.x-=this.iconAnchor_[0];t.y-=this.iconAnchor_[1]}else{t.x-=parseInt(this.width_/2,10);t.y-=parseInt(this.height_/2,10)}return t};ClusterIcon.prototype.draw=function(){if(this.visible_){var e=this.getPosFromLatLng_(this.center_);this.div_.style.top=e.y+"px";this.div_.style.left=e.x+"px"}};ClusterIcon.prototype.hide=function(){if(this.div_){this.div_.style.display="none"}this.visible_=false};ClusterIcon.prototype.show=function(){if(this.div_){var e=this.getPosFromLatLng_(this.center_);this.div_.style.cssText=this.createCss(e);this.div_.style.display=""}this.visible_=true};ClusterIcon.prototype.remove=function(){this.setMap(null)};ClusterIcon.prototype.onRemove=function(){if(this.div_&&this.div_.parentNode){this.hide();this.div_.parentNode.removeChild(this.div_);this.div_=null}};ClusterIcon.prototype.setSums=function(e){this.sums_=e;this.text_=e.text;this.index_=e.index;if(this.div_){this.div_.innerHTML=e.text}this.useStyle()};ClusterIcon.prototype.useStyle=function(){var e=Math.max(0,this.sums_.index-1);e=Math.min(this.styles_.length-1,e);var t=this.styles_[e];this.url_=t["url"];this.height_=t["height"];this.width_=t["width"];this.textColor_=t["textColor"];this.anchor_=t["anchor"];this.textSize_=t["textSize"];this.backgroundPosition_=t["backgroundPosition"];this.iconAnchor_=t["iconAnchor"]};ClusterIcon.prototype.setCenter=function(e){this.center_=e};ClusterIcon.prototype.createCss=function(e){var t=[];t.push("background-image:url("+this.url_+");");var r=this.backgroundPosition_?this.backgroundPosition_:"0 0";t.push("background-position:"+r+";");if(typeof this.anchor_==="object"){if(typeof this.anchor_[0]==="number"&&this.anchor_[0]>0&&this.anchor_[0]<this.height_){t.push("height:"+(this.height_-this.anchor_[0])+"px; padding-top:"+this.anchor_[0]+"px;")}else if(typeof this.anchor_[0]==="number"&&this.anchor_[0]<0&&-this.anchor_[0]<this.height_){t.push("height:"+this.height_+"px; line-height:"+(this.height_+this.anchor_[0])+"px;")}else{t.push("height:"+this.height_+"px; line-height:"+this.height_+"px;")}if(typeof this.anchor_[1]==="number"&&this.anchor_[1]>0&&this.anchor_[1]<this.width_){t.push("width:"+(this.width_-this.anchor_[1])+"px; padding-left:"+this.anchor_[1]+"px;")}else{t.push("width:"+this.width_+"px; text-align:center;")}}else{t.push("height:"+this.height_+"px; line-height:"+this.height_+"px; width:"+this.width_+"px; text-align:center;")}var s=this.textColor_?this.textColor_:"black";var i=this.textSize_?this.textSize_:11;t.push("cursor:pointer; top:"+e.y+"px; left:"+e.x+"px; color:"+s+"; position:absolute; font-size:"+i+"px; font-family:Arial,sans-serif; font-weight:bold");return t.join("")};window["MarkerClusterer"]=MarkerClusterer;MarkerClusterer.prototype["addMarker"]=MarkerClusterer.prototype.addMarker;MarkerClusterer.prototype["addMarkers"]=MarkerClusterer.prototype.addMarkers;MarkerClusterer.prototype["clearMarkers"]=MarkerClusterer.prototype.clearMarkers;MarkerClusterer.prototype["fitMapToMarkers"]=MarkerClusterer.prototype.fitMapToMarkers;MarkerClusterer.prototype["getCalculator"]=MarkerClusterer.prototype.getCalculator;MarkerClusterer.prototype["getGridSize"]=MarkerClusterer.prototype.getGridSize;MarkerClusterer.prototype["getExtendedBounds"]=MarkerClusterer.prototype.getExtendedBounds;MarkerClusterer.prototype["getMap"]=MarkerClusterer.prototype.getMap;MarkerClusterer.prototype["getMarkers"]=MarkerClusterer.prototype.getMarkers;MarkerClusterer.prototype["getMaxZoom"]=MarkerClusterer.prototype.getMaxZoom;MarkerClusterer.prototype["getStyles"]=MarkerClusterer.prototype.getStyles;MarkerClusterer.prototype["getTotalClusters"]=MarkerClusterer.prototype.getTotalClusters;MarkerClusterer.prototype["getTotalMarkers"]=MarkerClusterer.prototype.getTotalMarkers;MarkerClusterer.prototype["redraw"]=MarkerClusterer.prototype.redraw;MarkerClusterer.prototype["removeMarker"]=MarkerClusterer.prototype.removeMarker;MarkerClusterer.prototype["removeMarkers"]=MarkerClusterer.prototype.removeMarkers;MarkerClusterer.prototype["resetViewport"]=MarkerClusterer.prototype.resetViewport;MarkerClusterer.prototype["repaint"]=MarkerClusterer.prototype.repaint;MarkerClusterer.prototype["setCalculator"]=MarkerClusterer.prototype.setCalculator;MarkerClusterer.prototype["setGridSize"]=MarkerClusterer.prototype.setGridSize;MarkerClusterer.prototype["setMaxZoom"]=MarkerClusterer.prototype.setMaxZoom;MarkerClusterer.prototype["onAdd"]=MarkerClusterer.prototype.onAdd;MarkerClusterer.prototype["draw"]=MarkerClusterer.prototype.draw;Cluster.prototype["getCenter"]=Cluster.prototype.getCenter;Cluster.prototype["getSize"]=Cluster.prototype.getSize;Cluster.prototype["getMarkers"]=Cluster.prototype.getMarkers;ClusterIcon.prototype["onAdd"]=ClusterIcon.prototype.onAdd;ClusterIcon.prototype["draw"]=ClusterIcon.prototype.draw;ClusterIcon.prototype["onRemove"]=ClusterIcon.prototype.onRemove;