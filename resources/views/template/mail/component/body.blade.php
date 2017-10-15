<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{$title_page}}</title>
</head>
<body style="margin: 0;font-size:16px;">
  <div style="width: 100%;margin: 0;">
    <div style="display: block;text-align: center;margin: 0;box-sizing: border-box;height: 100px;padding-top: 30px;background: #82B141;color: #fff;text-shadow: 3px 2px #78777C;">
      <span style="font-weight: 600;font-size: 3em;">HR-</span><span style="font-weight: 600;font-size: 1.8em;">Manpower</span>
    </div>
    <div style="display: block;text-align: center;margin: 0;box-sizing: border-box;height: auto;padding: 20px;color: #78777C;">
      <span style="font-size: 1.4em;text-decoration: underline #82B141 solid;font-weight: 600;">{{$head}}</span>
      {{$slot}}
    </div>
    <div style="display: block;text-align: center;margin: 0;box-sizing: border-box;height: 80px;padding-top: 30px;background: #78777C;color: #fff;">
      <b>Do Day Dream Public Company Limited</b>
    </div>
  </div>
</body>
