const reqJson = (url, method, data, callback) => {
	$.ajax({
		url: url,
		type: method,
		dataType: "json",
		contentType: "appliation/json; charset=utf-8",
		data: JSON.stringify(data),
		success: (response) => callback(null, response),
		error: (err) => callback(true, err),
	});
};

const reqFormData = (url, method, data, callback) => {
	$.ajax({
		url: url,
		type: method,
		data: data,
		processData: false,
		contentType: false,
		success: (response) => callback(null, response),
		error: (err) => callback(true, err),
	});
};

const deletePhoto = (id, url) => {
	$.ajax({
		type: "post",
		data: {
			id: id,
		},
		url: url,
		cache: false,
		dataType: "json",
		success: function () {
			console.log("Foto terhapus");
		},
		error: function () {
			console.log("Error");
		},
	});
};
