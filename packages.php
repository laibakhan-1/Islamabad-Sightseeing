<?php
include('php/config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tour Packages - Islamabad Sightseeing</title>
  <style>
  body {
    background: linear-gradient(135deg, #e0f4ff 0%, #f9fcff 100%);
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #0d47a1;
    min-height: 100vh;
  }

  nav {
    background-color: #1565c0;
    padding: 0 32px;
    display: flex;
    align-items: center;
    height: 64px;
    box-shadow: 0 6px 18px rgba(21, 101, 192, 0.3);
    max-width: 1200px;
    margin: 24px auto 0 auto;
    border-radius: 14px;
    user-select: none;
    flex-wrap: wrap;
  }

  nav .brand {
    font-weight: 800;
    font-size: 1.75rem;
    color: #fff;
    flex-shrink: 0;
    letter-spacing: 1.2px;
  }

  nav .user-area {
    margin-left: auto;
    color: #bbdefb;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 20px;
  }

  nav .user-area span {
    font-weight: 600;
    color: #cfd8dc;
  }

  nav .user-area a {
    background-color: #0d47a1;
    color: #fff;
    padding: 8px 20px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(13, 71, 161, 0.5);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }

  nav .user-area a:hover {
    background-color: #0a3570;
    box-shadow: 0 6px 20px rgba(10, 53, 112, 0.7);
  }

  main.container {
    max-width: 1200px;
    margin: 50px auto 80px auto;
    padding: 0 24px;
  }

  h2.page-title {
    text-align: center;
    font-size: 3rem;
    font-weight: 900;
    margin-bottom: 50px;
    color: #0d47a1;
    letter-spacing: 1.5px;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
  }

  .packages-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 32px;
    justify-content: center;
  }

  .package-card {
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(21, 101, 192, 0.15);
    padding: 28px 32px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
  }

  .package-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 35px rgba(21, 101, 192, 0.3);
  }

  .package-card h5 {
    margin: 0;
    font-size: 1.6rem;
    font-weight: 800;
    color: #0d47a1;
    letter-spacing: 0.03em;
  }

  .package-card p {
    margin: 0;
    font-size: 1.1rem;
    color: #0d47a1dd;
    flex-grow: 1;
    line-height: 1.5;
  }

  .package-card strong {
    color: #1565c0;
    font-weight: 700;
    font-size: 1.15rem;
  }

  .package-card label {
    font-weight: 700;
    margin-bottom: 8px;
    color: #0d47a1;
    display: block;
    font-size: 1rem;
  }

  .package-card input[type="number"] {
    width: 100%;
    padding: 10px 14px;
    border-radius: 10px;
    border: 2px solid #1976d2;
    background-color: #e3f2fd;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
    outline-offset: 2px;
  }

  .package-card input[type="number"]:focus {
    border-color: #0d47a1;
    background-color: #d0e5ff;
  }

  .package-card button,
  .package-card .book-link {
    margin-top: 18px;
    width: 100%;
    background-color: #1976d2;
    color: white;
    border: none;
    padding: 14px 0;
    font-weight: 700;
    font-size: 1.15rem;
    border-radius: 12px;
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
    text-decoration: none;
    display: block;
    box-shadow: 0 5px 15px rgba(25, 118, 210, 0.4);
    user-select: none;
  }

  .package-card button:hover,
  .package-card .book-link:hover {
    background-color: #0d47a1;
    box-shadow: 0 8px 25px rgba(13, 71, 161, 0.6);
  }

  @media (max-width: 900px) {
    nav {
      padding: 12px 20px;
      height: auto;
    }
    nav .user-area {
      margin-left: 0;
      margin-top: 10px;
      width: 100%;
      justify-content: flex-end;
    }
    main.container {
      margin: 30px 15px 60px;
      padding: 0 12px;
    }
    h2.page-title {
      font-size: 2.4rem;
      margin-bottom: 30px;
    }
    .package-card {
      padding: 24px 28px;
    }
    .package-card button,
    .package-card .book-link {
      font-size: 1rem;
      padding: 12px 0;
    }
  }
</style>
</head>
<body>
  <nav>
    <div class="brand">Islamabad Sightseeing</div>
    <div class="user-area">
  <a href="index.html" class="btn-home">Home</a>
  <?php if (isset($_SESSION['username'])): ?>
    <span>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
    <a href="php/logout.php">Logout</a>
  <?php else: ?>
    <a href="php/login.php">Login</a>
  <?php endif; ?>
</div>

  </nav>

  <main class="container">
    <h2 class="page-title">Available Tour Packages</h2>
    <div class="packages-row">
      <?php
      // PDO query execution
      $stmt = $pdo->query("SELECT * FROM packages");
      $packages = $stmt->fetchAll();

      foreach ($packages as $row):
      ?>
      <div class="package-card">
        <h5><?php echo htmlspecialchars($row['title']); ?></h5>
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <p><strong>Price:</strong> Rs <?php echo number_format($row['price']); ?> / person</p>
        <form action="php/book_tour.php" method="POST">
          <input type="hidden" name="package_id" value="<?php echo $row['id']; ?>">
          <label for="people_<?php echo $row['id']; ?>">Number of People:</label>
          <input id="people_<?php echo $row['id']; ?>" type="number" name="people" min="1" required>
          <?php if (isset($_SESSION['username'])): ?>
            <button type="submit">Book Now</button>
          <?php else: ?>
            <a href="php/login.php" class="book-link">Book Now</a>
          <?php endif; ?>
        </form>
      </div>
      <?php endforeach; ?>
    </div>
  </main>
</body>
</html>
