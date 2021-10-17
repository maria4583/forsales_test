$(document).ready(function () {
    // Define UI variables
    const reportTableBody  = $('#report-table tbody')
    const reportForm = $('#report-form')

    const BASE_URL = 'http://localhost'

    // Format date to YYYY-MM-DD
    const formatDate = date => {
        return new Date(date).toISOString().split('T')[0]
    }

    reportForm.submit(function (e) {
        e.preventDefault()

        // Clear previous data in table body
        reportTableBody.empty()

        // Get data from form and format dates
        const startDate = formatDate(reportForm.find('input[name="start_date"]').val())
        const endDate = formatDate(reportForm.find('input[name="end_date"]').val())
        const clientType = reportForm.find(':selected').val()

        // Generate url for sending
        let url = BASE_URL + `/api/report?start_date=${startDate}&end_date=${endDate}`
        if (clientType !== 'none') {
            url += `&client_type=${clientType}`
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                if (response.length) {
                    response.forEach(item => {
                        reportTableBody.append(`<tr>
                                <th>${item.service_name}</th>
                                <td>${item.start_balance}</td>
                                <td>${item.receipt}</td>
                                <td>${item.expense}</td>
                                <td>${item.recalculate}</td>
                                <td>${item.end_balance}</td>
                            </tr>
                        `);
                    })
                    return true
                }
                reportTableBody.html(
                    `<tr>
                        <td colspan="6" align="center">Нет данных за этот период.</td>
                    </tr>`
                )
            }
        })
    })
})