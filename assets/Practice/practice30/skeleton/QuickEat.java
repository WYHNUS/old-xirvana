// This program helps staff manage customers'
// orders and decide who should be given a ready dish.

import java.util.*;

// This class represents all orders of customers
class ListOrder {
    
    // Data member
    private int numDishes;
    // All dishes which the restaurant offers
    private String[] dishes;
    // Each dish has a queue of customers who ordered this dish
	// All such queues are put inside an ArrayList called dishQueues
    private ArrayList<Queue<Integer>> dishQueues;
    
    // Constructor
    public ListOrder(int numDishes, Scanner sc) {
        
    }
    
    // Add new order to the list
    public void addNewOrder(int dishID, int tag) {
        
    }
    
    // Process food when it is ready
    // Return the customer who currently ordered for the dish
    // if there is no customer order for this dish return -1
    public int processReadyFood(int dishID) {

        return 0; // stub
    }

    // Get dish's name
    public String getDishName(int dishID) {

		return ""; // stub
    }

}

public class QuickEat {

    public static void main(String [] args) {
        
        Scanner sc = new Scanner(System.in);
        int numDishes = sc.nextInt();
        sc.nextLine();
        
        // Create the list order of food
        ListOrder listOrder = new ListOrder(numDishes, sc);
        
        int noOfCommands = sc.nextInt();
        sc.nextLine();
        
        // Process commands


    }
}

