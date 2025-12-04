// import * as XLSX from 'xlsx';

const table = document.getElementById('dash-activity');
const exportBtnDash = document.getElementById('export-btn');
const weekreport = document.getElementById('content');
const shareBtn = document.getElementById('share-report-btn');
// const printnowheader = document.getElementById('print-nav');
let printnow = document.getElementById('print-now');
const heading = document.getElementById('heading');
let printbtn = document.getElementById('print-button');
exportBtnDash.addEventListener('click',()=>{
	const wbu = XLSX.utils.table_to_book(table,{sheet: "Sheet1"});
	XLSX.writeFile(wbu,"data.xlsx");
});

window.addEventListener('offline',()=>{
	let status_ = document.getElementById('status-messages');
	status_.textContent	= "You are offline";	
},false);

window.addEventListener('online',()=>{
	let status_ = document.getElementById('status-messages');
	status_.textContent	= "Online";	
},false);

printnow.addEventListener('click',(e)=>{
  e.preventDefault();
  window.print();
},false);