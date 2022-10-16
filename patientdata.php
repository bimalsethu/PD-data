<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>CSV Downloader</title>
</head>
<body>
<h1 style="color:blue;""text-align:center;" >Patient data</h1>
   <p style="text-align:left;">Patient Id <br>
   Organization<br>
   username<br>
   email id<br>
   Patient Activity Report<br><br><br>
   Data : 1 <a href="data1.csv" download="Patientdata1.csv">
         <button type="button">Download</button></a><br><br>
   Data : 2<a href="data2.csv" download="Patientdata2.csv">
         <button type="button">Download</button></a><br><br>
   Data : 3<a href="data3.csv" download="Patientdata3.csv">
         <button type="button">Download</button></a></br><br>
   Data : 4<a href="data4.csv" download="Patientdata4.csv">
         <button type="button">Download</button></a></br><br>
   Data : 5<a href="data5.csv" download="Patientdata5.csv">
         <button type="button">Download</button></a><br><br>
   Data : 6
<a href="data6.csv" download="Patientdata6.csv">
         <button type="button">Download</button></a>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/4.1.2/papaparse.js"></script>
<script>
    function arrayToTable(tableData) {
        var table = $('<table></table>');
        $(tableData).each(function (i, rowData) {
            var row = $('<tr></tr>');
            $(rowData).each(function (j, cellData) {
                row.append($('<td>'+cellData+'</td>'));
            });
            table.append(row);
        });
        return table;
    }

    
</script>
</body>
</html>	