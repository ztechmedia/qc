const datatables = (element, url, csrfTokenName, getCsrfHash, columns) => {
  $(element).DataTable({
    processing: false,
    serverSide: true,
    ajax: {
      url: url,
      dataType: "json",
      type: "POST",
      data: {
        csrfTokenName: getCsrfHash,
      },
    },
    columns: columns,
  });
};
