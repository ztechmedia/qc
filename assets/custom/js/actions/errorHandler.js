const errorHandler = (errors) => {
	$.each(errors, function (key, value) {
		console.log(key, value);
		$(`#${key}-error`).html(value);
	});
};
