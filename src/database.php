<?php
/**
 * Class DB
 * wrapper do opreacji bazodanowych
 */
class DB
{
    /**
     * @var string|null
     */
    private $stmt = null;
    /**
     * @var PDO|null
     */
    private $pdo = null;

    /**
     * DB constructor.
     */
    function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=localhost;dbname=recipe_app;charset=utf8",
                "recipe", "password", [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    /**
     *
     */
    function __destruct()
    {
        if ($this->stmt !== null) {
            $this->stmt = null;
        }
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }

    /**
     * @param string $sql
     * @param string|null $cond
     * @return array
     */
    function select($sql, $cond = null)
    {
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($cond);
            $result = $this->stmt->fetchAll();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        $this->stmt = null;
        return $result;
    }

    /**
     * @param string $sql
     * @param string|null $cond
     */
    function insert($sql, $cond = null)
    {
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($cond);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        $this->stmt = null;
    }

    /**
     * @param integer $id
     * @param string $recipeName
     * Zhardkodowany kod sql żeby dopuścić tylko usuwanie przepisów
     */
    function delete($id, $recipeName)
    {
        $sql = "DELETE FROM recipe WHERE userID = ? AND recipeName = ?";
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute(array($id, $recipeName));
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        $this->stmt = null;
    }
}

?>
