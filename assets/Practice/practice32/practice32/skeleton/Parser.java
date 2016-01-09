/*  
 * CS1020 (AY2012/3 Sem2)  
 * Sit-in Lab #3 Noon session
 * Author    :   
 * Matric no.:   
 * Lab group : 
 * Description of program:   
 */ 

import java.util.*;

class ListNode <E> {  /* data attributes */  
  private E element;  
  private ListNode <E> next;
  
  /* constructors */  
  public ListNode(E item) { this(item, null); }
  public ListNode(E item, ListNode <E> n) { element = item; next = n; }

  /* get the next ListNode */  
  public ListNode <E> getNext() { return next; }
  
  /* get the element of the ListNode */  
  public E getElement() { return element; }
  
  /* set the next reference */  
  public void setNext(ListNode <E> n) { next = n; } 
}

class LinkedList <E> {  
  private ListNode <E> head = null;  

  public boolean isEmpty() { return (head == null); }
  
  public int size() { return num_nodes; }
}

/* Parser for the markup language */
public class Parser {
  public Parser(Scanner sc) {}

  public static void main(String[] args) {         
    Scanner sc = new Scanner(System.in);     
    Parser bc = new Parser(sc);

  }
}
