<!DOCTYPE html>
<html>

<head>
    <title>Client Report</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .no-image {
            font-style: italic;
            color: #888;
        }

        img.client-image {
            max-width: 50px;
            max-height: 50px;
            vertical-align: middle;
        }

        .d-none {
            display: none;
        }

        .legal-text {
            font-style: italic;
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
        }

        @media screen and (max-width: 767px) {

            /* Hide some columns on smaller screens */
            .d-md-table-cell {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Client Report</h1>
        <p class="legal-text">This document is for official use only.</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>D.O.B</th>
                <th>Details</th>
                <th>Status</th>
                <th>Relevant Dates</th>
                <th>Case Description</th>
                <th>Notes</th>
                <th class="d-none d-md-table-cell">Created at</th>
                <th class="d-none d-md-table-cell">Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->contact_info }}</td>
                <td>{{ $client->date_of_birth }}</td>
                <td>{{ $client->case_details }}</td>
                <td>{{ $client->case_status }}</td>
                <td>{{ $client->relevant_dates }}</td>
                <td>{{ $client->case_description }}</td>
                <td>{{ $client->notes }}</td>

                <td class="d-none d-md-table-cell">{{ $client->created_at }}</td>
                <td class="d-none d-md-table-cell">{{ $client->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>&copy; {{ date('Y') }} Legal Associates. All rights reserved.</p>
    </div>
</body>

</html>