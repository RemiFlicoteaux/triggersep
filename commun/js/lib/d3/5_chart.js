
//Permet de recuperer le bon Json
//Selon le type recu Bar/Column/Pie
function getJsonFile(type)
{

    html = LanceAjax("../commun/json/" + type + ".json", "");

    html = eval("(" + html + ')');
    return html;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Bar
// http://bl.ocks.org/diethardsteiner/3287802
//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function dsBarChartBasics() {

    var margin = {top: 30, right: 5, bottom: 20, left: 50},
    width = 450 - margin.left - margin.right,
            height = 250 - margin.top - margin.bottom,
            colorBar = d3.scale.category20(),
            barPadding = 10
            ;

    return {
        margin: margin,
        width: width,
        height: height,
        colorBar: colorBar,
        barPadding: barPadding
    }
    ;
}

var formatAsPercentage = d3.format("%"),
        formatAsPercentage1Dec = d3.format(".1%"),
        formatAsInteger = d3.format(""),
        fsec = d3.time.format("%S s"),
        fmin = d3.time.format("%M m"),
        fhou = d3.time.format("%H h"),
        fwee = d3.time.format("%a"),
        fdat = d3.time.format("%d d"),
        fmon = d3.time.format("%b")
        ;



function dsBarChart(data, target, Title, colorChosen) {

    var firstDatasetBarChart = data;

    var basics = dsBarChartBasics();

    var margin = basics.margin,
            width = basics.width,
            height = basics.height,
            colorBar = d3.scale.category20(),
            barPadding = basics.barPadding
            ;

    var x = d3.scale.ordinal()
            .rangeRoundBands([0, width], .1, .3);

    var y = d3.scale.linear()
            .range([height, 0]);

    var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom");

    //alert(Title+'='+d3.max(firstDatasetBarChart, function(d) { return parseInt(d.valeur); }))		;
    var xScale = d3.scale.linear()
            .domain([0, firstDatasetBarChart.length])
            .range([0, width])
            ;

    //Create linear y scale 
    // Purpose: No matter what the data is, the bar should fit into the svg area; bars should not
    // get higher than the svg height. Hence incoming data needs to be scaled to fit into the svg area.  
    var yScale = d3.scale.linear()
            // use the max funtion to derive end point of the domain (max value of the dataset)
            // do not use the min value of the dataset as min of the domain as otherwise you will not see the first bar
            .domain([0, d3.max(firstDatasetBarChart, function (d) {
                    return parseInt(d.valeur);
                })])
            // As coordinates are always defined from the top left corner, the y position of the bar
            // is the svg height minus the data value. So you basically draw the bar starting from the top. 
            // To have the y position calculated by the range function
            .range([height, 0]);

    //Create SVG element

    var svg = d3.select(target)
            .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .attr("id", "barChartPlot");

    var plot = svg
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    plot.selectAll("rect")
            .data(firstDatasetBarChart)
            .enter()
            .append("rect")
            .attr("x", function (d, i) {
                return xScale(i);
            })
            .attr("width", width / firstDatasetBarChart.length - barPadding)
            .attr("y", function (d) {
                return yScale(d.valeur);
            })
            .attr("height", function (d) {
                return height - yScale(d.valeur);
            })
            .attr("fill", colorBar(25));


    // Add y labels to plot	
    plot.selectAll("text")
            .data(firstDatasetBarChart)
            .enter()
            .append("text")
            .text(function (d) {
                return formatAsInteger(d3.round(d.valeur));
            })
            .attr("text-anchor", "middle")
            // Set x position to the left edge of each bar plus half the bar width
            .attr("x", function (d, i) {
                return (i * (width / firstDatasetBarChart.length)) + ((width / firstDatasetBarChart.length - barPadding) / 2);
            })
            .attr("y", function (d) {
                return yScale(d.valeur) + 14;
            })
            .attr("class", "yAxis");


    // Add x labels to chart	

    var xLabels = svg
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + (margin.top + height) + ")")
            ;

    xLabels.selectAll("text.xAxis")
            .data(firstDatasetBarChart)
            .enter()
            .append("text")

            .text(function (d) {
                return d.libelle;
            })
            .attr("text-anchor", "middle")
            // Set x position to the left edge of each bar plus half the bar width
            .attr("x", function (d, i) {
                return (i * (width / firstDatasetBarChart.length)) + ((width / firstDatasetBarChart.length - barPadding) / 2);
            })
            .attr("y", 15)
            .attr("class", "xAxis");


    xLabels.selectAll("text.xAxis")

            .selectAll("text")
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .call(xAxis)
            .call(wrap, 50)
            .attr("transform", function (d) {
                return "rotate(-65)"
            });

    // .attr("style", "font-size: 12; font-family: Helvetica, sans-serif")
    ;



    /*
     xLabels.selectAll("text.xAxis")
     .attr("class", "x axis")
     .call(xScale)
     .call(wrap,80);*/
    // Title
    svg.append("text")
            .attr("x", (width + margin.left + margin.right) / 2)
            .attr("y", 15)
            .attr("class", "title")
            .attr("text-anchor", "middle")
            .text(Title)
            ;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Barres 2
//  http://bl.ocks.org/mbostock/7555321
//
/////////////////////////////////////////////////////////////////////////////////////////////////////

function wrap(text, width) {
    text.each(function () {
        var text = d3.select(this),
                words = text.text().split(/\s+/).reverse(),
                word,
                line = [],
                lineNumber = 0,
                lineHeight = 1.1, // ems
                y = text.attr("y"),
                dy = parseFloat(text.attr("dy")),
                tspan = text.text(null).append("tspan").attr("x", 0).attr("y", y).attr("dy", dy + "em");

        while (word = words.pop()) {
            line.push(word);
            tspan.text(line.join(" "));
            if (tspan.node().getComputedTextLength() > width) {
                line.pop();
                tspan.text(line.join(" "));
                line = [word];
                tspan = text.append("tspan").attr("x", 0).attr("y", y).attr("dy", ++lineNumber * lineHeight + dy + "em").text(word);
            }
        }
    });
}

function type(d) {
    d.value = +d.value;
    return d;
}

function dsBarChart2(dataset, target, Title) {

    var margin = {top: 80, right: 0, bottom: 80, left: 50},
    width = 960 - margin.left - margin.right,
            height = 500 - margin.top - margin.bottom;

    var x = d3.scale.ordinal()
            .rangeRoundBands([0, width], .1, .3);

    var y = d3.scale.linear()
            .range([height, 0]);

    var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom");

    var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(8, "%");

    var svg = d3.select(target).append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    function type(d) {
        d.value = +d.value;
        return d;
    }
    data = dataset;
//d3.tsv("data.tsv", type, function(error, data) {
    x.domain(data.map(function (d) {
        return d.libelle;
    }));
    y.domain([0, d3.max(data, function (d) {
            return d.valeur;
        })]);

    //alert(JSON.stringify(data));
    svg.append("text")
            .attr("class", "title")
            .attr("x", x(data[0].libelle))
            .attr("y", -26)
            .text(Title);

    svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis)
            .selectAll(".tick text")
            .call(wrap, x.rangeBand());

    svg.append("g")
            .attr("class", "y axis")
            .call(yAxis);

    svg.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")    
            .attr("x", function (d) {
                return x(d.libelle);
            })
            .attr("width", x.rangeBand())
            .attr("y", function (d) {
                return y(d.valeur);
            })
            .attr("height", function (d) {
                return height - y(d.valeur);
            });
//});

}

//////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Pie
//  http://bl.ocks.org/diethardsteiner/3287802
//
/////////////////////////////////////////////////////////////////////////////////////////////////////


function dsPieChart(dataset, target, Title) {

    var width = 300,
            height = 300,
            outerRadius = Math.min(width, height) / 2,
            innerRadius = outerRadius * .999,
            // for animation
            innerRadiusFinal = outerRadius * .5,
            innerRadiusFinal3 = outerRadius * .45,
            color = d3.scale.category20()   //builtin range of colors
            ;

    var vis = d3.select(target)
            .append("svg:svg")              //create the SVG element inside the <body>
            .data([dataset])                   //associate our data with the document
            .attr("width", width)           //set the width and height of our visualization (these will be attributes of the <svg> tag
            .attr("height", height)
            .append("svg:g")                //make a group to hold our pie chart
            .attr("transform", "translate(" + outerRadius + "," + outerRadius + ")")    //move the center of the pie chart from 0, 0 to radius, radius
            ;

    var arc = d3.svg.arc()              //this will create <path> elements for us using arc data
            .outerRadius(outerRadius).innerRadius(innerRadius);

    // for animation
    var arcFinal = d3.svg.arc().innerRadius(innerRadiusFinal).outerRadius(outerRadius);
    var arcFinal3 = d3.svg.arc().innerRadius(innerRadiusFinal3).outerRadius(outerRadius);

    var pie = d3.layout.pie()           //this will create arc data for us given a list of values
            .value(function (d) {
                return parseInt(d.valeur);
            });    //we must tell it out to access the value of each element in our data array

    var arcs = vis.selectAll("g.slice")     //this selects all <g> elements with class slice (there aren't any yet)
            .data(pie)                          //associate the generated pie data (an array of arcs, each having startAngle, endAngle and value properties) 
            .enter()                            //this will create <g> elements for every "extra" data element that should be associated with a selection. The result is creating a <g> for every object in the data array
            .append("svg:g")                //create a group to hold each slice (we will have a <path> and a <text> element associated with each slice)
            .attr("class", "slice")    //allow us to style things in the slices (like text)
            .on("mouseover", mouseover)
            .on("mouseout", mouseout)

            ;

    arcs.append("svg:path")
            .attr("fill", function (d, i) {
                return color(i);
            }) //set the color for each slice to be chosen from the color function defined above
            .attr("d", arc)     //this creates the actual SVG path using the associated data (pie) with the arc drawing function
            .append("svg:title") //mouseover title showing the figures
            .text(function (d) {
                return d.data.libelle + ": " + formatAsPercentage(d.data.valeur);
            });

    d3.selectAll("g.slice").selectAll("path").transition()
            .duration(750)
            .delay(10)
            .attr("d", arcFinal)
            ;

    // Add a label to the larger arcs, translated to the arc centroid and rotated.
    // source: http://bl.ocks.org/1305337#index.html
    arcs.filter(function (d) {
        return d.endAngle - d.startAngle > .2;
    })
            .append("svg:text")
            .attr("dy", ".35em")
            .attr("text-anchor", "middle")
            .attr("transform", function (d) {
                return "translate(" + arcFinal.centroid(d) + ")rotate(" + angle(d) + ")";
            })
            //.text(function(d) { return formatAsPercentage(d.value); })
            .text(function (d) {
                return d.data.libelle;
            })
            ;

    // Computes the label angle of an arc, converting from radians to degrees.
    function angle(d) {
        var a = (d.startAngle + d.endAngle) * 90 / Math.PI - 90;
        return a > 90 ? a - 180 : a;
    }


    // Pie chart title			
    vis.append("svg:text")
            .attr("dy", ".35em")
            .attr("text-anchor", "middle")
            .text(Title)
            .attr("class", "title")
            ;



    function mouseover() {
        d3.select(this).select("path").transition()
                .duration(750)
                //.attr("stroke","red")
                //.attr("stroke-width", 1.5)
                .attr("d", arcFinal3)
                ;
    }

    function mouseout() {
        d3.select(this).select("path").transition()
                .duration(750)
                //.attr("stroke","blue")
                //.attr("stroke-width", 1.5)
                .attr("d", arcFinal)
                ;
    }

    function up(d, i) {

        /* update bar chart when user selects piece of the pie chart */
        //updateBarChart(dataset[i].libelle);
        //updateBarChart(d.data.libelle, color(i));
        //updateLineChart(d.data.libelle, color(i));

    }
}




//////////////////////////////////////////////////////////////////////////////////////////////////
//
// Pour l'instant pas utile
//
//////////////////////////////////////////////////////////////////////////////////////////////////

/* ** UPDATE CHART ** */

/* updates bar chart on request */

function updateBarChart(data, colorChosen, target) {

    var currentDatasetBarChart = datasetBarChosen(data);

    var basics = dsBarChartBasics();

    var margin = basics.margin,
            width = basics.width,
            height = basics.height,
            colorBar = basics.colorBar,
            barPadding = basics.barPadding
            ;

    var xScale = d3.scale.linear()
            .domain([0, currentDatasetBarChart.length])
            .range([0, width])
            ;


    var yScale = d3.scale.linear()
            .domain([0, d3.max(currentDatasetBarChart, function (d) {
                    return d.valeur;
                })])
            .range([height, 0])
            ;

    var svg = d3.select(target);

    var plot = d3.select("#barChartPlot")
            .datum(currentDatasetBarChart)
            ;

    /* Note that here we only have to select the elements - no more appending! */
    plot.selectAll("rect")
            .data(currentDatasetBarChart)
            .transition()
            .duration(750)
            .attr("x", function (d, i) {
                return xScale(i);
            })
            .attr("width", width / currentDatasetBarChart.length - barPadding)
            .attr("y", function (d) {
                return yScale(d.valeur);
            })
            .attr("height", function (d) {
                return height - yScale(d.valeur);
            })
            .attr("fill", colorChosen)
            ;

    plot.selectAll("text.yAxis") // target the text element(s) which has a yAxis class defined
            .data(currentDatasetBarChart)
            .transition()
            .duration(750)
            .attr("text-anchor", "middle")
            .attr("x", function (d, i) {
                return (i * (width / currentDatasetBarChart.length)) + ((width / currentDatasetBarChart.length - barPadding) / 2);
            })
            .attr("y", function (d) {
                return yScale(d.valeur) + 14;
            })
            .text(function (d) {
                return formatAsInteger(d3.round(d.valeur));
            })
            .attr("class", "yAxis")
            ;


    svg.selectAll("text.title") // target the text element(s) which has a title class defined
            .attr("x", (width + margin.left + margin.right) / 2)
            .attr("y", 15)
            .attr("class", "title")
            .attr("text-anchor", "middle")
            .text(group + "'s Sales Breakdown 2012")
            ;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function PrintHightChart(ArrayPhp)
{
    //Pour chaque indice du tableau on charge le bon json Pie Bar Column
    for (var i = 0; i < ArrayPhp.length; i++)
    {

        json = getJsonFile(ArrayPhp[i].Type);
        json.title.text = ArrayPhp[i].Titre;


        //On applique les données dans le Json pour diagramme bar
        if (ArrayPhp[i].Type == "Bar")
        {
            json.xAxis.categories = ArrayPhp[i].xAxis;



            for (var j = 0; j < ArrayPhp[i].DataX.length; j++)
            {
                var jsonSeries = {name: ArrayPhp[i].DataX[j].seriesName, data: ArrayPhp[i].DataX[j].chiffre};
                json.series[j] = jsonSeries;
            }

        }

        //On applique les données dans le Json pour diagramme pie
        if (ArrayPhp[i].Type == "Pie")
        {
            var jsonSeries;

            if (ArrayPhp[i].Type == "Pie")
            {
                jsonSeries.type = "pie";
            }

            jsonSeries.data = [];



            //Il y a le même nombre de données chiffre que de donné dans xAxis
            for (var k = 0; k < ArrayPhp[i].DataX.length; k++)
            {
                jsonSeries.name = ArrayPhp[i].DataX[k].seriesName;

                for (var j = 0; j < ArrayPhp[i].DataX[k].chiffre.length; j++)
                {
                    tab = [ArrayPhp[i].xAxis[j], ArrayPhp[i].DataX[k].chiffre[j]];
                    jsonSeries.data.push(tab);
                }
                json.series[k] = jsonSeries;
            }
        }

        if (ArrayPhp[i].Type == "Spider")
        {
            json.xAxis.categories = ArrayPhp[i].xAxis;


            var jsonSeries = [];
            var tab = [];
            for (var j = 0; j < ArrayPhp[i].DataX.length; j++)
            {
                tab[j] = {type: 'line', name: ArrayPhp[i].DataX[j].seriesName, data: ArrayPhp[i].DataX[j].chiffre};
            }
            json.series = tab;
        }

        $(ArrayPhp[i].ID).highcharts(json);

    }
}

function horizontal_chart(dataChart, targetTag) {

    var data = d3.range(10).map(Math.random);
    var data = [];
    var colorlist = ["#c9dec9", "#6194c3"];
    var labellist = [];

    for (var i in dataChart) {
        data.push(dataChart[i].valeur);
        labellist.push(dataChart[i].libelle);
    }

    var w = 1000,
            h = 260,
            labelpad = 230,
            x = d3.scale.linear().domain([0, 100]).range([0, w]),
            y = d3.scale.ordinal().domain(d3.range(data.length)).rangeBands([01, h], .2);

    var vis = d3.select(targetTag)
            .append("svg:svg")
            .attr("width", w + 40)
            .attr("height", h + 20)
            .append("svg:g")
            .attr("transform", "translate(20,0)");

    var bars = vis.selectAll("g.bar")
            .data(data)
            .enter().append("svg:g")
            .attr("class", "bar")
            .attr("transform", function (d, i) {
                return "translate(" + labelpad + "," + y(i) + ")";
            });

    bars.append("svg:rect")
            .attr("fill", function (d, i) {
                return colorlist[i % 2];
            })   //Alternate colors
            .attr("width", x)
            .attr("height", y.rangeBand());

    bars.append("svg:text")
            .attr("x", 0)
            .attr("y", 10 + y.rangeBand() / 2)
            .attr("dx", -6)
            .attr("dy", ".35em")
            .attr("text-anchor", "end")
            .text(function (d, i) {
                return labellist[i];
            });


    var rules = vis.selectAll("g.rule")
            .data(x.ticks(10))
            .enter().append("svg:g")
            .attr("class", "rule")
            .attr("transform", function (d) {
                return "translate(" + x(d) + ", 0)";
            });

    rules.append("svg:line")
            .attr("y1", h)
            .attr("y2", h + 6)
            .attr("x1", labelpad)
            .attr("x2", labelpad)
            .attr("stroke", "black");

    rules.append("svg:line")
            .attr("y1", 0)
            .attr("y2", h)
            .attr("x1", labelpad)
            .attr("x2", labelpad)
            .attr("stroke", "white")
            .attr("stroke-opacity", .3);


    rules.append("svg:text")
            .attr("y", h + 8)
            .attr("x", labelpad)
            .attr("dy", ".71em")
            .attr("text-anchor", "middle")
            .text(x.tickFormat(10));
}

/*
 * 
 * Fonction recevant les différentes données en JSON
 * Selon le type dans le json on appel la fonction qui fabriquera le bon graphe
 * */
function printChart(TabData)
{

    for (var i = 0; i < TabData.length; i++)
    {

        if (TabData[i].type == "Bar")
        {
            //alert(JSON.stringify(TabData[i].dataChart));
            dsBarChart(TabData[i].dataChart, TabData[i].targetTag, TabData[i].Titre, 0);
        }

        if (TabData[i].type == "Pie")
        {
            //printPie(TabData[i].dataChart,TabData[i].targetTag);
            dsPieChart(TabData[i].dataChart, TabData[i].targetTag, TabData[i].Titre);
        }
        if (TabData[i].type == "hor_bar")
        {
            //horizontal_chart(TabData[i].dataChart,TabData[i].targetTag);
            //alert(TabData[i].dataChart);
            //printHorizontalBar(TabData[i].dataChart,TabData[i].dataChart.valeur,TabData[i].targetTag,TabData[i].yName)
            dsBarChart2(TabData[i].dataChart, TabData[i].targetTag, TabData[i].Titre);
            //  dsBarChart_demo(TabData[i].dataChart, TabData[i].targetTag, TabData[i].Titre);

        }
    }
}


function printBar(data, typeData, YaxisName, target)
{

    // definition des dimension du graphe
    var padding = 20;
    var margin = {top: 0, right: 20, bottom: 180, left: 40},
    width = 500 - margin.left - margin.right,
            height = 450 - margin.top - margin.bottom;

    // Iinitialisaiton des axes
    var x = d3.scale.ordinal()
            .rangeRoundBands([0, width], .15);

    var y = d3.scale.linear()
            .range([height, 0]);

    // positionnement des axes
    var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom")
            .tickSize(10);

    var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left");


    // Initialisation des champs qui s'affichera au onover du graphe
    var tip = d3.tip()
            .attr('class', 'd3-tip')
            .offset([-10, 0])
            .html(function (d) {
                return "<strong>" + YaxisName + ":</strong> <span style='color:red'>" + d.valeur + "</span>";
            })

    //creation balise svg dans la page qui sevira a contenir le graphe
    var svg = d3.select(target).append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    svg.call(tip);

    x.domain(data.map(function (d) {
        return d.libelle;
    }));

    // definition de la limite des axes
    if (typeData == "pourcentage")
        y.domain([0, 100]);
    else
        y.domain([0, d3.max(data, function (d) {
                return d.valeur + 100;
            })]);

    // ajout de spécification des axe
    svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis)
            .selectAll("text")
            .style("font-size", "medium")
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", function (d) {
                return "rotate(-65)"
            });


    svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 2)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text(YaxisName);


    //Aplication des evenement aux graphes
    svg.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", function (d) {
                return x(d.libelle);
            })
            .attr("width", x.rangeBand())
            .attr("y", function (d) {
                return y(d.valeur);
            })
            .attr("height", function (d) {
                return height - y(d.valeur);
            })
            .on('mouseover', tip.show)
            .on('mouseout', tip.hide);



    function type(d)
    {
        d.valeur = +d.valeur;
        return d;
    }

}

//fonction permettant de faire les graphes camembert
function printPie(data, target)
{

    nv.addGraph(function () {
        var chart = nv.models.pieChart()
                .x(function (d) {
                    return d.libelle
                })
                .y(function (d) {
                    return d.valeur
                })
                .showLabels(true)
                .labelThreshold(.05)
                .labelType("percent");		// ligne permettant de conciderer les valeurs inseré en %

        d3.select(target).append("svg")
                .datum(data)
                .transition().duration(350)
                .call(chart)

        return chart;
    });


}

// fonction permettant de faire diagramme honrizontal
function printHorizontalBar(names, number, target, YaxisName)
{
    var chart,
            width = 400,
            bar_height = 20,
            height = bar_height * names.length,
            x, y, yRangeBand,
            left_width = 300,
            gap = 2,
            extra_width = 100;

    x = d3.scale.linear()
            .domain([0, d3.max(number)])
            .range([0, width]);



    yRangeBand = bar_height + 2 * gap;
    y = function (i) {
        return yRangeBand * i;
    };

    chart = d3.select(target)
            .append('svg')
            .attr('class', 'chart')
            .attr('width', left_width + width + 40 + extra_width)
            .attr('height', (bar_height + gap * 2) * (names.length + 1))
            .append("g")
            .attr("transform", "translate(10, 20)");

    chart.selectAll("line")
            .data(x.ticks(d3.max(number)))
            .enter().append("line")
            .attr("x1", function (d) {
                return x(d) + left_width;
            })
            .attr("x2", function (d) {
                return x(d) + left_width;
            })
            .attr("y1", 0)
            .attr("y2", (bar_height + gap * 2) * names.length);

    chart.selectAll(".rule")
            .data(x.ticks(d3.max(number)))
            .enter().append("text")
            .attr("class", "rule")
            .attr("x", function (d) {
                return x(d) + left_width;
            })
            .attr("y", 0)
            .attr("dy", -6)
            .attr("text-anchor", "middle")
            .attr("font-size", 0)
            .text(String);



    chart.selectAll("rect")
            .data(number)
            .enter().append("rect")
            .attr("x", left_width)
            .attr("y", function (d, i) {
                return y(i) + gap;
            })
            .attr("width", x)
            .attr("height", bar_height)
            ;




    chart.selectAll("text.score")
            .data(number)
            .enter().append("text")
            .attr("x", function (d) {
                return x(d) + left_width;
            })
            .attr("y", function (d, i) {
                return y(i) + yRangeBand / 2;
            })
            .attr("dx", -5)
            .attr("dy", ".36em")
            .attr("text-anchor", "end")
            .attr('class', 'score')
            .text(String);


    chart.selectAll("text.name")
            .data(names)
            .enter().append("text")
            .attr("x", left_width / 2)
            .attr("y", function (d, i) {
                return y(i) + yRangeBand / 2;
            })
            .attr("dy", ".36em")
            .attr("text-anchor", "middle")
            .attr('class', 'name')
            .text(String);


}

