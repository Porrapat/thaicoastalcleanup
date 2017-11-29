// ************************************************ Event **********************************************
// ---------------------------------------------- Page Load --------------------------------------------
$(document).ready(function() {
    initDaterange();
    CreateMarineDebrisItemRptData();
});

// Init DatetimePicker.
function initDaterange() {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month')
            , moment().subtract(1, 'month').endOf('month')],

            'This Year': [moment().startOf('year'), moment().endOf('year')],
            'Last Year': [moment().subtract(1, 'year').startOf('year')
            , moment().subtract(1, 'year').endOf('year')]
        }
    }, cb);

    cb(start, end);
}
// End Init DatetimePicker.


// ----------------------------------------------- Force AJAX ------------------------------------------
$('#genReport').on('click', function(e) { CreateMarineDebrisItemRptData(); });
// ---------------------------------------------- Select input -----------------------------------------
$('#daterange').on('apply.daterangepicker', function(ev, picker) { ChangeDaterange(picker); });
$('select#provinceCode').on('change', function(e) { ChangeProvince(e); });
// ---------------------------------------------- Table Report -----------------------------------------



// -------------------------------------------------- AJAX ---------------------------------------------
// ________________________________________________ Daterange __________________________________________
function ChangeDaterange(picker) {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1];
    let strDateStart = picker.startDate.format('YYYY-MM-DD');
    let strDateEnd = picker.endDate.format('YYYY-MM-DD');
    let provinceCode = $('select#provinceCode :selected').val();
    let amphurCode = $('select#amphurCode :selected').val();

    let data = {
        'strDateStart'  : strDateStart,
        'strDateEnd'    : strDateEnd,
        'provinceCode'  : provinceCode,
        'amphurCode'    : amphurCode,
    }

    // Get daily target report by ajax.
    $.ajax({
        url: baseUrl + '/report2/ajaxGetOverviewReportData',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function(){},
        error: function(xhr, textStatus){
            swal("Error", textStatus + xhr.responseText, "error");
        },
        complete: function(){},
        success: function(result) {
            renderTableMarineDebrisMain(result.marineDebrisTableRpt)
            renderChartMarineDebrisMain(result.marineDebrisChartRpt);
        }
    });
}
// _______________________________________________ Province ____________________________________________
function ChangeProvince(e) {
    let baseUrl = $('input#baseUrl').val();
    let provinceCode = $('select#provinceCode :selected').val();

    let data = { 'provinceCode': provinceCode };

    // Get amphur table filter with province code by ajax.
    $.ajax({
        url: baseUrl + 'iccCard/ajaxGetAmphurCodeAndName',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function() {},
        error: function(xhr, textStatus) {
            swal("Error", textStatus + xhr.responseText, "error");
        },
        complete: function() {},
        success: function(result) {
            setSelectElementOfAmphur(result, $('select#amphurCode'));
        }
    });

    CreateMarineDebrisItemRptData();
}

// ____________________________________________ Choose Province ________________________________________
function chooseProvince(provinceCode) {
    $('input#strDateStart').val($('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD'));
    $('input#strDateEnd').val($('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD'));
    $('input#provinceCode').val(provinceCode);
    $('form#formOverviewReport').submit();
}







//-------------------------------------------------- Tool ----------------------------------------------
//___________________________________________ Set Select Elecment ______________________________________
function setSelectElementOfAmphur(dataSet, $selector) {
    $selector.empty();
    $selector.append('<option value="0">----</option>');
    for (var i = 0; i < dataSet.length; i++) {
        $selector.append('<option value="' + dataSet[i].AmphurCode + '">' + dataSet[i].AmphurName + '</option>');
    }
}


// ________________________________________________ Charts _____________________________________________
function CreateMarineDebrisItemRptData() {
    ChangeDaterange($('#daterange').data('daterangepicker'));
}

function renderChartMarineDebrisMain(data) {
    FusionCharts.ready(function () {
        var marineDebrisColumnChart = new FusionCharts({
            "type": "column3d",
            "renderAt": "marineDebrisMainColumnChart",
            "width": "100%",
            "height": "400",
            "dataFormat": "json",
            "dataSource": {
                "chart": {
                    "caption": "กราฟแท่งชนิดของข้อมูลขยะทะเล 10 อันดับแรกในประเทศไทย",
                    "subCaption": "",
                    "xAxisName": "ประเภทขยะ",
                    "yAxisName": "จำนวน",
                    "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                    "bgColor": "#ffffff",
                    "showBorder": "0",
                    "use3DLighting": "0",
                    "showShadow": "0",
                    "enableSmartLabels": "1",
                    "startingAngle": "0",
                    "showValue" : "1", 
                    "showPercentValues": "0",
                    "showPercentInTooltip": "1",
                    "decimals": "1",
                    "captionFontSize": "14",
                    "subcaptionFontSize": "14",
                    "subcaptionFontBold": "0",
                    "toolTipColor": "#ffffff",
                    "toolTipBorderThickness": "0",
                    "toolTipBgColor": "#000000",
                    "toolTipBgAlpha": "80",
                    "toolTipBorderRadius": "2",
                    "toolTipPadding": "5",
                    "showHoverEffect": "1",
                    "showLegend": "1",
                    "legendBgColor": "#ffffff",
                    "legendBorderAlpha": "0",
                    "legendShadow": "0",
                    "legendItemFontSize": "10",
                    "legendItemFontColor": "#666666",
                    "useDataPlotColorForLabels": "1"
                },
                "data": data
            }
        }).render();

        var marineDebrisPieChart = new FusionCharts({
            "type": "pie3d",
            "renderAt": "marineDebrisMainPieChart",
            "width": "100%",
            "height": "400",
            "dataFormat": "json",
            "dataSource": {
                "chart": {
                    "caption": "แผนภาพวงกลมชนิดของข้อมูลขยะทะเล 10 อันดับแรกในประเทศไทย",
                    "subCaption": "",
                    "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                    "bgColor": "#ffffff",
                    "showBorder": "0",
                    "use3DLighting": "0",
                    "showShadow": "0",
                    "enableSmartLabels": "1",
                    "startingAngle": "0",
                    "showValue" : "1", 
                    "showPercentValues": "0",
                    "showPercentInTooltip": "1",
                    "decimals": "1",
                    "captionFontSize": "14",
                    "subcaptionFontSize": "14",
                    "subcaptionFontBold": "0",
                    "toolTipColor": "#ffffff",
                    "toolTipBorderThickness": "0",
                    "toolTipBgColor": "#000000",
                    "toolTipBgAlpha": "80",
                    "toolTipBorderRadius": "2",
                    "toolTipPadding": "5",
                    "showHoverEffect": "1",
                    "showLegend": "1",
                    "legendBgColor": "#ffffff",
                    "legendBorderAlpha": "0",
                    "legendShadow": "0",
                    "legendItemFontSize": "10",
                    "legendItemFontColor": "#666666",
                    "useDataPlotColorForLabels": "1"
                },
                "data": data
            }
        }).render();
    });
}

// ________________________________________________ Table ______________________________________________
function renderTableMarineDebrisMain(data) {
    $('table#marineDebrisTable > tbody').html(getTable(data));
}
function getTable(data) {
	let htmlTable = "";
    
    let provinceName = "";
    let provinceOrder = 1;
    let limit = 0;
	let row;
	for(let i=0; i<data.length; i++)
	{
        row = data[i];
        if(row["ProvinceName"] == provinceName) {
            if(limit < 10) {
                    row["ProvinceName"] = "";
                    htmlTable += genData(row, "", limit+1);
            }
        } else {
            limit = 0;
            provinceName = row["ProvinceName"];
            htmlTable += genData(row, provinceOrder++, limit+1);
        }
    
        limit++;
	}

    return htmlTable;
}
function genData(row, provinceOrder, marineDebrisOrder) {
	let htmlTable;
	
    htmlTable +='<tr>';
    htmlTable +='<td class="text-right">' + provinceOrder + '</td>';
    htmlTable +='<td class="text-left">'
                    + '<a id="provinceCode1" href="#" onClick="chooseProvince(' + row['ProvinceCode'] + ');">'
                        + row['ProvinceName']
                    + '</a>'
                + '</td>';
    htmlTable +='<td class="text-right">' + marineDebrisOrder + '.</td>';
    htmlTable +='<td class="text-left">' + row['Name'] + '</td>';
	htmlTable +='<td class="text-right">' + row['sumQty'].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '</td>';
	htmlTable +='</tr>';
	
	return htmlTable;
}