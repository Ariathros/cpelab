<HTML>
    <HEAD>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </HEAD>

    <BODY>
        
    <br/>
        <div id="dvData">
            <table>
                <tr>
                    <th>Column One</th>
                    <th>Column Two</th>
                    <th>Column Three</th>
                </tr>
                <tr>
                    <td>row1 Col1</td>
                    <td>row1 Col2</td>
                    <td>row1 Col3</td>
                </tr>
                <tr>
                    <td>row2 Col1</td>
                    <td>row2 Col2</td>
                    <td>row2 Col3</td>
                </tr>
                <tr>
                    <td>row3 Col1</td>
                    <td>row3 Col2</td>
                    <td>row3 Col3</td>
                </tr>
            </table>
        </div>
        <br/>
        <a href="x" download="down.xls" id="btnExport">
    Export Table data into Excel
        </a>

        <script>
            $("#btnExport").click(function (e) {
                $(this).attr({
                    'download': "download.xls",
                        'href': 'data:application/csv;charset=utf-8,' + encodeURIComponent( $('#dvData').html())
                })
            });
        </script>   
    </BODY>
</HTML>