<?php
//More symbols at http://symbolcodes.tlt.psu.edu/bylanguage/mathchart.html
global $_Symbol,$_Symbol_untested, $Letters, $_SYMBOL_FONT_MAP;

$_Symbol = array(
  61472 => '2248',
  61508 => '394',//
  61523 => '2211',//sumatorio de
  61537 => '3B1',
  61538 => '1D66',//beta
  61543 => '3B3',
  61548 => '3BB',//lambda
  61552 => '3C0',//pi
  61555 => '3C3',//sigma
  61601 => '211d',//real numbers. http://symbolcodes.tlt.psu.edu/bylanguage/mathchart.html
  61602 => '2032',//'
  61603 => '2264',//http://www.fileformat.info/info/unicode/char/2264/charset_support.htm
  61605 => '221E',//infinite
  61613 => '2191 ',
  61614 => '2192',//http://xahlee.info/comp/unicode_arrows.html
  61618 => '2033',
  61619 => '2265',
  61625 => '2260',
  61627 => '336',
  61629 => '07C',
  61630 => '036',
  61639 => '22C2',
  61640 => '222A',//union
  61646 => '2208',//pertenece a
  61671 => '2223',
  61690 => '2223',
  61485 => '2212',//menos
  61501 => '03D',//equal
  61483 => '02B',//plus
  61569 => '2460',//circled 1
  61570 => '2461',//circled 2
  61571 => '2462',//circled 3
  61572 => '2463',//circled 4
  61573 => '2464',//circled 5
  61574 => '2465',//circled 6
  61575 => '2466',//circled 7
  61576 => '2467',//circled 8
  61577 => '2468',//circled 9
  61578 => '2469'//circled 10

);

$Letters = array(
  'q' => '3B8'
);

$_Symbol_untested = array(
  61472 => '020',
  61473 => '021',
  61474 => '022',
  61475 => '023',
  61476 => '024',
  61477 => '025',
  61478 => '026',
  61479 => '027',
  61480 => '028',
  61481 => '029',
  61482 => '02A',
  61484 => '02C',
  61486 => '02E',
  61487 => '02F',
  61488 => '030',
  61489 => '031',
  61490 => '032',
  61491 => '033',
  61492 => '034',
  61493 => '035',
  61494 => '036',
  61495 => '037',
  61496 => '038',
  61497 => '039',
  61498 => '03A',
  61499 => '03B',
  61500 => '03C',
  61502 => '03E',
  61503 => '03F',
  61504 => '040',
  61505 => '041',
  61506 => '042',
  61507 => '043',
  61508 => '394',//
  61509 => '045',
  61510 => '046',
  61511 => '047',
  61512 => '048',
  61513 => '049',
  61514 => '04A',
  61515 => '04B',
  61516 => '04C',
  61517 => '04D',
  61518 => '04E',
  61519 => '04F',
  61520 => '050',
  61521 => '051',
  61522 => '052',
  61523 => '2211',//sumatorio de
  61524 => '054',
  61525 => '055',
  61526 => '056',
  61527 => '057',
  61528 => '058',
  61529 => '059',
  61530 => '05A',
  61531 => '05B',
  61532 => '05C',
  61533 => '05D',
  61534 => '05E',
  61535 => '05F',
  61536 => '060',
  61537 => '03B1',
  61538 => '1D66',//beta
  61539 => '063',
  61540 => '064',
  61541 => '065',
  61542 => '066',
  61543 => '3B3',
  61544 => '068',
  61545 => '069',
  61546 => '06A',
  61547 => '06B',
  61548 => '3BB',//lambda
  61549 => '06D',
  61550 => '06E',
  61551 => '06F',
  61552 => '3C0',//pi
  61553 => '071',
  61554 => '072',
  61555 => '3C3',//sigma
  61556 => '074',
  61557 => '075',
  61558 => '076',
  61559 => '077',
  61560 => '078',
  61561 => '079',
  61562 => '07A',
  61563 => '07B',
  61564 => '07C',
  61565 => '07D',
  61566 => '07E',
  61601 => '211d',//real numbers. http://symbolcodes.tlt.psu.edu/bylanguage/mathchart.html
  61602 => '2032',//'
  61603 => '2264',//http://www.fileformat.info/info/unicode/char/2264/charset_support.htm
  61604 => '0A4',
  61605 => '221E',//infinite
  61606 => '0A6',
  61607 => '0A7',
  61608 => '0A8',
  61609 => '0A9',
  61610 => '0AA',
  61611 => '0AB',
  61612 => '0AC',
  61613 => '0AD',
  61614 => '2192',//http://xahlee.info/comp/unicode_arrows.html
  61615 => '0AF',
  61616 => '0B0',
  61617 => '0B1',
  61618 => '0B2',
  61619 => '0B3',
  61620 => '0B4',
  61621 => '0B5',
  61622 => '0B6',
  61623 => '0B7',
  61624 => '0B8',
  61625 => '0B9',
  61626 => '0BA',
  61627 => '0BB',
  61628 => '0BC',
  61629 => '07C',
  61630 => '0BE',
  61631 => '0BF',
  61632 => '0C0',
  61633 => '0C1',
  61634 => '0C2',
  61635 => '0C3',
  61636 => '0C4',
  61637 => '0C5',
  61638 => '0C6',
  61639 => '22C2',
  61640 => '222A',//union
  61641 => '0C9',
  61642 => '0CA',
  61643 => '0CB',
  61644 => '0CC',
  61645 => '0CD',
  61646 => '2208',//pertenece a
  61647 => '0CF',
  61648 => '0D0',
  61649 => '0D1',
  61650 => '0D2',
  61651 => '0D3',
  61652 => '0D4',
  61653 => '0D5',
  61654 => '0D6',
  61655 => '0D7',
  61656 => '0D8',
  61657 => '0D9',
  61658 => '0DA',
  61659 => '0DB',
  61660 => '0DC',
  61661 => '0DD',
  61662 => '0DE',
  61663 => '0DF',
  61664 => '0E0',
  61665 => '0E1',
  61666 => '0E2',
  61667 => '0E3',
  61668 => '0E4',
  61669 => '0E5',
  61670 => '0E6',
  61671 => '0E7',
  61672 => '0E8',
  61673 => '0E9',
  61674 => '0EA',
  61675 => '0EB',
  61676 => '0EC',
  61677 => '0ED',
  61678 => '0EE',
  61679 => '0EF',
  61681 => '0F1',
  61682 => '0F2',
  61683 => '0F3',
  61684 => '0F4',
  61685 => '0F5',
  61686 => '0F6',
  61687 => '0F7',
  61688 => '0F8',
  61689 => '0F9',
  61690 => '0FA',
  61691 => '0FB',
  61692 => '0FC',
  61693 => '0FD',
  61694 => '0FE'
);

static $_SYMBOL_FONT_MAP = array (
  15696032 => "#32",
  15696033 => "#33",
  15696034 => "#8704",
  15696035 => "#35",
  15696036 => "#8707",
  15696037 => "#37",
  15696038 => "#38",
  15696039 => "#8715",
  15696040 => "#40",
  15696041 => "#41",
  15696042 => "#8727",
  15696043 => "#43",
  15696044 => "#44",
  15696045 => "#8722",
  15696046 => "#46",
  15696047 => "#47",
  15696048 => "#48",
  15696049 => "#49",
  15696050 => "#50",
  15696051 => "#51",
  15696052 => "#52",
  15696053 => "#53",
  15696054 => "#54",
  15696055 => "#55",
  15696056 => "#56",
  15696057 => "#57",
  15696058 => "#58",
  15696059 => "#59",
  15696060 => "#60",
  15696061 => "#61",
  15696062 => "#62",
  15696063 => "#63",
  15696256 => "#8773",
  15696257 => "#913",
  15696258 => "#914",
  15696259 => "#935",
  15696260 => "#916",
  15696261 => "#917",
  15696262 => "#934",
  15696263 => "#915",
  15696264 => "#919",
  15696265 => "#921",
  15696266 => "#977",
  15696267 => "#922",
  15696268 => "#923",
  15696269 => "#924",
  15696270 => "#925",
  15696271 => "#927",
  15696272 => "#928",
  15696273 => "#920",
  15696274 => "#929",
  15696275 => "#931",
  15696276 => "#932",
  15696277 => "#933",
  15696278 => "#962",
  15696279 => "#937",
  15696280 => "#926",
  15696281 => "#936",
  15696282 => "#918",
  15696283 => "#91",
  15696284 => "#8756",
  15696285 => "#93",
  15696286 => "#8869",
  15696287 => "#95",
  15696288 => "#63717",
  15696289 => "#945",
  15696290 => "#946",
  15696291 => "#967",
  15696292 => "#948",
  15696293 => "#949",
  15696294 => "#966",
  15696295 => "#947",
  15696296 => "#951",
  15696297 => "#953",
  15696298 => "#981",
  15696299 => "#954",
  15696300 => "#955",
  15696301 => "#956",
  15696302 => "#957",
  15696303 => "#959",
  15696304 => "#960",
  15696305 => "#952",
  15696306 => "#961",
  15696307 => "#963",
  15696308 => "#964",
  15696309 => "#965",
  15696310 => "#982",
  15696311 => "#969",
  15696312 => "#958",
  15696313 => "#968",
  15696314 => "#950",
  15696315 => "#123",
  15696316 => "#124",
  15696317 => "#125",
  15696318 => "#8764",
  15696544 => "#8364",
  15696545 => "#978",
  15696546 => "#8242",
  15696547 => "#8804",
  15696548 => "#8260",
  15696549 => "#8734",
  15696550 => "#402",
  15696551 => "#9827",
  15696552 => "#9830",
  15696553 => "#9829",
  15696554 => "#9824",
  15696555 => "#8596",
  15696556 => "#8592",
  15696557 => "#8593",
  15696558 => "#8594",
  15696559 => "#8595",
  15696560 => "#176",
  15696561 => "#177",
  15696562 => "#8243",
  15696563 => "#8805",
  15696564 => "#215",
  15696565 => "#8733",
  15696566 => "#8706",
  15696567 => "#8226",
  15696568 => "#247",
  15696569 => "#8800",
  15696570 => "#8801",
  15696571 => "#8776",
  15696572 => "#8230",
  15696573 => "#63718",
  15696574 => "#63719",
  15696575 => "#8629",
  15696768 => "#8501",
  15696769 => "#8465",
  15696770 => "#8476",
  15696771 => "#8472",
  15696772 => "#8855",
  15696773 => "#8853",
  15696774 => "#8709",
  15696775 => "#8745",
  15696776 => "#8746",
  15696777 => "#8835",
  15696778 => "#8839",
  15696779 => "#8836",
  15696780 => "#8834",
  15696781 => "#8838",
  15696782 => "#8712",
  15696783 => "#8713",
  15696784 => "#8736",
  15696785 => "#8711",
  15696786 => "#63194",
  15696787 => "#63193",
  15696788 => "#63195",
  15696789 => "#8719",
  15696790 => "#8730",
  15696791 => "#8901",
  15696792 => "#172",
  15696793 => "#8743",
  15696794 => "#8744",
  15696795 => "#8660",
  15696796 => "#8656",
  15696797 => "#8657",
  15696798 => "#8658",
  15696799 => "#8659",
  15696800 => "#9674",
  15696801 => "#9001",
  15696802 => "#63720",
  15696803 => "#63721",
  15696804 => "#63722",
  15696805 => "#8721",
  15696806 => "#63723",
  15696807 => "#63724",
  15696808 => "#63725",
  15696809 => "#63726",
  15696810 => "#63727",
  15696811 => "#63728",
  15696812 => "#63729",
  15696813 => "#63730",
  15696814 => "#63731",
  15696815 => "#63732",
  15696817 => "#9002",
  15696818 => "#8747",
  15696819 => "#8992",
  15696820 => "#63733",
  15696821 => "#8993",
  15696822 => "#63734",
  15696823 => "#63735",
  15696824 => "#63736",
  15696825 => "#63737",
  15696826 => "#63738",
  15696827 => "#63739",
  15696828 => "#63740",
  15696829 => "#63741",
  15696830 => "#63742",
  29 => "#41",
  36 => "exist",
  38 => "amp",
  39 => "ni",
  42 => "lowast",
  45 => "minus",
  60 => "lt",
  62 => "gt",
  64 => "cong",
  65 => "Alpha",
  66 => "Beta",
  67 => "Chi",
  68 => "Delta",
  69 => "Epsilon",
  70 => "Phi",
  71 => "Gamma",
  72 => "Eta",
  73 => "Iota",
  74 => "thetasym",
  75 => "Kappa",
  76 => "Lambda",
  77 => "Mu",
  78 => "Nu",
  79 => "Omicron",
  80 => "Pi",
  81 => "Theta",
  82 => "Rho",
  83 => "Sigma",
  84 => "Tau",
  85 => "Upsilon",
  86 => "sigmaf",
  87 => "Omega",
  88 => "Xi",
  89 => "Psi",
  90 => "Zeta",
  92 => "there4",
  94 => "perp",
  97 => "alpha",
  98 => "beta",
  99 => "chi",
  100 => "delta",
  101 => "epsilon",
  102 => "phi",
  103 => "gamma",
  104 => "eta",
  105 => "iota",
  106 => "&#x3d5;",
  107 => "kappa",
  108 => "lambda",
  109 => "mu",
  110 => "nu",
  111 => "omicron",
  112 => "pi",
  113 => "theta",
  114 => "rho",
  115 => "sigma",
  116 => "tau",
  117 => "upsilon",
  118 => "piv",
  119 => "omega",
  120 => "xi",
  121 => "psi",
  122 => "zeta",
  126 => "sim",
  160 => "euro",
  161 => "upsih",
  162 => "prime",
  163 => "le",
  164 => "frasl",
  165 => "infin",
  166 => "fnof",
  167 => "clubs",
  168 => "diams",
  169 => "hearts",
  170 => "spades",
  171 => "harr",
  172 => "larr",
  173 => "uarr",
  174 => "rarr",
  175 => "darr",
  176 => "deg",
  177 => "plusmn",
  178 => "Prime",
  179 => "ge",
  180 => "times",
  181 => "prop",
  182 => "part",
  183 => "bull",
  184 => "divide",
  185 => "ne",
  186 => "equiv",
  187 => "asymp",
  188 => "hellip",
  191 => "crarr",
  192 => "alefsym",
  193 => "image",
  194 => "real",
  195 => "weierp",
  196 => "otimes",
  197 => "oplus",
  198 => "empty",
  199 => "cap",
  200 => "cup",
  201 => "sup",
  202 => "supe",
  203 => "nsub",
  204 => "sub",
  205 => "sube",
  206 => "isin",
  207 => "notin",
  208 => "ang",
  209 => "nabla",
  210 => "reg",
  211 => "copy",
  212 => "trade",
  213 => "prod",
  214 => "radic",
  215 => "sdot",
  216 => "not",
  217 => "and",
  218 => "or",
  219 => "hArr",
  220 => "lArr",
  221 => "uArr",
  222 => "rArr",
  223 => "dArr",
  224 => "loz",
  225 => "lang",
  229 => "sum",
  241 => "rang",
  242 => "int",
);

?>
