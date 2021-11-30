<?php

function captureScreenshot($url)
{
  $api_key = "YOUR_API_KEY";
  $request = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$url}&key=" . $api_key;
  $hit = file_get_contents($request);
  $json = json_decode($hit);

  return $json;
}

if (isset($_POST["submit"])) {
  $url = $_POST["url"];
  $response = captureScreenshot($url);
  $image = $response->lighthouseResult->audits->{'full-page-screenshot'}->details->screenshot->data;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />

  <title>Capture Screenshot using PHP</title>
</head>

<body class="bg-gray-200 min-h-screen p-5 flex justify-center items-center">
  <div class="container">
    <div class="lg:w-5/12 bg-white mx-auto rounded-lg shadow-lg" style="padding: 2rem">
      <h1 class="font-bold mb-3" style="font-size: 1.7rem">
        Capture Screenshot from URL
      </h1>
      <form action="" method="POST">
        <div class="relative">
          <label for="footer-field" class="leading-7 text-sm text-gray-600">
            Enter Website URL
          </label>
          <div class="flex justify-between items-center w-full">
            <input type="text" id="footer-field" name="url" class="
                  w-full
                  bg-gray-100 bg-opacity-50
                  rounded
                  border border-gray-300
                  focus:bg-transparent
                  focus:ring-2
                  focus:ring-blue-200
                  focus:border-blue-500
                  text-base
                  outline-none
                  text-gray-700
                  py-1
                  px-3
                  leading-8
                  transition-colors
                  duration-200
                  ease-in-out
                  mr-3
                " />
            <button type="submit" name="submit" class="
                  flex-shrink-0
                  inline-flex
                  text-white
                  bg-blue-500
                  border-0
                  py-2
                  px-6
                  focus:outline-none
                  hover:bg-blue-600
                  rounded
                  transition
                  duration-300
                ">
              Capture
            </button>
          </div>
        </div>
      </form>
      <?php if (isset($image)) { ?>
        <div class="max-h-96 h-auto w-full overflow-auto mt-5 border">
          <img src="<?php echo $image; ?>" alt="" />
        </div>
        <a href="<?php echo $image; ?>" download="screenshot" class="
            flex-shrink-0
            inline-flex
            text-white
            hover:bg-blue-500
            border-2 border-blue-500
            text-blue-500
            hover:text-white
            py-2
            px-6
            focus:outline-none
            hover:bg-blue-600
            rounded
            mt-3
            transition
            duration-300
          ">
          Download
        </a>
      <?php } ?>
    </div>
  </div>
</body>

</html>