<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Tasks Report</title>

    <style>

        body{

            font-family: DejaVu Sans, sans-serif;

            font-size: 12px;

            color:#333;

        }

        h2{

            text-align:center;

            margin-bottom:5px;

        }

        p{

            text-align:center;

            margin-top:0;

            margin-bottom:15px;

            font-size:11px;

        }

        table{

            width:100%;

            border-collapse:collapse;

        }

        th{

            background:#f3f4f6;

            border:1px solid #000;

            padding:8px;

            text-align:left;

        }

        td{

            border:1px solid #000;

            padding:8px;

        }

        .text-center{

            text-align:center;

        }

        .footer{

            position:fixed;

            bottom:-20px;

            left:0;

            right:0;

            text-align:center;

            font-size:10px;

            color:#666;

        }

    </style>

</head>

<body>

    <h2>Task Management Report</h2>

    <p>

        Generated On :
        {{ now()->format('d-m-Y h:i A') }}

    </p>

    <table>

        <thead>

            <tr>

                <th>#</th>

                <th>Task Code</th>

                <th>Title</th>

                <th>Assigned To</th>

                <th>Priority</th>

                <th>Status</th>

                <th>Start Date</th>

                <th>Due Date</th>

            </tr>

        </thead>

        <tbody>

            @forelse($tasks as $task)

                <tr>

                    <td class="text-center">

                        {{ $loop->iteration }}

                    </td>

                    <td>

                        {{ $task->task_code }}

                    </td>

                    <td>

                        {{ $task->title }}

                    </td>

                    <td>

                        {{ $task->assigned_to }}

                    </td>

                    <td>

                        {{ $task->priority }}

                    </td>

                    <td>

                        {{ $task->status }}

                    </td>

                    <td>

                        {{ optional($task->start_date)->format('d-m-Y') }}

                    </td>

                    <td>

                        {{ optional($task->due_date)->format('d-m-Y') }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center">

                        No Tasks Found

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="footer">

        Laravel AI CRM Pro |
        Task Management Report |
        Page {PAGE_NUM} of {PAGE_COUNT}

    </div>

</body>

</html>