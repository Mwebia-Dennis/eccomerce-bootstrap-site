var nav_btns = document.getElementsByClassName('nav_btn');

      //opening product details onload;
      window.onload = function() {

        getAndDisplayContent(nav_btns[0].value);
      }

      for (var i = 0; i < nav_btns.length; i++) {
      
        nav_btns[i].addEventListener('click', function() {

          toggleActiveClass(this);
          getAndDisplayContent(this.value);
        });
      }

      function toggleActiveClass(context) {
        
        //will be used to toggle active class between the buttons;
        var current = document.getElementsByClassName(' nav_btn_active');

        if (current.length > 0) {

          current[0].className = current[0].className.replace(" nav_btn_active","");
        }

        context.className += " nav_btn_active";
      }

      //function to get data from db via ajax;
      function getAndDisplayContent(str) {
        
        var content = document.getElementById('content');
        var item_id = document.getElementById('item_id');

        if (str == '') {

          content.innerHTML = "";
          return;

        } else{

          //checking browser compatibility;
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();

          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

          xmlhttp.onreadystatechange = function() {

              if (this.readyState == 4 && this.status == 200) {

                  content.innerHTML = this.responseText;

              }
          };


           xmlhttp.open("GET","displaydata.php?action=load_content&content_type=" + str + "&item="+item_id.value,true);

           xmlhttp.send();
          }
      }