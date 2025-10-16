// import * as XLSX from 'xlsx';

const table = document.getElementById('dash-activity');
const exportBtnDash = document.getElementById('export-btn');
const weekreport = document.getElementById('content');
const shareBtn = document.getElementById('share-report-btn');

exportBtnDash.addEventListener('click',()=>{
	const wbu = XLSX.utils.table_to_book(table,{sheet: "Sheet1"});
	XLSX.writeFile(wbu,"data.xlsx");
});

// shareBtn.addEventListener('click', ()=>{
// 	let week = 'theday';
// 	let filename = 'report.pdf';
// 	let docuname = week + filename;
// 	const doc = new jsPDF();
// 	doc.html(content, {
// 		callback: function(doc){
// 			doc.save(docuname); 
// 		}
// 	});
// });