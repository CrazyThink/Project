#coding:utf-8
# search.py
# ---------
# Licensing Information:  You are free to use or extend these projects for
# educational purposes provided that (1) you do not distribute or publish
# solutions, (2) you retain this notice, and (3) you provide clear
# attribution to UC Berkeley, including a link to http://ai.berkeley.edu.
#
# Attribution Information: The Pacman AI projects were developed at UC Berkeley.
# The core projects and autograders were primarily created by John DeNero
# (denero@cs.berkeley.edu) and Dan Klein (klein@cs.berkeley.edu).
# Student side autograding was added by Brad Miller, Nick Hay, and
# Pieter Abbeel (pabbeel@cs.berkeley.edu).


"""
In search.py, you will implement generic search algorithms which are called by
Pacman agents (in searchAgents.py).
"""

import util

class SearchProblem:
    """
    This class outlines the structure of a search problem, but doesn't implement
    any of the methods (in object-oriented terminology: an abstract class).

    You do not need to change anything in this class, ever.
    """

    def getStartState(self):
        """
        Returns the start state for the search problem.
        """
        util.raiseNotDefined()

    def isGoalState(self, state):
        """
          state: Search state

        Returns True if and only if the state is a valid goal state.
        """
        util.raiseNotDefined()

    def getSuccessors(self, state):
        """
          state: Search state

        For a given state, this should return a list of triples, (successor,
        action, stepCost), where 'successor' is a successor to the current
        state, 'action' is the action required to get there, and 'stepCost' is
        the incremental cost of expanding to that successor.
        """
        util.raiseNotDefined()

    def getCostOfActions(self, actions):
        """
         actions: A list of actions to take

        This method returns the total cost of a particular sequence of actions.
        The sequence must be composed of legal moves.
        """
        util.raiseNotDefined()


def tinyMazeSearch(problem):
    """
    Returns a sequence of moves that solves tinyMaze.  For any other maze, the
    sequence of moves will be incorrect, so only use this for tinyMaze.
    """
    from game import Directions
    s = Directions.SOUTH
    w = Directions.WEST
    return  [s, s, w, s, w, w, s, w]

def depthFirstSearch(problem):
    """
    Search the deepest nodes in the search tree first.

    Your search algorithm needs to return a list of actions that reaches the
    goal. Make sure to implement a graph search algorithm.

    To get started, you might want to try some of these simple commands to
    understand the search problem that is being passed in:

    print "Start:", problem.getStartState()
    print "Is the start a goal?", problem.isGoalState(problem.getStartState())
    print "Start's successors:", problem.getSuccessors(problem.getStartState())
    """
    "*** YOUR CODE HERE ***"
    # 현재 problem 에서 StartState를 찾아서 저장한다.
    startstate = problem.getStartState()
    # Depth First Search 는 Last In First Out(LIFO) 를 사용하기 때문에 Stack을 사용하면 편리하다.
    fringe = util.Stack()
    # Stack 에 시작 state와 빈 리스트[]를 하나의 item으로 하여 넣는다.
    fringe.push((startstate, []))
    # visited 는 어떠한 state에 도달하기 까지 방문한 state들을 전부 저장해 놓는 리스트이다.
    visited = []
    # Stack 이 비어 있을때 까지 반복문을 돌린다.
    while not fringe.isEmpty():
        # Stack 에서 가장 나중에 넣은 item을 꺼내어 정보를 저장한다.
        node, direction = fringe.pop()
        # node를 방문한 노드 리스트에 저장한다.
        visited.append(node)
        # node 가 미로의 끝인지를 확인한다.
        if problem.isGoalState(node):
            # 만약 node 가 미로의 끝이 맞다면 start state 부터 여기까지 도달하기 위한 움직임을 return 한다.
            return direction
        # getSuccessors 하는 함수는 successor, action, stepcost 를 반환하는 함수이다.
        # successor 는 다음에 이동할 수 있는 state를 의미한다.
        # action 은 현재 state 에서 다음 state 로 이동하려면 어느 방향으로 이동해야 하는지를 의미한다.
        # stepcost는 다음 state 까지 이동하는 데 소요되는 비용을 의미한다.
        for successor, action, stepcost in problem.getSuccessors(node):
            # 다음 state 가 이전에 방문한 적이 있는지를 검사한다.
            if not successor in visited:
                # 다음 state와 그 state까지 도달하기 위한 움직임을 하나의 item 으로 묶어서 Stack에 넣는다.
                fringe.push((successor, direction + [action]))
    # 만약 Stack이 비었는데 return을 하지 않았다면 미로를 끝낼수 있는 방법이 없는 것 이므로 빈 리스트를 return 한다.
    return []


def breadthFirstSearch(problem):
    """Search the shallowest nodes in the search tree first."""
    "*** YOUR CODE HERE ***"
    # 현재 problem 에서 StartState를 찾아서 저장한다.
    startstate = problem.getStartState()
    # Breadth First Search 는 First In First Out(FIFO) 를 사용하기 때문에 Queue를 사용하면 편리하다.
    fringe = util.Queue()
    # Queue 에 시작 state와 빈 리스트[]를 하나의 item으로 하여 넣는다.
    fringe.push((startstate, []))
    # visited 는 어떠한 state에 도달하기 까지 방문한 state들을 전부 저장해 놓는 리스트이다.
    visited = []
    # Queue가 비어 있을때 까지 반복문을 돌린다.
    while not fringe.isEmpty():
        # Queue에서 가장 처음에 넣은 item을 꺼내어 정보를 저장한다.
        node, direction = fringe.pop()
        # node 가 미로의 끝인지를 확인한다.
        if problem.isGoalState(node):
            # 만약 node 가 미로의 끝이 맞다면 start state 부터 여기까지 도달하기 위한 움직임을 return 한다.
            return direction
        # getSuccessors 하는 함수는 successor, action, stepcost 를 반환하는 함수이다.
        # successor 는 다음에 이동할 수 있는 state를 의미한다.
        # action 은 현재 state 에서 다음 state 로 이동하려면 어느 방향으로 이동해야 하는지를 의미한다.
        # stepcost는 다음 state 까지 이동하는 데 소요되는 비용을 의미한다.
        for successor, action, stepcost in problem.getSuccessors(node):
            # 다음 state 가 이전에 방문한 적이 있는지를 검사한다.
            if not successor in visited:
                # 다음 state와 그 state까지 도달하기 위한 움직임을 하나의 item 으로 묶어서 Queue에 넣는다.
                fringe.push((successor, direction + [action]))
                # 다음 state를 방문한 노드 리스트에 저장한다.
                visited.append(successor)
        # 맨 처음 방문한 node가 방문한 노드 리스트에 저장되지 않았으므로 이를 위해서 코드를 추가한다.
        visited.append(node)
    # 만약 Queue가 비었는데 return을 하지 않았다면 미로를 끝낼수 있는 방법이 없는 것 이므로 빈 리스트를 return 한다.
    return []

def uniformCostSearch(problem):
    """Search the node of least total cost first."""
    "*** YOUR CODE HERE ***"
    # 현재 problem 에서 StartState를 찾아서 저장한다.
    startstate = problem.getStartState()
    # Uniform Cost Search 는 비용을 비교해서 사용하기 때문에 Priority Queue를 사용하면 편리하다.
    fringe = util.PriorityQueue()
    # Priority Queue 에 시작 state와 이동한 방향을 넣을 빈 리스트[], 비용을 하나의 item으로 구조에 맞게 cost도 넣는다.
    fringe.push((startstate, [], 0), 0)
    # visited 는 어떠한 state에 도달하기 까지 방문한 state들과 해당 state까지 도달하기 까지의 최소비용을 저장할 구조체이다.
    visited = dict()
    # Priority Queue가 비어 있을때 까지 반복문을 돌린다.
    while not fringe.isEmpty():
        # Priority Queue에서 가장 처음에 넣은 item을 꺼내어 정보를 저장한다.
        node, direction, cost = fringe.pop()
        # 맨 처음 방문한 node 와 비용을 방문한 리스트에 저장한다.
        visited[node] = cost
        # node 가 미로의 끝인지를 확인한다.
        if problem.isGoalState(node):
            # 만약 node 가 미로의 끝이 맞다면 start state 부터 여기까지 도달하기 위한 움직임을 return 한다.
            return direction
        # getSuccessors 하는 함수는 successor, action, stepcost 를 반환하는 함수이다.
        # successor 는 다음에 이동할 수 있는 state를 의미한다.
        # action 은 현재 state 에서 다음 state 로 이동하려면 어느 방향으로 이동해야 하는지를 의미한다.
        # stepcost는 다음 state 까지 이동하는 데 소요되는 비용을 의미한다.
        for successor, action, stepcost in problem.getSuccessors(node):
            # 다음 state 가 이전에 방문한 적이 없거나, 방문한 적이 있지만 저장해 놓은 최소비용이 새로운 비용보다 큰지 검사한다.
            if (successor not in visited) or (successor in visited and visited[successor] > cost + stepcost):
                # 다음 state와 그 state까지 도달하기 위한 최소비용을 방문한 노드 리스트에 저장한다.
                visited[successor] = cost + stepcost
                # 다음 state와 그 state까지 도달하기 위한 움직임, 도달하기 까지 비용을 하나의 item 으로 묶고 비용과 함께 Priority Queue에 넣는다.
                fringe.push((successor, direction + [action], cost + stepcost), cost + stepcost)
    # 만약 Queue가 비었는데 return을 하지 않았다면 미로를 끝낼수 있는 방법이 없는 것 이므로 빈 리스트를 return 한다.
    return []

def nullHeuristic(state, problem=None):
    """
    A heuristic function estimates the cost from the current state to the nearest
    goal in the provided SearchProblem.  This heuristic is trivial.
    """
    return 0

def aStarSearch(problem, heuristic=nullHeuristic):
    """Search the node that has the lowest combined cost and heuristic first."""
    "*** YOUR CODE HERE ***"
    # A* Search 는 휴리스틱 값을 비교해서 사용하기 때문에 Priority Queue를 사용하면 편리하다.
    fringe = util.PriorityQueue()
    # Priority Queue 에 시작 state와 이동한 방향을 넣을 빈 리스트[], 비용을 하나의 item으로 구조에 맞게 cost도 넣는다.
    fringe.push((problem.getStartState(), []), 0)
    # visited 는 어떠한 state에 도달하기 까지 방문한 state들과 해당 state까지 도달하기 까지의 최소비용을 저장할 구조체이다.
    visited = set()
    # Priority Queue가 비어 있을때 까지 반복문을 돌린다.
    while not fringe.isEmpty():
        # Priority Queue에서 가장 처음에 넣은 item을 꺼내어 정보를 저장한다.
        node, direction = fringe.pop()
        #
        if node in visited:
            continue
        # 맨 처음 방문한 node 와 비용을 방문한 리스트에 저장한다.
        visited.add(node)
        # node 가 미로의 끝인지를 확인한다.
        if problem.isGoalState(node):
            # 만약 node 가 미로의 끝이 맞다면 start state 부터 여기까지 도달하기 위한 움직임을 return 한다.
            return direction
        # getSuccessors 하는 함수는 successor, action, stepcost 를 반환하는 함수이다.
        # successor 는 다음에 이동할 수 있는 state를 의미한다.
        # action 은 현재 state 에서 다음 state 로 이동하려면 어느 방향으로 이동해야 하는지를 의미한다.
        # stepcost는 다음 state 까지 이동하는 데 소요되는 비용을 의미한다.
        for successor, action, stepcost in problem.getSuccessors(node):
            # 다음 state 가 이전에 방문한 적이 없는지 검사한다.
            if successor not in visited:
                # 다음 state와 그 state까지 도달하기 위한 움직임, 도달하기 까지 비용을 하나의 item 으로 묶고 비용과 함께 Priority Queue에 넣는다.
                fringe.push((successor, direction + [action]), stepcost + problem.getCostOfActions(direction) + (heuristic(successor, problem=problem)))
    # 만약 Queue가 비었는데 return을 하지 않았다면 미로를 끝낼수 있는 방법이 없는 것 이므로 빈 리스트를 return 한다.
    return []

# Abbreviations
bfs = breadthFirstSearch
dfs = depthFirstSearch
astar = aStarSearch
ucs = uniformCostSearch
