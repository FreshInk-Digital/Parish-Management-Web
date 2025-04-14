
import jQuery from "jquery";
import jszip from 'jszip';
import pdfmake from 'pdfmake';
import DataTable from 'datatables.net-bs4';
import 'datatables.net-autofill-bs4';
import 'datatables.net-buttons-bs4';
import 'datatables.net-buttons/js/buttons.colVis.mjs';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-buttons/js/buttons.print.mjs';
import 'datatables.net-colreorder-bs4';
import 'datatables.net-keytable-bs4';
import 'datatables.net-responsive-bs4';
import 'datatables.net-rowgroup-bs4';
import 'datatables.net-rowreorder-bs4';
import 'datatables.net-scroller-bs4';
import 'datatables.net-searchbuilder-bs4';
import 'datatables.net-searchpanes-bs4';
import 'datatables.net-select-bs4';
import 'datatables.net-staterestore-bs4';

DataTable.Buttons.jszip(jszip);
DataTable.Buttons.pdfMake(pdfmake);
