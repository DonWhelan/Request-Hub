{"filter":false,"title":"userCompanyRegister.php","tooltip":"/userCompanyRegister.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":30,"column":6},"end":{"row":30,"column":7},"action":"insert","lines":["a"],"id":52},{"start":{"row":30,"column":7},"end":{"row":30,"column":8},"action":"insert","lines":["d"]},{"start":{"row":30,"column":8},"end":{"row":30,"column":9},"action":"insert","lines":["2"]}],[{"start":{"row":31,"column":7},"end":{"row":31,"column":8},"action":"remove","lines":["m"],"id":53},{"start":{"row":31,"column":6},"end":{"row":31,"column":7},"action":"remove","lines":["e"]}],[{"start":{"row":31,"column":6},"end":{"row":31,"column":7},"action":"insert","lines":["p"],"id":54},{"start":{"row":31,"column":7},"end":{"row":31,"column":8},"action":"insert","lines":["c"]}],[{"start":{"row":32,"column":7},"end":{"row":32,"column":8},"action":"remove","lines":["m"],"id":55},{"start":{"row":32,"column":6},"end":{"row":32,"column":7},"action":"remove","lines":["e"]}],[{"start":{"row":32,"column":6},"end":{"row":32,"column":7},"action":"insert","lines":["c"],"id":56},{"start":{"row":32,"column":7},"end":{"row":32,"column":8},"action":"insert","lines":["n"]}],[{"start":{"row":34,"column":13},"end":{"row":34,"column":16},"action":"remove","lines":["$un"],"id":57},{"start":{"row":34,"column":13},"end":{"row":34,"column":16},"action":"insert","lines":["$cn"]}],[{"start":{"row":34,"column":27},"end":{"row":34,"column":30},"action":"remove","lines":["$pw"],"id":58},{"start":{"row":34,"column":27},"end":{"row":34,"column":30},"action":"insert","lines":["$ad"]}],[{"start":{"row":34,"column":41},"end":{"row":34,"column":45},"action":"remove","lines":["$pwm"],"id":59},{"start":{"row":34,"column":41},"end":{"row":34,"column":44},"action":"insert","lines":["$pc"]}],[{"start":{"row":34,"column":55},"end":{"row":34,"column":58},"action":"remove","lines":["$em"],"id":60},{"start":{"row":34,"column":55},"end":{"row":34,"column":58},"action":"insert","lines":["$cn"]}],[{"start":{"row":36,"column":45},"end":{"row":36,"column":47},"action":"remove","lines":["un"],"id":61},{"start":{"row":36,"column":45},"end":{"row":36,"column":46},"action":"insert","lines":["m"]},{"start":{"row":36,"column":46},"end":{"row":36,"column":47},"action":"insert","lines":["t"]}],[{"start":{"row":45,"column":41},"end":{"row":45,"column":44},"action":"remove","lines":["$un"],"id":62},{"start":{"row":45,"column":41},"end":{"row":45,"column":44},"action":"insert","lines":["$cn"]}],[{"start":{"row":56,"column":41},"end":{"row":56,"column":44},"action":"remove","lines":["$pw"],"id":63},{"start":{"row":56,"column":41},"end":{"row":56,"column":44},"action":"insert","lines":["$ad"]}],[{"start":{"row":65,"column":42},"end":{"row":65,"column":46},"action":"remove","lines":["$pwm"],"id":64},{"start":{"row":65,"column":42},"end":{"row":65,"column":46},"action":"insert","lines":["$ad2"]}],[{"start":{"row":74,"column":38},"end":{"row":74,"column":41},"action":"remove","lines":["$em"],"id":65},{"start":{"row":74,"column":38},"end":{"row":74,"column":41},"action":"insert","lines":["$pc"]}],[{"start":{"row":81,"column":5},"end":{"row":82,"column":0},"action":"insert","lines":["",""],"id":66},{"start":{"row":82,"column":0},"end":{"row":82,"column":4},"action":"insert","lines":["    "]},{"start":{"row":82,"column":4},"end":{"row":83,"column":0},"action":"insert","lines":["",""]},{"start":{"row":83,"column":0},"end":{"row":83,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":83,"column":4},"end":{"row":90,"column":5},"action":"insert","lines":["$subjectEmail = stripslashes(trim($pc));","    if (preg_match ('%^[A-za-z0-9\\.\\' \\-!_&@.$~]{3,30}$%', $subjectEmail)) {","        $email = escape_data(null,$subjectEmail);","    } else {","        $passedRegex = FALSE;","        header(\"Location: newCompanyForm.php?em\");","        exit();","    }"],"id":67}],[{"start":{"row":83,"column":38},"end":{"row":83,"column":41},"action":"remove","lines":["$pc"],"id":68},{"start":{"row":83,"column":38},"end":{"row":83,"column":41},"action":"insert","lines":["$cn"]}],[{"start":{"row":45,"column":19},"end":{"row":45,"column":20},"action":"remove","lines":["e"],"id":69},{"start":{"row":45,"column":18},"end":{"row":45,"column":19},"action":"remove","lines":["m"]},{"start":{"row":45,"column":17},"end":{"row":45,"column":18},"action":"remove","lines":["a"]},{"start":{"row":45,"column":16},"end":{"row":45,"column":17},"action":"remove","lines":["n"]},{"start":{"row":45,"column":15},"end":{"row":45,"column":16},"action":"remove","lines":["r"]},{"start":{"row":45,"column":14},"end":{"row":45,"column":15},"action":"remove","lines":["e"]},{"start":{"row":45,"column":13},"end":{"row":45,"column":14},"action":"remove","lines":["s"]},{"start":{"row":45,"column":12},"end":{"row":45,"column":13},"action":"remove","lines":["U"]}],[{"start":{"row":45,"column":12},"end":{"row":45,"column":13},"action":"insert","lines":["C"],"id":70},{"start":{"row":45,"column":13},"end":{"row":45,"column":14},"action":"insert","lines":["o"]},{"start":{"row":45,"column":14},"end":{"row":45,"column":15},"action":"insert","lines":["n"]},{"start":{"row":45,"column":15},"end":{"row":45,"column":16},"action":"insert","lines":["u"]}],[{"start":{"row":45,"column":15},"end":{"row":45,"column":16},"action":"remove","lines":["u"],"id":71},{"start":{"row":45,"column":14},"end":{"row":45,"column":15},"action":"remove","lines":["n"]}],[{"start":{"row":45,"column":14},"end":{"row":45,"column":15},"action":"insert","lines":["u"],"id":72},{"start":{"row":45,"column":15},"end":{"row":45,"column":16},"action":"insert","lines":["n"]},{"start":{"row":45,"column":16},"end":{"row":45,"column":17},"action":"insert","lines":["t"]},{"start":{"row":45,"column":17},"end":{"row":45,"column":18},"action":"insert","lines":["r"]},{"start":{"row":45,"column":18},"end":{"row":45,"column":19},"action":"insert","lines":["y"]}],[{"start":{"row":46,"column":53},"end":{"row":46,"column":69},"action":"remove","lines":["$subjectUsername"],"id":73},{"start":{"row":46,"column":53},"end":{"row":46,"column":68},"action":"insert","lines":["$subjectCountry"]}],[{"start":{"row":47,"column":37},"end":{"row":47,"column":53},"action":"remove","lines":["$subjectUsername"],"id":74},{"start":{"row":47,"column":37},"end":{"row":47,"column":52},"action":"insert","lines":["$subjectCountry"]}],[{"start":{"row":47,"column":8},"end":{"row":47,"column":17},"action":"remove","lines":["$username"],"id":75},{"start":{"row":47,"column":8},"end":{"row":47,"column":9},"action":"insert","lines":["$"]}],[{"start":{"row":47,"column":9},"end":{"row":47,"column":10},"action":"insert","lines":["c"],"id":76},{"start":{"row":47,"column":10},"end":{"row":47,"column":11},"action":"insert","lines":["l"]},{"start":{"row":47,"column":11},"end":{"row":47,"column":12},"action":"insert","lines":["e"]},{"start":{"row":47,"column":12},"end":{"row":47,"column":13},"action":"insert","lines":["a"]},{"start":{"row":47,"column":13},"end":{"row":47,"column":14},"action":"insert","lines":["n"]},{"start":{"row":47,"column":14},"end":{"row":47,"column":15},"action":"insert","lines":["e"]},{"start":{"row":47,"column":15},"end":{"row":47,"column":16},"action":"insert","lines":["d"]}],[{"start":{"row":47,"column":16},"end":{"row":47,"column":23},"action":"insert","lines":["Country"],"id":77}],[{"start":{"row":47,"column":23},"end":{"row":47,"column":24},"action":"insert","lines":["f"],"id":78},{"start":{"row":47,"column":24},"end":{"row":47,"column":25},"action":"insert","lines":["r"]},{"start":{"row":47,"column":25},"end":{"row":47,"column":26},"action":"insert","lines":["o"]},{"start":{"row":47,"column":26},"end":{"row":47,"column":27},"action":"insert","lines":["F"]},{"start":{"row":47,"column":27},"end":{"row":47,"column":28},"action":"insert","lines":["o"]}],[{"start":{"row":47,"column":28},"end":{"row":47,"column":29},"action":"insert","lines":["r"],"id":79},{"start":{"row":47,"column":29},"end":{"row":47,"column":30},"action":"insert","lines":["m"]}],[{"start":{"row":56,"column":13},"end":{"row":56,"column":20},"action":"remove","lines":["assword"],"id":80},{"start":{"row":56,"column":12},"end":{"row":56,"column":13},"action":"remove","lines":["P"]}],[{"start":{"row":56,"column":12},"end":{"row":56,"column":13},"action":"insert","lines":["D"],"id":81},{"start":{"row":56,"column":13},"end":{"row":56,"column":14},"action":"insert","lines":["r"]},{"start":{"row":56,"column":14},"end":{"row":56,"column":15},"action":"insert","lines":["r"]}],[{"start":{"row":56,"column":14},"end":{"row":56,"column":15},"action":"remove","lines":["r"],"id":82},{"start":{"row":56,"column":13},"end":{"row":56,"column":14},"action":"remove","lines":["r"]},{"start":{"row":56,"column":12},"end":{"row":56,"column":13},"action":"remove","lines":["D"]}],[{"start":{"row":56,"column":12},"end":{"row":56,"column":13},"action":"insert","lines":["a"],"id":83},{"start":{"row":56,"column":13},"end":{"row":56,"column":14},"action":"insert","lines":["D"]},{"start":{"row":56,"column":14},"end":{"row":56,"column":15},"action":"insert","lines":["D"]}],[{"start":{"row":56,"column":14},"end":{"row":56,"column":15},"action":"remove","lines":["D"],"id":84},{"start":{"row":56,"column":13},"end":{"row":56,"column":14},"action":"remove","lines":["D"]}],[{"start":{"row":56,"column":13},"end":{"row":56,"column":14},"action":"insert","lines":["d"],"id":85},{"start":{"row":56,"column":14},"end":{"row":56,"column":15},"action":"insert","lines":["d"]},{"start":{"row":56,"column":15},"end":{"row":56,"column":16},"action":"insert","lines":["r"]},{"start":{"row":56,"column":16},"end":{"row":56,"column":17},"action":"insert","lines":["e"]},{"start":{"row":56,"column":17},"end":{"row":56,"column":18},"action":"insert","lines":["s"]},{"start":{"row":56,"column":18},"end":{"row":56,"column":19},"action":"insert","lines":["s"]}],[{"start":{"row":56,"column":12},"end":{"row":56,"column":13},"action":"remove","lines":["a"],"id":86}],[{"start":{"row":56,"column":12},"end":{"row":56,"column":13},"action":"insert","lines":["A"],"id":87}],[{"start":{"row":57,"column":58},"end":{"row":57,"column":74},"action":"remove","lines":["$subjectPassword"],"id":88},{"start":{"row":57,"column":58},"end":{"row":57,"column":73},"action":"insert","lines":["$subjectAddress"]}],[{"start":{"row":58,"column":37},"end":{"row":58,"column":53},"action":"remove","lines":["$subjectPassword"],"id":89},{"start":{"row":58,"column":37},"end":{"row":58,"column":52},"action":"insert","lines":["$subjectAddress"]}],[{"start":{"row":58,"column":8},"end":{"row":58,"column":17},"action":"remove","lines":["$password"],"id":90},{"start":{"row":58,"column":8},"end":{"row":58,"column":30},"action":"insert","lines":["$cleanedCountryfroForm"]}],[{"start":{"row":58,"column":29},"end":{"row":58,"column":30},"action":"remove","lines":["m"],"id":91},{"start":{"row":58,"column":28},"end":{"row":58,"column":29},"action":"remove","lines":["r"]},{"start":{"row":58,"column":27},"end":{"row":58,"column":28},"action":"remove","lines":["o"]},{"start":{"row":58,"column":26},"end":{"row":58,"column":27},"action":"remove","lines":["F"]}],[{"start":{"row":58,"column":26},"end":{"row":58,"column":27},"action":"insert","lines":["A"],"id":92},{"start":{"row":58,"column":27},"end":{"row":58,"column":28},"action":"insert","lines":["d"]},{"start":{"row":58,"column":28},"end":{"row":58,"column":29},"action":"insert","lines":["d"]},{"start":{"row":58,"column":29},"end":{"row":58,"column":30},"action":"insert","lines":["r"]},{"start":{"row":58,"column":30},"end":{"row":58,"column":31},"action":"insert","lines":["e"]},{"start":{"row":58,"column":31},"end":{"row":58,"column":32},"action":"insert","lines":["s"]},{"start":{"row":58,"column":32},"end":{"row":58,"column":33},"action":"insert","lines":["s"]}],[{"start":{"row":39,"column":0},"end":{"row":43,"column":5},"action":"remove","lines":["    ","    if($pw != $pwm){","       header(\"Location: newCompanyForm.php?pw\");","       exit();","    }"],"id":93},{"start":{"row":38,"column":5},"end":{"row":39,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":47,"column":46},"end":{"row":47,"column":47},"action":"remove","lines":["n"],"id":94},{"start":{"row":47,"column":45},"end":{"row":47,"column":46},"action":"remove","lines":["u"]}],[{"start":{"row":47,"column":45},"end":{"row":47,"column":46},"action":"insert","lines":["c"],"id":95},{"start":{"row":47,"column":46},"end":{"row":47,"column":47},"action":"insert","lines":["n"]}],[{"start":{"row":56,"column":46},"end":{"row":56,"column":47},"action":"remove","lines":["w"],"id":96},{"start":{"row":56,"column":45},"end":{"row":56,"column":46},"action":"remove","lines":["p"]}],[{"start":{"row":56,"column":45},"end":{"row":56,"column":46},"action":"insert","lines":["a"],"id":97},{"start":{"row":56,"column":46},"end":{"row":56,"column":47},"action":"insert","lines":["d"]}],[{"start":{"row":60,"column":4},"end":{"row":60,"column":21},"action":"remove","lines":["$subjectPasswordm"],"id":98},{"start":{"row":60,"column":4},"end":{"row":60,"column":19},"action":"insert","lines":["$subjectAddress"]}],[{"start":{"row":60,"column":19},"end":{"row":60,"column":20},"action":"insert","lines":["2"],"id":99}],[{"start":{"row":61,"column":58},"end":{"row":61,"column":75},"action":"remove","lines":["$subjectPasswordm"],"id":100},{"start":{"row":61,"column":58},"end":{"row":61,"column":74},"action":"insert","lines":["$subjectAddress2"]}],[{"start":{"row":62,"column":38},"end":{"row":62,"column":55},"action":"remove","lines":["$subjectPasswordm"],"id":101},{"start":{"row":62,"column":38},"end":{"row":62,"column":54},"action":"insert","lines":["$subjectAddress2"]}],[{"start":{"row":62,"column":8},"end":{"row":62,"column":18},"action":"remove","lines":["$passwordm"],"id":102},{"start":{"row":62,"column":8},"end":{"row":62,"column":33},"action":"insert","lines":["$cleanedCountryfroAddress"]}],[{"start":{"row":62,"column":32},"end":{"row":62,"column":33},"action":"remove","lines":["s"],"id":103},{"start":{"row":62,"column":31},"end":{"row":62,"column":32},"action":"remove","lines":["s"]},{"start":{"row":62,"column":30},"end":{"row":62,"column":31},"action":"remove","lines":["e"]},{"start":{"row":62,"column":29},"end":{"row":62,"column":30},"action":"remove","lines":["r"]},{"start":{"row":62,"column":28},"end":{"row":62,"column":29},"action":"remove","lines":["d"]},{"start":{"row":62,"column":27},"end":{"row":62,"column":28},"action":"remove","lines":["d"]},{"start":{"row":62,"column":26},"end":{"row":62,"column":27},"action":"remove","lines":["A"]}],[{"start":{"row":53,"column":26},"end":{"row":53,"column":27},"action":"insert","lines":["m"],"id":104}],[{"start":{"row":42,"column":26},"end":{"row":42,"column":27},"action":"insert","lines":["m"],"id":105}],[{"start":{"row":53,"column":8},"end":{"row":53,"column":34},"action":"remove","lines":["$cleanedCountryfromAddress"],"id":106},{"start":{"row":53,"column":8},"end":{"row":53,"column":31},"action":"insert","lines":["$cleanedCountryfromForm"]}],[{"start":{"row":53,"column":22},"end":{"row":53,"column":23},"action":"remove","lines":["y"],"id":107},{"start":{"row":53,"column":21},"end":{"row":53,"column":22},"action":"remove","lines":["r"]},{"start":{"row":53,"column":20},"end":{"row":53,"column":21},"action":"remove","lines":["t"]},{"start":{"row":53,"column":19},"end":{"row":53,"column":20},"action":"remove","lines":["n"]},{"start":{"row":53,"column":18},"end":{"row":53,"column":19},"action":"remove","lines":["u"]},{"start":{"row":53,"column":17},"end":{"row":53,"column":18},"action":"remove","lines":["o"]},{"start":{"row":53,"column":16},"end":{"row":53,"column":17},"action":"remove","lines":["C"]}],[{"start":{"row":53,"column":16},"end":{"row":53,"column":17},"action":"insert","lines":["A"],"id":108},{"start":{"row":53,"column":17},"end":{"row":53,"column":18},"action":"insert","lines":["d"]},{"start":{"row":53,"column":18},"end":{"row":53,"column":19},"action":"insert","lines":["d"]},{"start":{"row":53,"column":19},"end":{"row":53,"column":20},"action":"insert","lines":["r"]},{"start":{"row":53,"column":20},"end":{"row":53,"column":21},"action":"insert","lines":["e"]},{"start":{"row":53,"column":21},"end":{"row":53,"column":22},"action":"insert","lines":["s"]},{"start":{"row":53,"column":22},"end":{"row":53,"column":23},"action":"insert","lines":["s"]}],[{"start":{"row":62,"column":8},"end":{"row":62,"column":26},"action":"remove","lines":["$cleanedCountryfro"],"id":109},{"start":{"row":62,"column":8},"end":{"row":62,"column":31},"action":"insert","lines":["$cleanedAddressfromForm"]}],[{"start":{"row":62,"column":23},"end":{"row":62,"column":24},"action":"insert","lines":["2"],"id":110}],[{"start":{"row":69,"column":16},"end":{"row":69,"column":17},"action":"remove","lines":["l"],"id":111},{"start":{"row":69,"column":15},"end":{"row":69,"column":16},"action":"remove","lines":["i"]},{"start":{"row":69,"column":14},"end":{"row":69,"column":15},"action":"remove","lines":["a"]},{"start":{"row":69,"column":13},"end":{"row":69,"column":14},"action":"remove","lines":["m"]},{"start":{"row":69,"column":12},"end":{"row":69,"column":13},"action":"remove","lines":["E"]}],[{"start":{"row":69,"column":12},"end":{"row":69,"column":13},"action":"insert","lines":["P"],"id":112},{"start":{"row":69,"column":13},"end":{"row":69,"column":14},"action":"insert","lines":["o"]},{"start":{"row":69,"column":14},"end":{"row":69,"column":15},"action":"insert","lines":["a"]},{"start":{"row":69,"column":15},"end":{"row":69,"column":16},"action":"insert","lines":["s"]},{"start":{"row":69,"column":16},"end":{"row":69,"column":17},"action":"insert","lines":["t"]},{"start":{"row":69,"column":17},"end":{"row":69,"column":18},"action":"insert","lines":["c"]},{"start":{"row":69,"column":18},"end":{"row":69,"column":19},"action":"insert","lines":["o"]},{"start":{"row":69,"column":19},"end":{"row":69,"column":20},"action":"insert","lines":["d"]},{"start":{"row":69,"column":20},"end":{"row":69,"column":21},"action":"insert","lines":["e"]}],[{"start":{"row":69,"column":14},"end":{"row":69,"column":15},"action":"remove","lines":["a"],"id":113}],[{"start":{"row":70,"column":59},"end":{"row":70,"column":72},"action":"remove","lines":["$subjectEmail"],"id":114},{"start":{"row":70,"column":59},"end":{"row":70,"column":75},"action":"insert","lines":["$subjectPostcode"]}],[{"start":{"row":71,"column":34},"end":{"row":71,"column":47},"action":"remove","lines":["$subjectEmail"],"id":115},{"start":{"row":71,"column":34},"end":{"row":71,"column":50},"action":"insert","lines":["$subjectPostcode"]}],[{"start":{"row":71,"column":8},"end":{"row":71,"column":14},"action":"remove","lines":["$email"],"id":116},{"start":{"row":71,"column":8},"end":{"row":71,"column":32},"action":"insert","lines":["$cleanedAddress2fromForm"]}],[{"start":{"row":71,"column":23},"end":{"row":71,"column":24},"action":"remove","lines":["2"],"id":117},{"start":{"row":71,"column":22},"end":{"row":71,"column":23},"action":"remove","lines":["s"]},{"start":{"row":71,"column":21},"end":{"row":71,"column":22},"action":"remove","lines":["s"]},{"start":{"row":71,"column":20},"end":{"row":71,"column":21},"action":"remove","lines":["e"]},{"start":{"row":71,"column":19},"end":{"row":71,"column":20},"action":"remove","lines":["r"]},{"start":{"row":71,"column":18},"end":{"row":71,"column":19},"action":"remove","lines":["d"]},{"start":{"row":71,"column":17},"end":{"row":71,"column":18},"action":"remove","lines":["d"]},{"start":{"row":71,"column":16},"end":{"row":71,"column":17},"action":"remove","lines":["A"]}],[{"start":{"row":71,"column":16},"end":{"row":71,"column":17},"action":"insert","lines":["P"],"id":118},{"start":{"row":71,"column":17},"end":{"row":71,"column":18},"action":"insert","lines":["o"]},{"start":{"row":71,"column":18},"end":{"row":71,"column":19},"action":"insert","lines":["a"]},{"start":{"row":71,"column":19},"end":{"row":71,"column":20},"action":"insert","lines":["s"]},{"start":{"row":71,"column":20},"end":{"row":71,"column":21},"action":"insert","lines":["t"]},{"start":{"row":71,"column":21},"end":{"row":71,"column":22},"action":"insert","lines":["c"]},{"start":{"row":71,"column":22},"end":{"row":71,"column":23},"action":"insert","lines":["o"]},{"start":{"row":71,"column":23},"end":{"row":71,"column":24},"action":"insert","lines":["d"]},{"start":{"row":71,"column":24},"end":{"row":71,"column":25},"action":"insert","lines":["e"]}],[{"start":{"row":65,"column":46},"end":{"row":65,"column":47},"action":"remove","lines":["w"],"id":119},{"start":{"row":65,"column":45},"end":{"row":65,"column":46},"action":"remove","lines":["p"]}],[{"start":{"row":65,"column":45},"end":{"row":65,"column":46},"action":"insert","lines":["a"],"id":120},{"start":{"row":65,"column":46},"end":{"row":65,"column":47},"action":"insert","lines":["d"]},{"start":{"row":65,"column":47},"end":{"row":65,"column":48},"action":"insert","lines":["2"]}],[{"start":{"row":74,"column":46},"end":{"row":74,"column":47},"action":"remove","lines":["m"],"id":121},{"start":{"row":74,"column":45},"end":{"row":74,"column":46},"action":"remove","lines":["e"]}],[{"start":{"row":74,"column":45},"end":{"row":74,"column":46},"action":"insert","lines":["o"],"id":122}],[{"start":{"row":74,"column":45},"end":{"row":74,"column":46},"action":"remove","lines":["o"],"id":123}],[{"start":{"row":74,"column":45},"end":{"row":74,"column":46},"action":"insert","lines":["p"],"id":124},{"start":{"row":74,"column":46},"end":{"row":74,"column":47},"action":"insert","lines":["c"]}],[{"start":{"row":78,"column":12},"end":{"row":78,"column":17},"action":"remove","lines":["Email"],"id":125},{"start":{"row":78,"column":12},"end":{"row":78,"column":19},"action":"insert","lines":["country"]}],[{"start":{"row":78,"column":12},"end":{"row":78,"column":13},"action":"remove","lines":["c"],"id":126}],[{"start":{"row":78,"column":12},"end":{"row":78,"column":13},"action":"insert","lines":["C"],"id":127}],[{"start":{"row":79,"column":59},"end":{"row":79,"column":72},"action":"remove","lines":["$subjectEmail"],"id":128},{"start":{"row":79,"column":59},"end":{"row":79,"column":74},"action":"insert","lines":["$subjectCountry"]}],[{"start":{"row":80,"column":34},"end":{"row":80,"column":47},"action":"remove","lines":["$subjectEmail"],"id":129},{"start":{"row":80,"column":34},"end":{"row":80,"column":49},"action":"insert","lines":["$subjectCountry"]}],[{"start":{"row":80,"column":8},"end":{"row":80,"column":14},"action":"remove","lines":["$email"],"id":130},{"start":{"row":80,"column":8},"end":{"row":80,"column":33},"action":"insert","lines":["$cleanedPoastcodefromForm"]}],[{"start":{"row":80,"column":24},"end":{"row":80,"column":25},"action":"remove","lines":["e"],"id":131},{"start":{"row":80,"column":23},"end":{"row":80,"column":24},"action":"remove","lines":["d"]},{"start":{"row":80,"column":22},"end":{"row":80,"column":23},"action":"remove","lines":["o"]},{"start":{"row":80,"column":21},"end":{"row":80,"column":22},"action":"remove","lines":["c"]},{"start":{"row":80,"column":20},"end":{"row":80,"column":21},"action":"remove","lines":["t"]},{"start":{"row":80,"column":19},"end":{"row":80,"column":20},"action":"remove","lines":["s"]},{"start":{"row":80,"column":18},"end":{"row":80,"column":19},"action":"remove","lines":["a"]},{"start":{"row":80,"column":17},"end":{"row":80,"column":18},"action":"remove","lines":["o"]},{"start":{"row":80,"column":16},"end":{"row":80,"column":17},"action":"remove","lines":["P"]}],[{"start":{"row":80,"column":16},"end":{"row":80,"column":17},"action":"insert","lines":["C"],"id":132},{"start":{"row":80,"column":17},"end":{"row":80,"column":18},"action":"insert","lines":["o"]},{"start":{"row":80,"column":18},"end":{"row":80,"column":19},"action":"insert","lines":["u"]},{"start":{"row":80,"column":19},"end":{"row":80,"column":20},"action":"insert","lines":["n"]},{"start":{"row":80,"column":20},"end":{"row":80,"column":21},"action":"insert","lines":["t"]},{"start":{"row":80,"column":21},"end":{"row":80,"column":22},"action":"insert","lines":["r"]},{"start":{"row":80,"column":22},"end":{"row":80,"column":23},"action":"insert","lines":["y"]}],[{"start":{"row":83,"column":46},"end":{"row":83,"column":47},"action":"remove","lines":["m"],"id":133},{"start":{"row":83,"column":45},"end":{"row":83,"column":46},"action":"remove","lines":["e"]}],[{"start":{"row":83,"column":45},"end":{"row":83,"column":46},"action":"insert","lines":["c"],"id":134},{"start":{"row":83,"column":46},"end":{"row":83,"column":47},"action":"insert","lines":["n"]}],[{"start":{"row":28,"column":6},"end":{"row":28,"column":7},"action":"insert","lines":["U"],"id":135},{"start":{"row":28,"column":7},"end":{"row":28,"column":8},"action":"insert","lines":["N"]},{"start":{"row":28,"column":8},"end":{"row":28,"column":9},"action":"insert","lines":["t"]}],[{"start":{"row":28,"column":8},"end":{"row":28,"column":9},"action":"remove","lines":["t"],"id":136}],[{"start":{"row":28,"column":8},"end":{"row":28,"column":9},"action":"insert","lines":["T"],"id":137},{"start":{"row":28,"column":9},"end":{"row":28,"column":10},"action":"insert","lines":["R"]},{"start":{"row":28,"column":10},"end":{"row":28,"column":11},"action":"insert","lines":["U"]},{"start":{"row":28,"column":11},"end":{"row":28,"column":12},"action":"insert","lines":["S"]},{"start":{"row":28,"column":12},"end":{"row":28,"column":13},"action":"insert","lines":["T"]},{"start":{"row":28,"column":13},"end":{"row":28,"column":14},"action":"insert","lines":["E"]},{"start":{"row":28,"column":14},"end":{"row":28,"column":15},"action":"insert","lines":["D"]}],[{"start":{"row":34,"column":13},"end":{"row":34,"column":16},"action":"remove","lines":["$cn"],"id":138},{"start":{"row":34,"column":13},"end":{"row":34,"column":25},"action":"insert","lines":["$UNTRUSTEDcn"]}],[{"start":{"row":40,"column":40},"end":{"row":40,"column":43},"action":"remove","lines":["$cn"],"id":139},{"start":{"row":40,"column":40},"end":{"row":40,"column":52},"action":"insert","lines":["$UNTRUSTEDcn"]}],[{"start":{"row":29,"column":6},"end":{"row":29,"column":7},"action":"insert","lines":["U"],"id":140},{"start":{"row":29,"column":7},"end":{"row":29,"column":8},"action":"insert","lines":["N"]},{"start":{"row":29,"column":8},"end":{"row":29,"column":9},"action":"insert","lines":["T"]},{"start":{"row":29,"column":9},"end":{"row":29,"column":10},"action":"insert","lines":["R"]},{"start":{"row":29,"column":10},"end":{"row":29,"column":11},"action":"insert","lines":["U"]},{"start":{"row":29,"column":11},"end":{"row":29,"column":12},"action":"insert","lines":["S"]},{"start":{"row":29,"column":12},"end":{"row":29,"column":13},"action":"insert","lines":["T"]},{"start":{"row":29,"column":13},"end":{"row":29,"column":14},"action":"insert","lines":["E"]},{"start":{"row":29,"column":14},"end":{"row":29,"column":15},"action":"insert","lines":["D"]}],[{"start":{"row":30,"column":6},"end":{"row":30,"column":7},"action":"insert","lines":["U"],"id":141},{"start":{"row":30,"column":7},"end":{"row":30,"column":8},"action":"insert","lines":["N"]},{"start":{"row":30,"column":8},"end":{"row":30,"column":9},"action":"insert","lines":["T"]},{"start":{"row":30,"column":9},"end":{"row":30,"column":10},"action":"insert","lines":["R"]},{"start":{"row":30,"column":10},"end":{"row":30,"column":11},"action":"insert","lines":["U"]},{"start":{"row":30,"column":11},"end":{"row":30,"column":12},"action":"insert","lines":["S"]}],[{"start":{"row":30,"column":12},"end":{"row":30,"column":13},"action":"insert","lines":["T"],"id":142},{"start":{"row":30,"column":13},"end":{"row":30,"column":14},"action":"insert","lines":["E"]},{"start":{"row":30,"column":14},"end":{"row":30,"column":15},"action":"insert","lines":["D"]}],[{"start":{"row":28,"column":15},"end":{"row":28,"column":16},"action":"insert","lines":["_"],"id":143}],[{"start":{"row":29,"column":6},"end":{"row":29,"column":15},"action":"remove","lines":["UNTRUSTED"],"id":144},{"start":{"row":29,"column":6},"end":{"row":29,"column":16},"action":"insert","lines":["UNTRUSTED_"]}],[{"start":{"row":30,"column":6},"end":{"row":30,"column":15},"action":"remove","lines":["UNTRUSTED"],"id":145},{"start":{"row":30,"column":6},"end":{"row":30,"column":16},"action":"insert","lines":["UNTRUSTED_"]}],[{"start":{"row":31,"column":6},"end":{"row":31,"column":16},"action":"insert","lines":["UNTRUSTED_"],"id":146}],[{"start":{"row":32,"column":6},"end":{"row":32,"column":16},"action":"insert","lines":["UNTRUSTED_"],"id":147}],[{"start":{"row":51,"column":40},"end":{"row":51,"column":43},"action":"remove","lines":["$ad"],"id":148},{"start":{"row":51,"column":40},"end":{"row":51,"column":53},"action":"insert","lines":["$UNTRUSTED_ad"]}],[{"start":{"row":60,"column":41},"end":{"row":60,"column":45},"action":"remove","lines":["$ad2"],"id":149},{"start":{"row":60,"column":41},"end":{"row":60,"column":55},"action":"insert","lines":["$UNTRUSTED_ad2"]}],[{"start":{"row":69,"column":41},"end":{"row":69,"column":44},"action":"remove","lines":["$pc"],"id":150},{"start":{"row":69,"column":41},"end":{"row":69,"column":54},"action":"insert","lines":["$UNTRUSTED_pc"]}],[{"start":{"row":78,"column":40},"end":{"row":78,"column":43},"action":"remove","lines":["$cn"],"id":151},{"start":{"row":78,"column":40},"end":{"row":78,"column":53},"action":"insert","lines":["$UNTRUSTED_cn"]}],[{"start":{"row":92,"column":20},"end":{"row":93,"column":0},"action":"insert","lines":["",""],"id":152},{"start":{"row":93,"column":0},"end":{"row":93,"column":7},"action":"insert","lines":["       "]},{"start":{"row":93,"column":7},"end":{"row":94,"column":0},"action":"insert","lines":["",""]},{"start":{"row":94,"column":0},"end":{"row":94,"column":7},"action":"insert","lines":["       "]}]]},"ace":{"folds":[],"scrolltop":94.5,"scrollleft":0,"selection":{"start":{"row":20,"column":24},"end":{"row":20,"column":24},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":5,"state":"php-comment","mode":"ace/mode/php"}},"timestamp":1523134793003,"hash":"42e55ae9e6ed812f3c9e82f67773c6641bc748cf"}