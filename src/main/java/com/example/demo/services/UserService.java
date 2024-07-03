
package com.example.demo.services;

import com.example.demo.Auth_Pipeline.UsersDomain;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.battle.BattleDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameType;
import com.example.demo.models.token.TokenModel;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.PasswordValidationInfo;
import com.example.demo.models.user.TokenValidationInfo;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.ITokenRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.repositories.IUserRoleModelRepository;
import com.example.demo.services.exceptions.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Component;

import java.time.Clock;
import java.time.Instant;
import java.util.Comparator;
import java.util.List;
import java.util.Optional;

@Component
public class UserService {

    private IUserModelRepository userRepository;
    private ITokenRepository tokenRepository;
    private UsersDomain usersDomain;
    private Clock clock;
    private IBattleRepository iBattleRepository;
    private GamesService gamesService;
    private IUserRoleModelRepository iUserRoleModelRepository;

    public UserService(IUserModelRepository userRepository,
                       ITokenRepository tokenRepository,
                       UsersDomain usersDomain,
                       Clock clock,
                       IBattleRepository iBattleRepository,
                       GamesService gamesService,
                       IUserRoleModelRepository iUserRoleModelRepository) {
        this.userRepository = userRepository;
        this.tokenRepository = tokenRepository;
        this.usersDomain = usersDomain;
        this.clock = clock;
        this.iBattleRepository = iBattleRepository;
        this.gamesService = gamesService;
        this.iUserRoleModelRepository = iUserRoleModelRepository;
    }

    public UserModel getUserById(long id) throws NotFoundException {
        return userRepository.findById(id).orElseThrow(() -> new NotFoundException("User not found"));
    }

    public UserModel createUser(String username, String email, String password) throws AlreadyExistsException {
        if(userRepository.findByUsername(username).isPresent()){
            throw new AlreadyExistsException("Username already exists");
        }
        if(!usersDomain.isSafePassword(password)){
            throw new IllegalArgumentException("Password is not safe");
        }
        PasswordValidationInfo passwordValidationInfo = usersDomain.createPasswordValidationInformation(password);
        UserModel user = new UserModel();
        user.setUsername(username);
        user.setEmail(email);
        user.setPasswordValidationInfo(passwordValidationInfo.validationInfo());
        user.setBalance(0.0);
        user.setUserRole(iUserRoleModelRepository.findById(1L).get());
        return userRepository.save(user);

    }

    public AuthenticatedUser login(String username, String password) throws InvalidUsernameOrPasswordException, InternalErrorException {
        if(username.isBlank() || password.isBlank()){
            throw new InvalidUsernameOrPasswordException("Username and password must not be empty");
        }
        UserModel user = userRepository.findByUsername(username).orElseThrow(() -> new InvalidUsernameOrPasswordException("Invalid username or password"));
        if(!usersDomain.validatePassword(password, new PasswordValidationInfo(user.getPasswordValidationInfo()))){
            throw new InvalidUsernameOrPasswordException("Invalid username or password");
        }
        List<TokenModel> userTokens = tokenRepository.findByUser(user);
        int maxTokens = usersDomain.getMaxNumberOfTokensPerUser();

        if (userTokens.size() >= maxTokens) {
            // Sort tokens by createdAt
            userTokens.sort(Comparator.comparing(TokenModel::getCreatedAt));

            // Remove the oldest token(s) if necessary
            for (int i = 0; i <= userTokens.size() - maxTokens; i++) {
                tokenRepository.delete(userTokens.get(i));
            }
        }

        String tokenValue = usersDomain.generateTokenValue();
        Instant now = clock.instant();
        TokenModel token = new TokenModel();
        token.setTokenValidationInfo(usersDomain.createTokenValidationInformation(tokenValue).validationInfo());
        token.setCreatedAt(now);
        token.setLastUsedAt(now);
        token.setUser(user);
        tokenRepository.save(token);
        return new AuthenticatedUser(user, tokenValue);
    }
    public AuthenticatedUser loginEmail(String email, String password) throws InvalidUsernameOrPasswordException, InternalErrorException {
        if(email.isBlank() || password.isBlank()){
            throw new InvalidUsernameOrPasswordException("Username and password must not be empty");
        }
        UserModel user = userRepository.findByEmail(email).orElseThrow(() -> new InvalidUsernameOrPasswordException("Invalid username or password"));
        if(!usersDomain.validatePassword(password, new PasswordValidationInfo(user.getPasswordValidationInfo()))){
            throw new InvalidUsernameOrPasswordException("Invalid username or password");
        }
        List<TokenModel> userTokens = tokenRepository.findByUser(user);
        int maxTokens = usersDomain.getMaxNumberOfTokensPerUser();

        if (userTokens.size() >= maxTokens) {
            // Sort tokens by createdAt
            userTokens.sort(Comparator.comparing(TokenModel::getCreatedAt));

            // Remove the oldest token(s) if necessary
            for (int i = 0; i <= userTokens.size() - maxTokens; i++) {
                tokenRepository.delete(userTokens.get(i));
            }
        }

        String tokenValue = usersDomain.generateTokenValue();
        Instant now = clock.instant();
        TokenModel token = new TokenModel();
        token.setTokenValidationInfo(usersDomain.createTokenValidationInformation(tokenValue).validationInfo());
        token.setCreatedAt(now);
        token.setLastUsedAt(now);
        token.setUser(user);
        tokenRepository.save(token);
        return new AuthenticatedUser(user, tokenValue);
    }

    public void logout(String token) {
        TokenValidationInfo tokenValidationInfo = usersDomain.createTokenValidationInformation(token);
        tokenRepository.deleteById(tokenValidationInfo.validationInfo());
    }

    public UserModel getUserByToken(String token) throws AuthenticationException {
        if(!usersDomain.canBeToken(token)){
            throw new IllegalArgumentException("Invalid Token");
        }
        TokenValidationInfo tokenValidationInfo = usersDomain.createTokenValidationInformation(token);
        TokenModel tokenModel = tokenRepository.findById(tokenValidationInfo.validationInfo()).orElseThrow(() -> new AuthenticationException("Invalid Token"));
        if(!usersDomain.isTokenTimeValid(clock,tokenModel)){
            tokenRepository.delete(tokenModel);
            throw new AuthenticationException("Invalid Token");
        }else {
            tokenModel.setLastUsedAt(clock.instant());
            tokenRepository.save(tokenModel);
            return tokenModel.getUser();
        }


    }


    public ResponseEntity<BattleDTO> getBattleContext(long codUser) throws NotFoundException {
        Optional<UserModel> optionalUser = userRepository.findById(codUser);
        if(!optionalUser.isPresent())
            throw new NotFoundException("User não encontrado");
        UserModel user = optionalUser.get();
        Optional<BattleModel> optionalBattle = iBattleRepository.findFirstByPlayer1(user);
        if(!optionalBattle.isPresent())
            optionalBattle = iBattleRepository.findFirstByPlayer2(user);
        if(!optionalBattle.isPresent())
            throw new NotFoundException("Partida não encontrada");
        BattleModel battle = optionalBattle.get();
        String board = battle.getBoard();
        String[][] boardArray = ((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, board))
                .getBoard();
        return ResponseEntity.ok(new BattleDTO(
                board,
                gamesService.getPossibleMoves(boardArray,battle.getRoom().getGame().getGameType()),
                battle.getCodBattle(),
                battle.getStatus().toString(),
                battle.getPlayer1().getCodUser() == codUser,
                false
        ));
    }
}


