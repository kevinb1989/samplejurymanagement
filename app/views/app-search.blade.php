@extends('layouts.juries-master')

@section('pagetitle')
   <TITLE>Retrieve an application info based on its link and id</TITLE>
@stop

@section('content')
      <section class="panel">
         <header class="panel-heading">Professional Portfolio</header>
         <div class="panel-body">
            {{ Form::open(array('role' => 'form', 'class' => 'form-horizontal', 'id' => 'search-app-frm')) }}
        <div class="form-group">
               {{ Form::label('type_of_app', 'Type of app: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }} 
            <div class="col-lg-10">
               {{ Form::select('type_of_app', array(
                  'iOS' => 'iOS',
                  'Android' => 'Android',
                  'windowsphone' => 'Windows Phone'
               ), 'iOS', array('id' => 'type_of_app', 'class' => 'form-control')) }}
            </div>
         </div>
         <div class="form-group">
               {{ Form::label('app_url', 'Application URL: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }} 
            <div class="col-lg-10">
               {{ Form::text('app_url', '',  array('id' => 'app_url', 'class' => 'form-control'))}}
            </div>
         </div>
         <div class="form-group">
            {{ Form::label('name', 'Name: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }}
            <div class="col-lg-10">
              {{ Form::text('name', '', array('id' => 'name', 'class' => 'form-control')) }}
            </div>
         </div>
         <div class="form-group">
            {{Form::label('video_url', 'Video URL (If any): ', array('class' => 'col-lg-2 col-sm-2 control-label'))}}
            <div class="col-lg-10">
                {{Form::text('video_url', '', array('id' => 'video_url', 'class' => 'form-control'))}}
            </div>
         </div>
         <div class="form-group">
            {{ Form::label('category', 'Category: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }}
            <div class="col-lg-10">
                {{ Form::text('category', '', array('id' => 'category', 'class' => 'form-control')) }}
            </div>
         </div>
         <div class="form-group">
            {{ Form::label('description', 'Description: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }}
            <div class="col-lg-10">
                {{Form::textarea('description', null, array('id' => 'description', 'class' => 'form-control'))}}
            </div>
         </div>
         <div class="form-group">
            {{ Form::label('cover_image', 'Cover image: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }}
            <div class="col-lg-10">
                {{ HTML::image('#', null, array('id' => 'app_image')) }}
            </div>
         </div>
         <div class="form-group">
            {{ Form::label('screenshots', 'Screenshots: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }}
            <div class="col-lg-10">
                <div id="screenshots">
                </div>
            </div>
         </div>

         <br>
         <div id="app-info"></div>
         <br>
      <p>
         {{ Form::submit('submit', array('class' => 'btn btn-sm btn-success')) }} {{ link_to_route('juries.index', 'Back', array(), array('class' => 'btn btn-sm btn-danger')) }}
      </p>
      {{ Form::close() }}
   </div>
   </section>
@stop



@section('customscript')
   <script type="text/javascript">

         $(document).ready(function(){
            $body = $("body");

            $(document).on({
              ajaxStart: function() { $body.addClass("loading"); },
              ajaxStop: function() { $body.removeClass("loading"); }    
            });

            $("#search-app-frm").validate({
               rules: {
                  app_url: {
                  required: true
                  }
               },
               messages: {
                     app_url: "<p><i>Please enter the app url</i></p>"
               }
            });

            $("#search-app-frm").bind("submit", function(){
                //extract the app link
                var app_link = $("#app_url").val();
                var type_of_app = $("#type_of_app").val();
                if(type_of_app == "iOS"){
                  obtainInfoFromItunesStore(app_link);
                }
                else if(type_of_app == "Android"){
                  obtainInfoFromGooglePlay(app_link);
                }else if(type_of_app == "windowsphone"){
                  obtainInfoFromWindowsPhoneStore(app_link);
                }
                
                return false;
            
            });

            //create a basic image slider to display screenshots
            function activateImageSlider(){
              $('#screenshots').bjqs({
                'height' : 1000,
                'width' : 500,
                'responsive' : true
              });
            }
            

            //this function is to obtain info from iTunes store
            function obtainInfoFromItunesStore(app_link){
                //get the index of 'id'
                var id_index = app_link.indexOf('id');
                //get the index of the question mark
                var question_mark_index = app_link.indexOf('?');
                //extract the app id from the app link using slice() function
                var app_id = app_link.slice(id_index + 2, question_mark_index);

                //load app info from iTunes store
                $.ajax({
                           type: "GET",
                           url: "https://itunes.apple.com/lookup",
                           dataType: "JSONP",
                           data: {
                            "id": app_id
                           },
                           success: function(data){
                                $("#name").val(data["results"][0].trackName);
                                $("#category").val(data["results"][0].primaryGenreName);
                                $("#description").html(data["results"][0].description);
                                $("#app_image").attr("src", data["results"][0].artworkUrl60);

                                //display screenshots
                                var numOfScreenshots = data["results"][0].screenshotUrls.length;
                                if(numOfScreenshots>0){
                                  var screenshots_content = "<ul class='bjqs'>";
                                  for(i=0; i < numOfScreenshots;i++){
                                    screenshots_content += "<li><img src='" + data["results"][0].screenshotUrls[i] + "' /></li>";
                                  }
                                  screenshots_content += "</ul>";
                                  $("#screenshots").empty();
                                  $("#screenshots").html(screenshots_content);
                                  activateImageSlider();
                                }else{
                                  $("#screenshots").empty();
                                }
                           }
                });
            }

            //this function is to obtain info from Google Play
            function obtainInfoFromGooglePlay(app_link){
                //extract the app_id from the android app link
                packageName = getUrlParameterFromAndroidAppLink(app_link);

                //load app info from iTunes store
                $.ajax({
                           type: "GET",
                           url: "search-android-app-info/" + packageName,
                           dataType: "JSON",
                           success: function(data){
                                $("#name").val(data.name);
                                $("#category").val(data.category);
                                $("#video_url").val(data.video);
                                $("#description").html(data.description);
                                $("#app_image").attr("src", data.cover_image);
                                
                                //display screenshots
                                var numOfScreenshots = data.screenshots.length;
                                if(numOfScreenshots>0){
                                  var screenshots_content = "<ul class='bjqs'>";
                                  for(i=0; i < numOfScreenshots;i++){
                                    screenshots_content += "<li><img src='" + data.screenshots[i] + "' /></li>";
                                  }
                                  screenshots_content += "</ul>";
                                  $("#screenshots").empty();
                                  $("#screenshots").html(screenshots_content);
                                  activateImageSlider();
                                }else{
                                  $("#screenshots").empty();
                                }
                           },
                           error: function(){
                                alert("Problem reading data from Google Play.");
                           }
                });
            }

            function getUrlParameterFromAndroidAppLink(app_link){
              //extract the part of parameters of the android app url
              var query_string = app_link.split("?");
              var idParam = query_string[1].split("&");
              var packageName = "";
              //extract the app id
              if(idParam.length > 0){
                var idArray = idParam[0].split("=");
              
                var packageName = idArray[1];  
              }
              

              return packageName;
            }    

            
         });

          //this function will obtain app info from windows phone store
          function obtainInfoFromWindowsPhoneStore(app_link){
            //extract the app id from the link
            var app_link_arr = app_link.split("/");

            if(app_link_arr.length > 0){
              var app_id = app_link_arr[app_link_arr.length - 1];  
            }else{
              return;
            }
            

            $.ajax({
              type: "GET",
              url: "search-windows-phone-app-info/" + app_id,
              dataType: "JSON",
              success: function(data) {

                $("#name").val(data.name[0]);
                $("#category").val(data.category[0]);
                $("#description").html(data.description[0]);
                $("#app_image").attr("src", data.cover_image);
                    
                //display screenshots
                var numOfScreenshots = data.screenshots.length;
                if(numOfScreenshots>0){
                  var screenshots_content = "<ul>";
                  for(i=0; i < numOfScreenshots;i++){
                    screenshots_content += "<li><img src='" + data.screenshots[i] + "' /></li>";
                  }
                  screenshots_content += "</ul>";
                  $("#screenshots").empty();
                  $("#screenshots").html(screenshots_content);
                  //activateImageSlider();
                }else{
                  $("#screenshots").empty();
                }
              },
              //other code
              error: function() {
                alert("The XML File could not be processed correctly.");
              }
            });
          }

            
      </script>
@stop