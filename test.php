<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        table {
        background-color:#000;
        color:#fff;
        padding:20px;
        border-collapse:separete;
        }
        td {
            padding:10px;
        }
        .trTop td:last-child {
            text-align:right;
        }
        .trBot td {
            text-align:right;
        }
    </style>
    <script type="text/javascript">
    var a = [[
        {"id":1,"user_qty":1},
        {"id":2,"user_qty":2},
        {"id":3,"user_qty":5},
        {"id":4,"user_qty":30}
    ]],

        b = [[
        {"id":1,"name":"POS","training":"2 x 1 Jam","maintenance":"3 Bulan"},
        {"id":2,"name":"INVENTORY","training":"3 x 1 Jam","maintenance":"3 Bulan"},
        {"id":3,"name":"POS PLATINUM","training":"3 x 1.5 Jam","maintenance":"3 Bulan"},
        {"id":4,"name":"STANDARD","training":"4 x 1.5 Jam","maintenance":"3 Bulan"}
    ]],

        c = [[
        {"id":1,"packet_id":1,"user_qty_id":1,"harga":"2300000"},
        {"id":2,"packet_id":1,"user_qty_id":2,"harga":"3000000"},
        {"id":3,"packet_id":1,"user_qty_id":3,"harga":"4000000"},
        {"id":4,"packet_id":1,"user_qty_id":4,"harga":"6000000"},
        {"id":5,"packet_id":2,"user_qty_id":1,"harga":"4100000"},
        {"id":6,"packet_id":2,"user_qty_id":2,"harga":"5200000"},
        {"id":7,"packet_id":2,"user_qty_id":3,"harga":"6200000"},
        {"id":8,"packet_id":2,"user_qty_id":4,"harga":"8200000"}
    ]];



    class arranger
    {
        constructor(a,b,c)
        {
            this.a = a;
            this.b = b;
            this.c = c;
            this.p = "";
        }

        qq(){
            var packer = [], y;
            c = c[0];
            for (var x = 0; x < c.length; x++) {
                var wd = typeof packer[[c[x]['packet_id']]];
                if (wd == "undefined") {
                    packer[c[x]['packet_id']] = [{"harga":c[x]['harga'],"user_qty_id":c[x]['user_qty_id']}];
                } else {
                    packer[c[x]['packet_id']].push({"harga":c[x]['harga'],"user_qty_id":c[x]['user_qty_id']});
                }
            }
            var p = "<tr>";
            for (x in a[0]) {
                p+= "<th>"+a[0][x]['user_qty']+" user</th>";
            }
            p += "</tr>";
            for (x in b[0]) {
                p+='<tr class="trTop"><td colspan="'+(a[0].length-2)+'">'+b[0][x]['name']+'<td colspan="2">'+b[0][x]['training']+' '+b[0][x]['maintenance']+'</td></tr>';
                if (typeof packer[b[0][x]['id']] !== "undefined") {
                    p+='<tr class="trBot">';
                    for (y in packer[b[0][x]['id']]) {
                        p+='<td>'+packer[b[0][x]['id']][y]['harga']+'</td>';
                    }
                    p+='</tr>';
                }
            }
            
            return p;
        }

        iii($qwe){
            this.p = $qwe;
        }

        zzz(){
            document.getElementById('wg').innerHTML = this.p;
        }
    }

    (function(){
        var $ar = new arranger(a,b,c);
        $ar.iii($ar.qq());
        window.onload = function(){
            $ar.zzz()
        };
    })();
    </script>
</head>
<body>
<table id="wg">
</table>
</body>
</html>