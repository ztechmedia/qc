const formValidation = (className, redirect = null, target = null) => {
	if ($("form[id^='validate']").length > 0) {
		// Validation prefix for custom form elements
		var prefix = "valPref_";

		//Add prefix to Bootstrap select plugin
		$("form[id^='validate'] .select").each(function () {
			$(this)
				.next("div.bootstrap-select")
				.attr("id", prefix + $(this).attr("id"))
				.removeClass("validate[required]");
		});

		// Validation Engine init
		$("form[id^='validate']").validationEngine("attach", {
			promptPosition: "bottomLeft",
			scroll: false,
			onValidationComplete: function (form, status) {
				if (status) {
					submitHandler(className);
					setTimeout(() => {
						if (redirect) {
							if (target) {
								loadContent(redirect, target);
							} else {
								loadContent(redirect, ".content");
							}
						}
					}, 1000);
				}
			},
			prettySelect: true,
			usePrefix: prefix,
		});
	}
};

const formSelect = (target = ".select") => {
	if ($(target).length > 0) {
		$(target).selectpicker();

		$(target).on("change", function () {
			if ($(this).val() == "" || null === $(this).val()) {
				if (!$(this).attr("multiple"))
					$(this)
						.val("")
						.find("option")
						.removeAttr("selected")
						.prop("selected", false);
			} else {
				$(this)
					.find("option[value=" + $(this).val() + "]")
					.attr("selected", true);
			}
		});
	}
};

const checkNestedSelect = (target, url, empty, value) => {
	reqJson(url, "GET", {}, (err, response) => {
		let options = `<option value="">${empty}</option>`;
		if (response) {
			response.map((res) => {
				if (res.id === value) {
					options =
						options + `<option selected value="${res.id}">${res.name}</option>`;
				} else {
					options = options + `<option value="${res.id}">${res.name}</option>`;
				}
			});

			$(target).html(options);
		}
	});
};

const toRp = (target) => {
	$(target).maskMoney({
		prefix: "Rp. ",
		allowNegative: false,
		thousands: ".",
		decimal: ",",
		precision: 0,
	});
};
