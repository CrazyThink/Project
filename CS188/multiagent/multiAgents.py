# coding:utf-8
# multiAgents.py
# --------------
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


from util import manhattanDistance
from game import Directions
import random, util

from game import Agent

class ReflexAgent(Agent):

    def getAction(self, gameState):
        # Collect legal moves and successor states
        legalMoves = gameState.getLegalActions()

        # Choose one of the best actions
        scores = [self.evaluationFunction(gameState, action) for action in legalMoves]
        bestScore = max(scores)
        bestIndices = [index for index in range(len(scores)) if scores[index] == bestScore]
        chosenIndex = random.choice(bestIndices) # Pick randomly among the best

        "Add more of your code here if you want to"

        return legalMoves[chosenIndex]

    # 현재 상태에서 어떠한 움직임을 취했을경우 나타나는 상태에 대한 평가 함수
    def evaluationFunction(self, currentGameState, action):
        "*** YOUR CODE HERE ***"
        # 현재 게임 상태에서 팩맨의 위치 정보를 받아서 저장
        currentPos = currentGameState.getPacmanPosition()
        # 현재 게임 상태에서 음식의 위치 정보를 받아서 저장
        currentFood = currentGameState.getFood()
        # 현재 게임 상태에서 맵의 높이와 너비를 구하기 위해서 벽의 정보를 받아와서 저장
        layout = currentGameState.getWalls()
        # 게임 상에서 팩맨과 유령 혹은 음식이 가장 멀리 있는 경우는 맵의 양 대각선 끝쪽이기 때문에 맵의 높이와 너비를 더한다.
        maxlength = layout.height - 2 + layout.width - 2
        # 팩맨이 움직이면 올수 있는 다음 게임 상태에 대한 정보를 저장
        successorGameState = currentGameState.generatePacmanSuccessor(action)
        # 다음 게임 상태에서 팩맨의 위치 정보를 저장
        newPos = successorGameState.getPacmanPosition()
        # 다음 게임 상태에서 음식의 위치 정보를 저장
        newFood = successorGameState.getFood()
        # 상태를 평가하기 위한 점수를 0 으로 선언
        score = 0
        # 다음 상태에서의 팩맨의 위치가 현재 상태에서의 음식의 위치들중 하나와 맞는지 검사
        if currentFood[newPos[0]][newPos[1]]:
            # 음식을 전부 먹어야지 게임에서 승리하므로 음식의 위치로 가는것에는 점수를 많이 부여한다.
            score += 10
        # 음식과 팩맨의 최소 거리를 구하기 위해서 우선적으로 무한 값으로 선언
        newFoodDistance = float("inf")
        # 다음 상태에서 음식마다 반복문을 실행
        for food in newFood.asList():
            # 음식과 팩맨의 위치간의 거리를 맨하탄 Distance 함수를 이용해서 구한다.
            foodDistance = manhattanDistance(newPos, food)
            # 음식과 팩맨 사이의 위치들중 최소값을 구하기 위해서 min을 사용한다.
            newFoodDistance = min([newFoodDistance, foodDistance])
        # 유령과 팩맨의 최소거리를 구하기 위해서 우선적으로 무한 값으로 선언
        newGhostDistance = float("inf")
        # 다음 상태에서 유령마다 반복문 실행
        for ghost in successorGameState.getGhostPositions():
            # 유령과 팩맨의 위치간의 거리를 맨하탄 Distance 함수를 이용해서 구한다.
            ghostDistance = manhattanDistance(newPos, ghost)
            # 유령과 팩맨 사이의 위치들중 최소값을 구하기 위해서 min을 사용한다.
            newGhostDistance = min([newGhostDistance, ghostDistance])
        # 팩맨과 유령가의 최소 거리가 2보다 작은지 검사
        if newGhostDistance < 2:
            # 유령과 부딫힐 경우 게임에서 패배하기 때문에 팩맨과 유령과의 거리가 2보다 작으면 점수에서 많이 감소시킨다.
            score -= 500
            # 평가하기 위한 점수는 앞에서 구한 음식을 먹었는지 여부에 따른 점수, 유령과 거리가 2보다 작은지의 여부에 따른 점수에
            # 추가적으로 음식과의 최소거리의 역수, 유령과의 최소거리에 거리중 최대로 나올수 있는 maxlength를  나눈 값을 더해준다.
        score = score + 1.0 / newFoodDistance + newGhostDistance / maxlength
        # 점수를 반환한다.
        return score

def scoreEvaluationFunction(currentGameState):
    """
      This default evaluation function just returns the score of the state.
      The score is the same one displayed in the Pacman GUI.

      This evaluation function is meant for use with adversarial search agents
      (not reflex agents).
    """
    return currentGameState.getScore()

class MultiAgentSearchAgent(Agent):


    def __init__(self, evalFn = 'scoreEvaluationFunction', depth = '2'):
        self.index = 0 # Pacman is always agent index 0
        self.evaluationFunction = util.lookup(evalFn, globals())
        self.depth = int(depth)

class MinimaxAgent(MultiAgentSearchAgent):
    """
      Your minimax agent (question 2)
    """
    # 어떤 움직임을 취할지 결정하게 하는 함수
    def getAction(self, gameState):
        "*** YOUR CODE HERE ***"
        def search_depth(state, depth, agentIndex):
            # 마지막 유령인 경우에는
            if agentIndex == state.getNumAgents():
                # 현재의 깊이가 설정해 놓은 depth 값과 같은지 확인한다.
                if depth == self.depth:
                    # 위의 조건을 만족한다면 평가함수에 현재의 상태를 넣고 나온 값을 반환한다.
                    return self.evaluationFunction(state)
                # 다르다면
                else:
                    # 깊이를 늘려가면서 계속한다.
                    return search_depth(state, depth + 1, 0)
            # 마지막 유령이 아니라면
            else:
                # 현재 상태에서 가능한 움직임들을 리스트에 저장한다.
                actions = state.getLegalActions(agentIndex)
                # 현재 상태에서 가능한 움직임이 없다면
                if len(actions) == 0:
                    # 위의 조건을 만족한다면 평가함수에 현재의 상태를 넣고 나온 값을 반환한다.
                    return self.evaluationFunction(state)
                # 다음 상태들을 리스트에 저장
                next_states = (
                    # 다음 번호의 유령에게 보내기 위해서 현재 상태의 다음 state들을 구한다.
                    search_depth(state.generateSuccessor(agentIndex, action), depth, agentIndex + 1)
                    # 가능한 움직임마다 반복문을 실행한다.
                    for action in actions
                )
                # 팩맨이라면 최댓값을 아니라면 최솟값을 다음 상태에서 반환한다.
                return (max if agentIndex == 0 else min)(next_states)
        # 현재의 움직임은 정지 상태로 선언한다.
        move = Directions.STOP
        # 최대 값을 구해야 하기 때문에 value를 -무한으로 설정해둔다.
        value = float("-inf")
        # 가능한 움직임마다 반복문을 실행한다.
        for action in gameState.getLegalActions(0):
            # 다음 상태의 평가 값들중에서 최소값을 구하여 저장한다.
            temp = search_depth(gameState.generateSuccessor(0, action), 1, 1)
            # 최소값들중에서 최대 값을 구하기 위해서 temp와 value를 비교한다.
            if temp > value:
                # temp가 크다면 value 값을 temp 값으로 교환한다.
                value = temp
                # temp값을 얻기위해서 해야할 움직임을 move에 저장한다.
                move = action
        # 팩맨의 움직임을 반환한다.
        return move

class AlphaBetaAgent(MultiAgentSearchAgent):
    """
      Your minimax agent with alpha-beta pruning (question 3)
    """
    # 어떤 움직임을 취할지 결정하게 하는 함수
    def getAction(self, gameState):
        "*** YOUR CODE HERE ***"
        # 최소 값들 중에서 가장 큰 최대값을 구하는 함수로써 팩맨의 움직임을 결정하는 함수
        def maximizer(state, depth, agentIndex, alpha, beta):
            # 현재의 깊이가 설정해 놓은 depth 값보다 큰지 확인한다.
            if depth > self.depth:
                # 위의 조건을 만족한다면 평가함수에 현재의 상태를 넣고 나온 값을 반환한다.
                return self.evaluationFunction(state)
            # value를 초기화한다.
            value = None
            # 현재 상태에서 가능한 모든 움직임에 반복문을 실행한다.
            for action in state.getLegalActions(agentIndex):
                # 현재 상태에서 파생될수 있는 다음 상태들에 대한 minimizer 값들 중에서 최대 값을 구한다.
                successor = minimizer(state.generateSuccessor(agentIndex, action), depth, agentIndex + 1, alpha, beta)
                value = max(value, successor)
                # value 값이 beta 값 보다 큰지 검사한다.
                if beta is not None and value > beta:
                    # 만약 value 값이 beta 값 보다 크다면 자식 노드들을 검사할 필요가 없으므로 value 값을 반환한다.
                    return value
                # 자식 노드에서 계산 과정을 줄이기 위해 사용하는 alpha-beta pruning 에서 사용할
                # alpha 값을 value 값들 중 최대값으로 설정한다.
                alpha = max(alpha, value)
            if value is None:
                return self.evaluationFunction(state)
            # 위에서 구한 최대 값을 반환한다.
            return value
        # 유령들의 움직임을 결정하는 함수
        def minimizer(state, depth, agentIndex, alpha, beta):
            # 마지막 유령인 경우에는 state의 평가 점수들의 최댓값을 구한다.
            if agentIndex == state.getNumAgents():
                return maximizer(state, depth + 1, 0, alpha, beta)
            # value를 초기화한다.
            value = None
            # 마지막 유령이 아닌 경우에도 가능한 움직임들마다 반복문을 실행하지만
            for action in state.getLegalActions(agentIndex):
                # 다음 번호의 유령에게 보내기 위해서 현재 상태의 다음 state 평가 점수들의 최소값들 중에서의 최소값을 구한다.
                successor = minimizer(state.generateSuccessor(agentIndex, action), depth, agentIndex + 1, alpha, beta)
                value = successor if value is None else min(value, successor)
                # value 값이 alpha 값 보다 작은지 검사한다.
                if alpha is not None and value < alpha:
                    # 만약 value 값이 alpha 값 보다 작으면 자식 노드들을 검사할 필요가 없으므로 value 값을 반환한다.
                    return value
                # 자식 노드에서 계산 과정을 줄이기 위해 사용하는 alpha-beta pruning 에서 사용할
                # beta 값을 value 값들 중 최소값으로 설정한다.
                beta = value if beta is None else min(beta, value)
            if value is None:
                return self.evaluationFunction(state)
            # 위에서 구한 최소값을 반환한다.
            return value

        # 실행에 필요한 변수를 초기화 한다.
        value, alpha, beta, move = None, None, None, None
        # 현재 게임 상태에서 가능한 움직임마다 반복문을 실행한다.
        for action in gameState.getLegalActions(0):
            # 다음 상태의 minimizer 값들 중에서 최댓값을 구하여 저장한다.
            value = max(value, minimizer(gameState.generateSuccessor(0, action), 1, 1, alpha, beta))
            # 다음 상태의 평가 값들을 구할때 계산 과정의 속도를 높이는 alpha-beta pruning 에서 사용할 alpha 값을
            # 이제까지 나온 value 들 중 최댓값으로 설정해준다.
            if alpha is None:
                alpha, move = value, action
            else:
                alpha, move = max(value, alpha), action if value > alpha else move
        # 팩맨의 움직임을 반환한다.
        return move

class ExpectimaxAgent(MultiAgentSearchAgent):
    """
      Your expectimax agent (question 4)
    """

    def getAction(self, gameState):
        "*** YOUR CODE HERE ***"

        def search_depth(state, depth, agentIndex):
            # 마지막 유령인 경우에는
            if agentIndex == state.getNumAgents():
                # 현재의 깊이가 설정해 놓은 depth 값과 같은지 확인한다.
                if depth == self.depth:
                    # 위의 조건을 만족한다면 평가함수에 현재의 상태를 넣고 나온 값을 반환한다.
                    return self.evaluationFunction(state)
                # 다르다면
                else:
                    # 깊이를 늘려가면서 계속한다.
                    return search_depth(state, depth + 1, 0)
            # 마지막 유령이 아니라면
            else:
                # 현재 상태에서 가능한 움직임들을 리스트에 저장한다.
                actions = state.getLegalActions(agentIndex)
                # 현재 상태에서 가능한 움직임이 없다면
                if len(actions) == 0:
                    # 위의 조건을 만족한다면 평가함수에 현재의 상태를 넣고 나온 값을 반환한다.
                    return self.evaluationFunction(state)
                # 다음 상태들을 리스트에 저장
                next_states = (
                    # 다음 번호의 유령에게 보내기 위해서 현재 상태의 다음 state들을 구한다.
                    search_depth(state.generateSuccessor(agentIndex, action), depth, agentIndex + 1)
                    # 가능한 움직임마다 반복문을 실행한다.
                    for action in actions
                )
                # 팩맨이라면 최댓값을 다음 상태에서 반환한다.
                if agentIndex == 0:
                    return max(next_states)
                # 팩맨이 아니라면 다음 상태에서 평균값을 반환한다.
                else:
                    next_states = list(next_states)
                    return (sum(next_states) / len(next_states))
        # 현재의 움직임은 정지 상태로 선언한다.
        move = Directions.STOP
        # 최대 값을 구해야 하기 때문에 value를 -무한으로 설정해둔다.
        value = float("-inf")
        # 가능한 움직임마다 반복문을 실행한다.
        for action in gameState.getLegalActions(0):
            # 다음 상태의 평가 값들중에서 최소값을 구하여 저장한다.
            temp = search_depth(gameState.generateSuccessor(0, action), 1, 1)
            # 최소값들중에서 최대 값을 구하기 위해서 temp와 value를 비교한다.
            if temp > value:
                # temp가 크다면 value 값을 temp 값으로 교환한다.
                value = temp
                # temp값을 얻기위해서 해야할 움직임을 move에 저장한다.
                move = action
        # 팩맨의 움직임을 반환한다.
        return move

def betterEvaluationFunction(currentGameState):
    "*** YOUR CODE HERE ***"
    # 현재 게임 상태에서 팩맨의 위치 정보를 받아서 저장
    currentPos = currentGameState.getPacmanPosition()
    # 현재 게임 상태에서 음식의 위치 정보를 받아서 저장
    currentFood = currentGameState.getFood()
    # 현재 게임 상태에서 캡슐 아이템의 위치 정보를 받아서 저장
    capsulePos = currentGameState.getCapsules()
    # 현재 게임 상태에서 맵의 높이와 너비를 구하기 위해서 벽의 정보를 받아와서 저장
    layout = currentGameState.getWalls()
    # 게임 상에서 팩맨과 유령 혹은 음식이 가장 멀리 있는 경우는 맵의 양 대각선 끝쪽이기 때문에 맵의 높이와 너비를 더한다.
    maxlength = layout.height - 2 + layout.width - 2
    # 음식들과 팩맨사이의 거리들을 저장하기 위한 리스트 선언
    fooddistance = []
    # 캡슐 아이템과 팩맨사이의 거리들을 저장하기 위한 리스트 선언
    capsuledistance = []
    # 음식마다 반복문을 실행
    for food in currentFood.asList():
        # 팩맨과 음식의 위치간의 거리를 맨하탄 Distance 함수를 이용해서 구한후 리스트에 넣는다.
        fooddistance.append(manhattanDistance(currentPos, food))
    # 캡슐 아이템마다 반복문을 실행
    for capsule in capsulePos :
        # 팩맨과 캡슐 아이템의 위치간의 거리를 맨하탄 Distance 함수를 이용해서 구한후 리스트에 넣는다.
        capsuledistance.append(manhattanDistance(currentPos, capsule))
    # 상태 평가를 위한 점수를 0으로 초기화한 후 선언
    score = 0
    # 현재 팩맨의 위치 정보중 x좌표를 저장
    x = currentPos[0]
    # 현재 팩맨의 위치 정보중 y좌표를 저장
    y = currentPos[1]
    # 모든 유령에 대하여 반복문 실행
    for ghostState in currentGameState.getGhostStates():
        # 유령과 팩맨의 위치간의 거리를 맨하탄 Distance 함수를 이용해서 구한다.
        gd = manhattanDistance(currentPos, ghostState.configuration.getPosition())
        # 유령과의 거리가 2보다 작은지 확인
        if gd < 2:
            # 캡슐아이템을 먹어서 유령이 현재 먹을수 있는 상태인지 확인
            if ghostState.scaredTimer != 0:
                # 먹을 수 있는 상태의 유령이라면 가까이 갈 수록 상태점수가 높아지게 설정하여 팩맨이 유령을 먹으러 가게끔 만든다.
                score += 1000.0/(gd+1)
            else :
                # 먹을 수 없는 상태의 유령이라면 가까이 갈 수록 상태점수가 낮아지게 설정하여 팩맨이 도망치게 만든다.
                score -= 1000.0/(gd+1)
    # 캡슐과의 최소 거리가 5보다 작은지 확인한다. 이때 캡슐이 하나도 존재하지 않을 수 있으니 리스트에 추가적으로 float(100)을 추가한다.
    if min(capsuledistance+[float(100)])<5:
        # 캡슐과의 거리가 가까워질 수록 상태점수가 높아지게 설정
        score += 500.0/(min(capsuledistance))
    # 위의 조건문에서 캡슐과의 거리가 작아질 수록 상태점수가 높아지지만 팩맨이 캡슐을 먹게되면 상태점수가 높아지지 않아서 팩맨이 캡슐을 먹지 않는 경우가 발생하므로 캡슐의 위치와 팩맨의 위치가 같은지 검사하여 만약 팩맨이 캡슐을 먹었다면 더 높은 상태점수를 갖게 설정
    for capsule in capsulePos:
        # 팩맨의 위치와 캡슐의 위치가 같은지 확인
        if (capsule[0]==x)&(capsule[1]==y):
            # 팩맨이 캡슐을 먹었다면 상태점수가 높아지게 설정하여 팩맨이 캡슐 아이템을 먹게끔 만든다.
            score += 600.0
    # 음식과 팩맨간의 최소거리를 구한다. 이때 음식이 하나도 없는 경우를 측정하기 위해서 float(100)을 추가한다.
    minfooddistance = min(fooddistance+[float(100)])
    # 위에서 설정한 상태점수에 음식과 팩맨간의 최소거리의 역수를 더한 후 남아있는 음식의 개수에 10을 곱한 값을 뺀 후 상태점수를 반환한다.
    return score + 1.0/minfooddistance - len(fooddistance)*10.0

# Abbreviation
better = betterEvaluationFunction

