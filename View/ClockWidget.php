<div>
    <!-- clock widget start - Try get a larger size -->
    <script type="text/javascript">
        var css_file = document.createElement("link");
        css_file.setAttribute("rel", "stylesheet");
        css_file.setAttribute("type", "text/css");
        css_file.setAttribute("href", "https://s.bookcdn.com//css/cl/bw-cl-180x170r1.css?v=0.0.1");
        document.getElementsByTagName("head")[0].appendChild(css_file);
    </script>

    <div id="tw_11_1869606448">
        <div style="width:200px; height:250px; margin: 0 auto;">
            <a href="https://booked.net/time/colombo-19459">Colombo</a>
            <br />
        </div>
    </div>

    <script type="text/javascript">
        function setWidgetData_1869606448(data) {
            if (typeof(data) != 'undefined' && data.results.length > 0) {
                for (var i = 0; i < data.results.length; ++i) {
                    var objMainBlock = '';
                    var params = data.results[i];
                    objMainBlock = document.getElementById('tw_' + params.widget_type + '_' + params.widget_id);
                    if (objMainBlock !== null) objMainBlock.innerHTML = params.html_code;
                }
            }
        }
        var clock_timer_1869606448 = -1;
        widgetSrc = "https://widgets.booked.net/time/info?ver=2;domid=209;type=11;id=1869606448;scode=124;city_id=19459;wlangid=1;mode=2;details=0;background=ffffff;border_color=ffffff;color=363636;add_background=ffffff;add_color=333333;head_color=ffffff;border=0;transparent=0";
        var widgetUrl = location.href;
        widgetSrc += '&ref=' + widgetUrl;
        var wstrackId = "";
        if (wstrackId) {
            widgetSrc += ';wstrackId=' + wstrackId + ';'
        }
        var timeBookedScript = document.createElement("script");
        timeBookedScript.setAttribute("type", "text/javascript");
        timeBookedScript.src = widgetSrc;
        document.body.appendChild(timeBookedScript);
    </script>
    <!-- clock widget end -->
</div>