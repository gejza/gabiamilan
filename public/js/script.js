
function setvisible(imgid,vis)
{
	$.ajax({
		type: "POST",
			url: "/svatba/gallery/vis",
			data: {visible: vis, image: imgid }
			});
}