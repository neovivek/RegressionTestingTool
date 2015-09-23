$(document).ready(function(){
    $.ajaxSetup({ cache: false });
    $('.modal-body').on('click', '.genrep', function(){	c=$(this).attr('id'); $('.formclose').click(); $('.main-inner').html(''); $.ajax({url:'/content.php?file='+c, success: function(data){ $('.main-inner').html(data); $('.nav-sidebar li').removeClass('active'); $('#analytic').addClass('active');}});});
    $('#overview').click(function(){window.location= '/';});
    $('.main-inner').on('click', '.genreport', function(){d=$(this).attr('id'); $('.main-inner').html(''); $.ajax({url:'/pregenerate.php?file='+d, success: function(data){ $('.main-inner').html(data); if(data.search('Generate') != -1) generatereport(d); $('.nav-sidebar li').removeClass('active'); $('#analytic').addClass('active');}});});
    $('.main-inner').on('click', '.next', function(){d=$(this).attr('data-file'); $('.main-inner').html(''); $.ajax({url:'/tablecreator.php?file='+d, success:function(data){ $('.main-inner').html(data); if(data.search('Generate') != -1) generatereport(d); $('.nav-sidebar li').removeClass('active'); $('#tables').addClass('active');}});});
});
function get(name){	if(name.indexOf('_') !== -1 || name.indexOf(' ') !== -1 || name.length==0){$('.main-inner').find('.alert').remove(); $('.main-inner').prepend("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Wait!</strong> you can not have underscore( _ ) or spaces in your Name or Project Name.</div>"); $('#username').val(''); return;}	$.ajax({url:'/retrieve.php?user='+name , success: function(data){$('.main-inner').html(data);	if($('.collapse').length == 0){	$('.navbar .container-fluid').append("<div class='navbar-collapse collapse'><ul class='nav navbar-nav navbar-right right-margin'><li><a href='/error.php'>Logout</a></li></ul></div>");	}}});}
function reportactive(){$.ajax({url:'/retrieve1.php', success: function(data){$('#formreport').find('.modal-body').html(data);}});}
function generatereport(file){
	$('.main-inner').prepend("<div id='slider'></div>")
	var links = JSON.parse($.ajax({ url: '/generate.php?file='+file, dataType: "json", async: false }).responseText);
	var nodes = {};

	// Compute the distinct nodes from the links.
	links.forEach(function(link) {
	  link.source = nodes[link.source] || (nodes[link.source] = {name: link.source});
	  link.target = nodes[link.target] || (nodes[link.target] = {name: link.target});
	});

	var width = 960,
	    height = 580;

	var force = d3.layout.force()
	    .nodes(d3.values(nodes))
	    .links(links)
	    .size([width, height])
	    .linkDistance(100)
	    .linkStrength(0.5)
	    .charge(-2000)
	    .chargeDistance(200)
	    .on("tick", tick)
	    .start();

	var svg = d3.select(".graph").append("svg")
	    .attr("width", width)
	    .attr("height", height);

	// Per-type markers, as they don't inherit styles.
	svg.append("defs").selectAll("marker")
	    .data(["suit", "licensing", "resolved"])
	  .enter().append("marker")
	    .attr("id", function(d) { return d; })
	    .attr("viewBox", "0 -5 10 10")
	    .attr("refX", 15)
	    .attr("refY", -1.5)
	    .attr("markerWidth", 6)
	    .attr("markerHeight", 6)
	    .attr("orient", "auto")
	  .append("path")
	    .attr("d", "M0,-5L10,0L0,5");

	var path = svg.append("g").selectAll("path")
	    .data(force.links())
	  .enter().append("path")
	    .attr("class", function(d) { return "link " + d.type; })
	    .attr("marker-end", function(d) { return "url(#" + d.type + ")"; });

	var circle = svg.append("g").selectAll("circle")
	    .data(force.nodes())
	  .enter().append("circle")
	    .attr("r", 7)
	    .call(force.drag)
	    .attr("class", function(d) { if(d.index&1) return "target"; return "source";})
	    .on("mouseover", fade(0.1, "red", '0.2px'))
	    .on("mouseout", fade(1, "green", '1.4px'));

	var text = svg.append("svg:g").selectAll("g")
	    .data(force.nodes())
	  .enter().append("svg:g");

	// A copy of the text with a thick white stroke for legibility.
	text.append("svg:text")
	    .attr("x", 12)
	    .attr("y", ".31em")
	    .attr("class", "shadow")
	    .text(function(d) { return d.name; });

	text.append("svg:text")
	    .attr("x", 12)
	    .attr("y", ".31em")
	    .text(function(d) { return d.name; });

	var linkedByIndex = {};
	links.forEach(function(d) {
	    linkedByIndex[d.source.index + "," + d.target.index] = 1;
	});

	function isConnected(a, b) {
	  return linkedByIndex[a.index + "," + b.index] || linkedByIndex[b.index + "," + a.index] || a.index == b.index;
	}

	function fade(opacity,color,width) {
	  return function(d) {
	    var connected = [d];
	    circle.style("stroke-opacity", function(o) {
	      thisOpacity = opacity;
	      connected.forEach(function(e) { 
	          if(isConnected(e, o)) { thisOpacity = 1; }
	      });
	      this.setAttribute('fill-opacity', thisOpacity);
	      return thisOpacity;
	    });
	    text.style("opacity", function(o) {
	      thisOpacity = opacity;
	      connected.forEach(function(e) { 
	          if(isConnected(e, o)) { thisOpacity = 1; }
	      });
	      return thisOpacity;
	    });
	    path.style("stroke", function(o) {
	      thisColor = "green";
	      connected.forEach(function(e) {
	        if(o.source === e || o.target === e) {
	          thisColor = color;
	        }
	      });
	      return thisColor;
	    })
	    .style("stroke-width", function(o) {
	      thisWidth = width;
	      connected.forEach(function(e) {
	        if(o.source === e || o.target === e) {
	          thisWidth = '1.4px';
	        }
	      });
	      return thisWidth;
	    });
	  };
	}

	// Use elliptical arc path segments to doubly-encode directionality.
	function tick() {
	  path.attr("d", linkArc);
	  circle.attr("transform", transform);
	  text.attr("transform", transform);
	}

	function linkArc(d) {
	  var dx = d.target.x - d.source.x,
	      dy = d.target.y - d.source.y,
	      dr = Math.sqrt(dx * dx + dy * dy);
	  return "M" + d.source.x + "," + d.source.y + "A" + dr + "," + dr + " 0 0,1 " + d.target.x + "," + d.target.y;
	}

	function transform(d) {
	  return "translate(" + d.x + "," + d.y + ")";
	}
	$("#slider").slider({ min: 5, max: 20, value: 7, slide: function( event, ui ) { svg.transition().duration(500).selectAll("circle").attr("r", ui.value); svg.transition().duration(500).selectAll("marker").attr("markerWidth", ui.value-2).attr("markerHeight", ui.value-2);}});
}
function fill(){
	var d = document.getElementsByClassName('testcaseinput');
	var max = 0;
	var cases = [];
	for(var i=0; i<d.length; i++){
		elements = d[i].value.split(',');
		for(var j=0; j<elements.length; j++){
			cases[elements[j].trim()] = 0;
			if(max < elements[j].trim()) max = elements[j].trim();
		}
	}
	for(i=0; i<d.length; i++){
		elements = d[i].value.split(',');
		weight = $(d[i]).attr('data-weight');
		for(var j=0; j< elements.length; j++){
			cases[elements[j].trim()] = parseFloat(cases[elements[j].trim()]) + parseFloat(weight);
		}
	}
	var testcase = [];
	var flag = [];
	for(i=0; i< cases.length; i++){
		flag[i] = 0;
		testcase[i] = cases[i];
	}
	cases.sort(function(a,b) { return a - b;});
	cases.reverse();
	var html = "<table class='table table-bordered table-striped table-hover'><thead><tr><th>Test Cases</th><th>Total Weight</th></tr></thead><tbody>";
	for(var i=0; i<cases.length; i++)
		if(cases[i] > 0) {
			for(j=0; j<testcase.length; j++){
				if(parseFloat(cases[i]) == parseFloat(testcase[j]) && flag[j] == 0){
					flag[j] = 1;
					html = html+"<tr><td> TC"+j+"</td><td>"+parseFloat(cases[i])+"</td></tr>";
					break;
				}
			}
		}
	html = html+"</tbody></table>";
	$('#finaltable').find('.modal-body').html(html);
}