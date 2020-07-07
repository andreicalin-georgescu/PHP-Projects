<?

namespace Todo\Interact;
require '../../vendor/autoload.php';

use Todo\TaskManager;
use Todo\Models\Task;

if (!isset($_POST['deleteTask']) || !isset($_POST['taskId'])) {
	return false;
}

$manager = TaskManager::getInstance();

$manager->deleteTask($_POST['taskId']);

header('Location: /index.php');
